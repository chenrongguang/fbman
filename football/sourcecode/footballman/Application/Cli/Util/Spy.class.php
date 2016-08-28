<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chenrongguang
 * Date: 2016-8-15
 * Time: 21:05
 * 爬虫工具类
 */namespace Cli\Util;

class  Spy  {

    //获取内容
    public  function getContent($url){
        $handle = fopen($url, "r");
        if ($handle) {
            $content = stream_get_contents($handle, 1024 * 1024);
            return $content;
        } else {
            return false;
        }
    }

}
