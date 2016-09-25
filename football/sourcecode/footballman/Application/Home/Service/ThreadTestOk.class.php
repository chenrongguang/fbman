<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 多线程工具类
 */
namespace Home\Service;

class ThreadTestOk extends \Thread {
    private $arg;
    public function __construct($arg){
        $this->arg = $arg;
    }
    public function run(){
        if($this->arg){
            //printf("Hello %s\n", $this->arg);
            echo("Hello " .$this->arg);
        }
    }
}
