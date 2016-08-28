<?php
return array(
    'URL_MODEL' => '2', //设置url模式为伪静态，这样的话,url中就不会带index.php了
	//'配置项'=>'配置值'
    'DB_TYPE' => 'sqlite',
    //以下这个地方的配置非常悲剧啊，写带./的相对目录，老是提示不能open databasefile ,如果是没有的它会自动创建一个db
    //如果使用以前用客户端创建的db,里边表也建好，也是有问题的
    //所以现在现在这个根目录下创建一个db 吧，然后再里边建表，才好用，
    //并且以后后续再linux下注意权限问题
    'DB_DSN' => 'sqlite:footballman.db',
   // 'DB_NAME' =>  'fbm',
    'DB_PREFIX' => 't_', // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 数据库编码默认采用utf8
    'DB_FIELDS_CACHE' => false, // 启用字段缓存

    'MATCH_URL'=>'http://mkt.hg6909.com/foot/index/', //爬虫网址
    'BALL_SUBS'=>',+0.5,-0.5,+1.5,-1.5,+2.5,-2.5,+3.5,-3.5,',//生死盘口，前后都加逗号
    'WEIXIN_ID' =>'gh_e611846d32ee', //不同环境，该值配置不一样

    "ROPSDK_APPKEY" => "B4B04562-75E4-49EB-BFD5-2EF50B70AA7E",//作为ROP开发者使用的 不同环境不一样
    "ROPSDK_APPSECRET" => "00C36CD3-7ADE-4AB3-9E8C-ED37837AA6E5",//作为ROP开发者使用的 不同环境不一样
    "ROPSDK_GATEWAYURL" => "https://testapi.open.ruixuesoft.com:30005/ropapi",//作为ROP开发者使用的 不同环境不一样

    'UPLOADIFY_TYPE' => array(//被允许上传的文件类型
        'image'=>array(
            'size' => '2097152',
            'exts'=>array('jpg','png','gif'),
            'path' => 'material/image/'
        ),
        'sound'=>array(
            'size' => '5242880',
            'exts'=>array('mp3','amr'),
            'path' => 'material/sound/'
        ),
        'video'=>array(
            'size' => '20971520',
            'exts'=>array('mp4'),
            'path' => 'material/video/'
        ),
        'pfx'=>array(
            'size' => '20971520',
            'exts'=>array('pfx'),
            'path' => 'material/video/'
        )
    ),

    'UPLOAD_SERVER_PATH' => 'upload/', //存储上传文件的路径，对于本地上传，需要为绝对路径，对于云存储，是相对路径,网站的根目录，后面要带/
    //'UPLOAD_SERVER_URL' => 'http://cos.myqcloud.com/11000457/H5Plus/', //cos访问url（除上传指定的目录和文件外的部分）
    'UPLOAD_SERVER_URL' => 'http://local.footballman.com/upload/', //如果是本地上传的话，需要配置这个网站的路径，后面带上根目录/upload/哦
);