<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 网站公告 ，必须是富文本
 */

namespace Home\Controller;
use Think\Controller;

class MessageController extends BaseController  {

    public function _initialize()
    {
        parent::_initialize();
    }

    public  function  add(){
       $this->display();
    }
    public  function  messlist(){

        if ($_GET['keywords']) {
            $keywords = $_GET['keywords'];
            $conditionData['title'] = array('like', '%' . $keywords . '%');
        }

        $conditionData['use_yn'] = 'Y';

        $model = M('message');
        $total = $model->field('id')->where($conditionData)->count();

        $Page = new \Common\Util\Pagebar($total, $_GET['page_size']);
        $list = $model->field('id,title,content,create_time,use_yn')
            ->where($conditionData)
            ->order("id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();

        //$show = $Page->showAjax("mainarea");
        $show = $Page->show();

        $this->assign('keywords', $keywords);
        $this->assign('page', $show);
        $this->assign('list', $list);

        $this->display();

    }
    public  function edit(){
        $this->display();
    }

    public  function  addDo(){
        $this->display();
    }
    public  function  editDO(){
        $this->display();
    }

}