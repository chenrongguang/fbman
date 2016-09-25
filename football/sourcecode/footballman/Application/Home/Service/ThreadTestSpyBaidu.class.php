<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 多线程工具类
 */
namespace Home\Service;

class ThreadTestSpyBaidu extends \Thread {
    public $url;
    public $result;

    public function __construct($url) {
        $this->url = $url;
    }

    public function run() {
        if ($this->url) {
            $this->result = model_http_curl_get($this->url);
        }
    }




}
