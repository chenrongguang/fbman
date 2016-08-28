<?php
class HfiveWeidianActivityExchangecodeUpdateRequest
{
     private $apiParas = array();

     private $exchange_code;

     public function getExchangeCode()
     {
         return $this->$exchange_code;
     }

     public function setExchangeCode($exchange_code)
     {
         $this->exchange_code = $exchange_code;
         $this->apiParas["exchange_code"] = $exchange_code;
     }

     private $activity_id;

     public function getActivityId()
     {
         return $this->$activity_id;
     }

     public function setActivityId($activity_id)
     {
         $this->activity_id = $activity_id;
         $this->apiParas["activity_id"] = $activity_id;
     }

     private $company_key;

     public function getCompanyKey()
     {
         return $this->$company_key;
     }

     public function setCompanyKey($company_key)
     {
         $this->company_key = $company_key;
         $this->apiParas["company_key"] = $company_key;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.hfive.weidian.activity.exchangecode.update";
     }
     public function check()     {          }}
