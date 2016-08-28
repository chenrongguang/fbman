<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 微信工具类
 */namespace Common\Util;

class  Weixin{

    /*
     * 发送方法，参数是个数组，里边包括各种必须的东西
     */
    public  function send($data){
        vendor('RopSdk.response');

        $ropapi= new \RopAPI();

        return $ropapi->send_wx_customer_sms($data);

   }
}
