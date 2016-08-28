<?php
class WheatfieldPycreditPersonBankCheckRequest
{
     private $apiParas = array();

     private $id_code;

     public function getIdCode()
     {
         return $this->$id_code;
     }

     public function setIdCode($id_code)
     {
         $this->id_code = $id_code;
         $this->apiParas["id_code"] = $id_code;
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

     private $bank_no;

     public function getBankNo()
     {
         return $this->$bank_no;
     }

     public function setBankNo($bank_no)
     {
         $this->bank_no = $bank_no;
         $this->apiParas["bank_no"] = $bank_no;
     }

     private $id_type;

     public function getIdType()
     {
         return $this->$id_type;
     }

     public function setIdType($id_type)
     {
         $this->id_type = $id_type;
         $this->apiParas["id_type"] = $id_type;
     }

     private $account_no;

     public function getAccountNo()
     {
         return $this->$account_no;
     }

     public function setAccountNo($account_no)
     {
         $this->account_no = $account_no;
         $this->apiParas["account_no"] = $account_no;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.wheatfield.pycredit.person.bank.check";
     }
     public function check()     {          }}
