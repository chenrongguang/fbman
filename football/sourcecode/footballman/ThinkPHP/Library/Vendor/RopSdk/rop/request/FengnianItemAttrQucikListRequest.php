<?php
class FengnianItemAttrQucikListRequest
{
     private $apiParas = array();

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

     private $attr_id;

     public function getAttrId()
     {
         return $this->$attr_id;
     }

     public function setAttrId($attr_id)
     {
         $this->attr_id = $attr_id;
         $this->apiParas["attr_id"] = $attr_id;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.fengnian.item.attr.qucik.list";
     }
     public function check()     {          }}
