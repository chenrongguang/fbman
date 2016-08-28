<?php
class WheatfieldOrderServicePayRequest
{
     private $apiParas = array();

     private $merchantcode;

     public function getMerchantcode()
     {
         return $this->$merchantcode;
     }

     public function setMerchantcode($merchantcode)
     {
         $this->merchantcode = $merchantcode;
         $this->apiParas["merchantcode"] = $merchantcode;
     }

     private $interproductid;

     public function getInterproductid()
     {
         return $this->$interproductid;
     }

     public function setInterproductid($interproductid)
     {
         $this->interproductid = $interproductid;
         $this->apiParas["interproductid"] = $interproductid;
     }

     private $useripaddress;

     public function getUseripaddress()
     {
         return $this->$useripaddress;
     }

     public function setUseripaddress($useripaddress)
     {
         $this->useripaddress = $useripaddress;
         $this->apiParas["useripaddress"] = $useripaddress;
     }

     private $intersavingpercent;

     public function getIntersavingpercent()
     {
         return $this->$intersavingpercent;
     }

     public function setIntersavingpercent($intersavingpercent)
     {
         $this->intersavingpercent = $intersavingpercent;
         $this->apiParas["intersavingpercent"] = $intersavingpercent;
     }

     private $productid;

     public function getProductid()
     {
         return $this->$productid;
     }

     public function setProductid($productid)
     {
         $this->productid = $productid;
         $this->apiParas["productid"] = $productid;
     }

     private $userid;

     public function getUserid()
     {
         return $this->$userid;
     }

     public function setUserid($userid)
     {
         $this->userid = $userid;
         $this->apiParas["userid"] = $userid;
     }

     private $amount;

     public function getAmount()
     {
         return $this->$amount;
     }

     public function setAmount($amount)
     {
         $this->amount = $amount;
         $this->apiParas["amount"] = $amount;
     }

     private $userfee;

     public function getUserfee()
     {
         return $this->$userfee;
     }

     public function setUserfee($userfee)
     {
         $this->userfee = $userfee;
         $this->apiParas["userfee"] = $userfee;
     }

     private $creditpercent;

     public function getCreditpercent()
     {
         return $this->$creditpercent;
     }

     public function setCreditpercent($creditpercent)
     {
         $this->creditpercent = $creditpercent;
         $this->apiParas["creditpercent"] = $creditpercent;
     }

     private $requesttime;

     public function getRequesttime()
     {
         return $this->$requesttime;
     }

     public function setRequesttime($requesttime)
     {
         $this->requesttime = $requesttime;
         $this->apiParas["requesttime"] = $requesttime;
     }

     private $userorderid;

     public function getUserorderid()
     {
         return $this->$userorderid;
     }

     public function setUserorderid($userorderid)
     {
         $this->userorderid = $userorderid;
         $this->apiParas["userorderid"] = $userorderid;
     }

     private $finalpercent;

     public function getFinalpercent()
     {
         return $this->$finalpercent;
     }

     public function setFinalpercent($finalpercent)
     {
         $this->finalpercent = $finalpercent;
         $this->apiParas["finalpercent"] = $finalpercent;
     }

     private $frozenpercent;

     public function getFrozenpercent()
     {
         return $this->$frozenpercent;
     }

     public function setFrozenpercent($frozenpercent)
     {
         $this->frozenpercent = $frozenpercent;
         $this->apiParas["frozenpercent"] = $frozenpercent;
     }

     private $interuserid;

     public function getInteruserid()
     {
         return $this->$interuserid;
     }

     public function setInteruserid($interuserid)
     {
         $this->interuserid = $interuserid;
         $this->apiParas["interuserid"] = $interuserid;
     }

     private $intercreditpercent;

     public function getIntercreditpercent()
     {
         return $this->$intercreditpercent;
     }

     public function setIntercreditpercent($intercreditpercent)
     {
         $this->intercreditpercent = $intercreditpercent;
         $this->apiParas["intercreditpercent"] = $intercreditpercent;
     }

     private $savingpercent;

     public function getSavingpercent()
     {
         return $this->$savingpercent;
     }

     public function setSavingpercent($savingpercent)
     {
         $this->savingpercent = $savingpercent;
         $this->apiParas["savingpercent"] = $savingpercent;
     }

     private $merchantuserid;

     public function getMerchantuserid()
     {
         return $this->$merchantuserid;
     }

     public function setMerchantuserid($merchantuserid)
     {
         $this->merchantuserid = $merchantuserid;
         $this->apiParas["merchantuserid"] = $merchantuserid;
     }

     private $originalorderid;

     public function getOriginalorderid()
     {
         return $this->$originalorderid;
     }

     public function setOriginalorderid($originalorderid)
     {
         $this->originalorderid = $originalorderid;
         $this->apiParas["originalorderid"] = $originalorderid;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.wheatfield.order.service.pay";
     }
     public function check()     {          }}
