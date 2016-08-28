<?php
class WheatfieldPycreditPhonenoCheckRequest
{
     private $apiParas = array();

     private $phone_no;

     public function getPhoneNo()
     {
         return $this->$phone_no;
     }

     public function setPhoneNo($phone_no)
     {
         $this->phone_no = $phone_no;
         $this->apiParas["phone_no"] = $phone_no;
     }

     private $org_no;

     public function getOrgNo()
     {
         return $this->$org_no;
     }

     public function setOrgNo($org_no)
     {
         $this->org_no = $org_no;
         $this->apiParas["org_no"] = $org_no;
     }

     private $query_name;

     public function getQueryName()
     {
         return $this->$query_name;
     }

     public function setQueryName($query_name)
     {
         $this->query_name = $query_name;
         $this->apiParas["query_name"] = $query_name;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.wheatfield.pycredit.phoneno.check";
     }
     public function check()     {          }}
