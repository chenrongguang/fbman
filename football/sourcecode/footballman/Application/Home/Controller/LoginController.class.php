<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 登录登出
 */

namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller  {
    public  function  index(){
       $this->display('login');
    }
    //登录操作
    public  function  loginDo(){

        $model = M('user');
        $pwd = md5(I("post.password"));
        $username = I("post.username");

        $map['name']=$username;
        $map['pwd']=$pwd;
        $map['use_yn']='Y';

        $result= $model->where($map)->find();
        //登录成功，设置session
        if($result!=false && $result !=null){
            $_SESSION['user']['id']=$result['id'];
            $_SESSION['user']['name']=$result['name'];
            $_SESSION['user']['okmatch_yn']=$result['okmatch_yn'];
            $return_data['url']= '/home/index/';
            $this->ajaxReturn(\Common\Util\Response::get_response('SUCCESS','0','处理成功',$return_data));
        }
        //登录不成功
        else{
            $this->ajaxReturn(\Common\Util\Response::get_response('FAIL','0001','用户名和密码不匹配，请重试!'));
        }


    }
    //登出操作
    public  function logoutDo(){
        unset($_SESSION['user']);
        //$this->display('login');
        redirect('/home/login/login');
    }


}