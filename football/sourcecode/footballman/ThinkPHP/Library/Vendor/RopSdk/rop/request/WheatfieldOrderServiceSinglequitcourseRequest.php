<?php
class WheatfieldOrderServiceSinglequitcourseRequest
{
     private $apiParas = array();

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

     private $quitcoursedate;

     public function getQuitcoursedate()
     {
         return $this->$quitcoursedate;
     }

     public function setQuitcoursedate($quitcoursedate)
     {
         $this->quitcoursedate = $quitcoursedate;
         $this->apiParas["quitcoursedate"] = $quitcoursedate;
     }

     private $useridquitamount;

     public function getUseridquitamount()
     {
         return $this->$useridquitamount;
     }

     public function setUseridquitamount($useridquitamount)
     {
         $this->useridquitamount = $useridquitamount;
         $this->apiParas["useridquitamount"] = $useridquitamount;
     }

     private $rootinstcd;

     public function getRootinstcd()
     {
         return $this->$rootinstcd;
     }

     public function setRootinstcd($rootinstcd)
     {
         $this->rootinstcd = $rootinstcd;
         $this->apiParas["rootinstcd"] = $rootinstcd;
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

     private $rootquitamount;

     public function getRootquitamount()
     {
         return $this->$rootquitamount;
     }

     public function setRootquitamount($rootquitamount)
     {
         $this->rootquitamount = $rootquitamount;
         $this->apiParas["rootquitamount"] = $rootquitamount;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.wheatfield.order.service.singlequitcourse";
     }
     public function check()     {          }}
