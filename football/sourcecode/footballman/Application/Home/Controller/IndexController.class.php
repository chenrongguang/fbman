<?php

/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 开发调试
 */


namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        /*
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;}
body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal;
 margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8');
       */
        $this->display();
    }

    //测试DB
    public function testdb()
    {
        $Model = M("test");
        $Data = $Model->select();
        dump($Data);
        echo "<hr>";
        /*
                $AddData["name"]="9999";
                $Model->add($AddData);
                echo($Model->getLastSql());
                $Data = $Model->select();
                dump($Data);
        */
    }

    //测试发送邮件
    /*
     *最终的测试结果是，在发送给某些邮件的时候会报错，但是有些邮箱又没有问题
     * 还不知道什么原因，估计和接收方有关系
     */
    public  function  testsendmail(){
         Vendor('SendMail.sendmail');
         $mail = new \MySendMail();
         $mail->setServer("smtp.163.com", "ruixuesoft_develop@163.com", "ruixuesoft"); //设置smtp服务器
         $mail->setFrom("ruixuesoft_develop@163.com"); //设置发件人
         $mail->setReceiver("chenrongguang@rongcapital.cn"); //设置收件人，多个收件人，调用多次
         //$mail->setCc(""); //设置抄送，多个抄送，调用多次
         //$mail->setBcc("XXXXX"); //设置秘密抄送，多个秘密抄送，调用多次
         $mail->setMailInfo("test", "<b>test by crg </b>"); //设置邮件主题、内容
         $result= $mail->sendMail(); //发送
        if($result==true){
            echo 'success';
        }
        else{
            echo 'fail';
        }
    }
}