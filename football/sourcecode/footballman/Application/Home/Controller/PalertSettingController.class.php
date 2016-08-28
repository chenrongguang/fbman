<?php

/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-24
 * Time: 14:26
 * 比赛跟中设定
 */


namespace Home\Controller;
use Think\Controller;
class PalertSettingController extends BaseController {

    public function _initialize()
    {
        parent::_initialize();
    }

    //已经设置的需要跟踪的比赛列表
    public function settinglist(){
        $this->display();
    }

    //新增需要跟踪的比赛
    public function add(){
        $this->display();
    }
}