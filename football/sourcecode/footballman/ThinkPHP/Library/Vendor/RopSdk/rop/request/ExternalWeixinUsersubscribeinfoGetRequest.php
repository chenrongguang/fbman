<?php
class ExternalWeixinUsersubscribeinfoGetRequest
{
     private $apiParas = array();

     private $weixin_account;

     public function getWeixinAccount()
     {
         return $this->$weixin_account;
     }

     public function setWeixinAccount($weixin_account)
     {
         $this->weixin_account = $weixin_account;
         $this->apiParas["weixin_account"] = $weixin_account;
     }

     private $event_type;

     public function getEventType()
     {
         return $this->$event_type;
     }

     public function setEventType($event_type)
     {
         $this->event_type = $event_type;
         $this->apiParas["event_type"] = $event_type;
     }

     private $end_time;

     public function getEndTime()
     {
         return $this->$end_time;
     }

     public function setEndTime($end_time)
     {
         $this->end_time = $end_time;
         $this->apiParas["end_time"] = $end_time;
     }

     private $component_appid;

     public function getComponentAppid()
     {
         return $this->$component_appid;
     }

     public function setComponentAppid($component_appid)
     {
         $this->component_appid = $component_appid;
         $this->apiParas["component_appid"] = $component_appid;
     }

     private $start_time;

     public function getStartTime()
     {
         return $this->$start_time;
     }

     public function setStartTime($start_time)
     {
         $this->start_time = $start_time;
         $this->apiParas["start_time"] = $start_time;
     }

     private $page_current;

     public function getPageCurrent()
     {
         return $this->$page_current;
     }

     public function setPageCurrent($page_current)
     {
         $this->page_current = $page_current;
         $this->apiParas["page_current"] = $page_current;
     }

     private $page_size;

     public function getPageSize()
     {
         return $this->$page_size;
     }

     public function setPageSize($page_size)
     {
         $this->page_size = $page_size;
         $this->apiParas["page_size"] = $page_size;
     }

     public function getApiParas()
     {
         return $this->apiParas;
     }

     public function getApiMethodName()
     {
         return "ruixue.external.weixin.usersubscribeinfo.get";
     }
     public function check()     {          }}
