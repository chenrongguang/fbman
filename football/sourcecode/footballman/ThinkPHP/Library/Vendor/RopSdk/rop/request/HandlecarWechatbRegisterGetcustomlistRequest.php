<?php
class HandlecarWechatbRegisterGetcustomlistRequest
{
     private $apiParas = array();

     private $wxopenid;

     public function getWxopenid()
     {
         return $this->$wxopenid;
     }

     public function setWxopenid($wxopenid)
     {
         $this->wxopenid = $wxopenid;
         $this->apiParas["wxopenid"] = $wxopenid;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.handlecar.wechatb.register.getcustomlist";
     }
     public function check()     {          }}
