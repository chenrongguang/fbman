<?php
class FengnianFnmCityListRequest
{
     private $apiParas = array();

     private $provinceid;

     public function getProvinceid()
     {
         return $this->$provinceid;
     }

     public function setProvinceid($provinceid)
     {
         $this->provinceid = $provinceid;
         $this->apiParas["provinceid"] = $provinceid;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.fengnian.fnm.city.list";
     }
     public function check()     {          }}
