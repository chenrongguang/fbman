<?php
namespace Cli\Controller;
use Common\Util\Notify;
use Think\Controller;
use Cli\Util;
//use Sunra\PhpSimple\HtmlDomParser;


class MatchController extends Controller {
    private $spy;
    private $html;
    //定时执行的任务
    public function task(){

        //调试
        //$this->notify();
        //exit('notify done');

        //判断当前时间是否需要执行该任务
       if(false=== $this->check_task_time()){
           exit('now no need');
       }

        $_pageIndex=1;
        $this->spy= new Util\Spy();
        //这里采用comporser的autoload方法也是可以实现的，不过里边得用其提供的file_get_html方法了
        //$this->html= new simple_html_dom();
        //$this->html= \Sunra\PhpSimple\HtmlDomParser();

        //这里也可以采用简单的，只使用一个文件，放到THINKPHP的library目录下的vendor目录里边的SimpleHtmlDom目录即可
        Vendor('SimpleHtmlDom.simple_html_dom');
        $this->html= new \simple_html_dom();
        $this->clearmatch();
        $this->callspy($_pageIndex);
    }

    //清除数据
    private function clearmatch(){
        //清除合适的比赛
        $model= M('buss_okmatch');
        $model->where(1)->delete();

        //清除用户48小时之外的用户比赛跟踪设定
        $model= M('buss_p_alert');
        $before_time=date("Y-m-d H:i:s",strtotime("-2 day"));
        $map['create_time']=array('LT',$before_time);
        $model->where($map)->delete();

    }

    //某些时间段，不执行该任务
    private function  check_task_time(){
        $current_time= date('H');
        $result= M('config_okmatch')->find();
        if($current_time>$result['task_time_start'] && $current_time <$result['task_time_end']){
            return false;
        }
        return true;

    }

    //调用爬虫
    private function callspy($_pageIndex){
        $spy_result= $this->spy->getContent(C('MATCH_URL').$_pageIndex);
        //该句为调试使用：
       // $spy_result= "test";

        if(false===$spy_result){
            $this->notify_okmatch();
        }
        else if( false===$this->check_match($spy_result)){
            $this->notify_okmatch();
        }
        else{
            //如果不是返回false,则表示已经解析到网页，这时需要继续爬取下一页的内容，采用递归调用
            //处理爬虫返回的结果
            $this->handle_match($spy_result);

            $_pageIndex =$_pageIndex+1;
            $this->callspy($_pageIndex);
        }
    }

    //任务扫描完成周调用发送通知的任务
    private function notify_okmatch(){

        $result =M('buss_okmatch')->order('id asc')->select();
        if($result ==false || $result===null){
            exit('null');
        }

        $sender= Notify::getSender('weixin');

        $send_data['content']=$this->getconetent($result);
        $send_data['openids']= $this->getopenids_okmatch();
        $send_data['account']=C('WEIXIN_ID');
        $send_data['type']='text';
        $send_data['id']=-1;

        $sender->send($send_data);

        exit('done');
    }

    //比赛赔率跟踪通知
    private function notify_p_alert($result,$palert){

        $sender= Notify::getSender('weixin');

        $send_data['content']=$result;
        $send_data['openids']= $this->getopenids_palert($palert['user_id']);
        $send_data['account']=C('WEIXIN_ID');
        $send_data['type']='text';
        $send_data['id']=-1;

        $sender->send($send_data);

        exit('done');
    }


    //获取需要发送给的客户openid列表
    private function getopenids_palert($user_id){
        $model=M('user_openids');
        $rows=$model->where("user_id=".$user_id)->select();
        // $sql= $model->getLastSql();
        //转成去掉健值的数组：
        $result= $this->makeopenids($rows);
        return $result;

    }


    //获取需要发送给的客户openid列表
    private function getopenids_okmatch(){
        $model=M('user_openids');
        $rows=$model ->join('t_user on t_user_openids.user_id= t_user.id')
            ->field('t_user_openids.openid')->where("t_user.okmatch_yn='Y'")->select();
       // $sql= $model->getLastSql();
        //转成去掉健值的数组：
        $result= $this->makeopenids($rows);
        return $result;

    }

    //生成没有带键值的，符合接口要求的数组
    private function  makeopenids($rows){
        $result = array();
        foreach ($rows as $value) {
            $result[] = $value['openid'];
        }
        return $result;
    }

    //组织需要发送的客服消息内容
    private function getconetent($result){

        $head='以下是当前时段的最新通知:';
        $content =$head;
        foreach($result as $k => $val){
            $content.="\n"; //换行符
            //注意，必须是用双引号，否则的话，换行符不好用
            $content.="@".$val['team_a'].":".$val['team_b']."@".$val['ball_sub']."@".$val['p_a']."@".$val['p_b']."@".$val['game_time'];
        }
        return $content;

    }


    //检测内容，如果内容不符合条件，也是返回false
    private function  check_match($content){

        $this->html->clear();
        $this->html->load($content);

        //以下为调试用：
        //$this->html->load_file('nofind.htm'); //注意该文件这么写法，必须放在和index.php即入口文件的同级目录下面才可以找到的
        //$this->html->load_file('find.htm'); //注意该文件这么写法，必须放在和index.php即入口文件的同级目录下面才可以找到的
        $find_result=$this->html->find('table[id=container] tr');

        //只有一个的时候表示没有内容
        if(count($find_result)==1)
        {
            return false;
        }
        else{
            return true;
        }

    }

    //处理爬虫处理结果
    private function handle_match($content){

        //$this->html->load($content);
        //以下为调试用：
        //$this->html->load_file('find.htm');
        $find_result=$this->html->find('.TrBgOdd tr');

       // $this->html->clear();

        $td_index=0;
        foreach($find_result as $k =>$val) {
            try {

                //如果不是10个td ,则表示是联赛标志行，而不是具体的比赛标志行
                if(count($val->children())<>10){
                    continue;
                }

                //处理第1个td:比赛时间，比赛状态
                $td_index = 0;
                $children[$td_index] = $val->children($td_index);
                $game_time = $children[$td_index]->find('span', 0)->innertext;
                $game_status = $children[$td_index]->find('span', 1)->innertext;

                //if ($game_status == '滚球') {
                //    continue;
                //}

                //处理第2个td：比赛队伍
                $td_index++;
                $children[$td_index] = $val->children($td_index);
                $team_a = $children[$td_index]->find('div', 0)->find('span',0)->innertext;
                $team_b = $children[$td_index]->find('div', 1)->find('span',0)->innertext;

                //处理第3个td：跳过 空
                $td_index++;
                $children[$td_index] = $val->children($td_index);

                //处理第4个td：跳过，不让球赔率
                $td_index++;
                $children[$td_index] = $val->children($td_index);

                //处理第5个td：让球赔率
                $td_index++;
                $children[$td_index] = $val->children($td_index);

                //让球数
                $ball_sub = $children[$td_index]->find('div', 0)->find('span', 0)->innertext;
                //如果第一个没有，则表示客队让球，要取第二个
                if (empty($ball_sub)){
                    //客队让球加“+”号
                    $ball_sub = $children[$td_index]->find('div', 0)->find('span', 1)->innertext;
                    $ball_sub='+'.$ball_sub;
                }
                else{
                    //主队让球加“-”号
                    $ball_sub='-'.$ball_sub;
                }

                //如果
                $pos = mb_stripos( C('BALL_SUBS'),','.$ball_sub.',');

                $p_a = $children[$td_index]->find('div', 1)->find('span', 0)->innertext;//赔率A
                $p_b = $children[$td_index]->find('div', 1)->find('span', 1)->innertext;//赔率B

                //检查如果是需要跟踪的比赛，则需要处理该比赛
                $palert=$this->check_p_alert($ball_sub,$team_a,$team_b);
                if ($palert !==false){
                    $result= $this->handle_p_alert($p_a,$p_b,$palert);
                    //如果不为false,说明需要报警，调用报警函数
                    if($result!==false){
                        $this->notify_p_alert($result,$palert);
                    }
                }

                //检查赔率，如果符合条件，需要存入数据库，不符合则直接下一个
                if ($this->check_okmatch_p($p_a, $p_b) && $pos !== false) {
                    $data['team_a'] =$team_a;
                    $data['team_b'] =$team_b;
                    $data['ball_sub'] = $ball_sub;
                    $data['p_a'] = $p_a;
                    $data['p_b'] = $p_b;
                    $data['game_time'] = $this->convert_gameTime($game_time);
                    $data['create_time'] = date('Y-m-d H:i:s');

                    M('buss_okmatch')->add($data);
                } else {
                    continue;
                }


            } catch (\Exception  $e) {
                continue;
            }
        }

    }

    //查看是否有人设置了该比赛，是否需要进行赔率的跟踪
    private function check_p_alert($ball_sub,$team_a,$team_b){

        $model=M('buss_p_alert');
        $map['team_a']=array('EQ',$team_a);
        $map['team_b']=array('EQ',$team_b);
        $map['ball_sub']=array('EQ',$ball_sub);
        $result =$model->where($map)->order('id desc')->find();

        if($result !==false && $result !==null)
        {
            return $result;
        }

        //如果是设置的比赛，则返回该数组，否则返回false
        return false;
    }

    //处理比赛跟踪报警逻辑
    private function handle_p_alert($p_a,$p_b,$palert){
        $content='';
        if($p_a >=$palert['a_p_max'])  {
            $content .='主队现值:'.$p_a." 大于设定的最高值".$palert['a_p_max'];
         }
         if( $p_a <=$palert['a_p_min'] ){
             $content .='主队现值:'.$p_a." 小于设定的最小值".$palert['a_p_min'];
         }
        if($p_b >=$palert['b_p_max'])  {
            $content .='客队现值:'.$p_a." 大于设定的最高值".$palert['b_p_max'];
        }
        if( $p_b <=$palert['b_p_min'] ){
            $content .='客队现值:'.$p_a." 小于设定的最小值".$palert['b_p_min'];
        }

        if(empty($content)){
            return false;
        }
        else{
            return $content;
        }

    }

    //检查赔率是否符合设定
    private function check_okmatch_p($p_a,$p_b){
          $model =M('config_okmatch');
          $retult=$model->find();
          if($retult!==false){
                //赔率和不小于设定值，任何一个赔率值不小于设置的最小值
                if ($p_a>=$retult['p_min'] &&  $p_b>=$retult['p_min'] && ($p_a + $p_b)>=$retult['p_sum']){
                    return true;
                }
                else{
                    return false;
                }
          }
         else{
            return false;
         }

    }

    //返回转换之后的比赛时间
    private function convert_gameTime($game_time){
        $temp=substr($game_time,0,2);

        $pos = mb_stripos( $game_time,'a');
        if ($pos !== false) {
            $temp =(int)$temp + 12;
        }

        $pos = mb_stripos( $game_time,'p');
        if ($pos !== false) {
            if($temp==12){
                $temp='00';
            }
        }


        $final=$temp.substr($game_time,2);
        $final =str_replace('a','',$final);
        $final =str_replace('p','',$final);
        return $final;

    }

}