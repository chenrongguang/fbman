<?php
/**
 * Created by IntelliJ IDEA.
 * User: LIUXINGWEI
 * Date: 2015-4-9
 * Time: 13:37
 */
function getIp()
{
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }

    return $realip;
}

/**
 * @desc 封装curl的调用接口，post的请求方式
 */
function doCurlPostRequest($url, $requestString, $timeout = 10)
{
    if ($url == "" || $requestString == "" || $timeout <= 0) {
        return false;
    }
    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
    curl_setopt($con, CURLOPT_POST, true);
    curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);
    curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($con, CURLOPT_SSL_VERIFYHOST, false);

    return curl_exec($con);
}

/**
 * @desc 封装curl的调用接口，post的请求方式
 */
function doCurlPostsslRequest($url, $requestString, $pemfile, $timeout = 10)
{
    if ($url == "" || $requestString == "" || $timeout <= 0) {
        return false;
    }

    echo $pemfile;

    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
    curl_setopt($con, CURLOPT_POST, true);
    curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);
    curl_setopt($con, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($con, CURLOPT_SSL_VERIFYHOST, 2);
    //curl_setopt($ch, CURLOPT_SSLCERT, $pemfile);
    //curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
    curl_setopt($con, CURLOPT_CAINFO, $pemfile);

    return curl_exec($con);
}

/**
 * @desc 封装curl的调用接口，get的请求方式
 */
function doCurlGetRequest($url, $data = array(), $timeout = 10)
{
    if ($url == "" || $timeout <= 0) {
        return false;
    }
    if ($data != array()) {
        $url = $url . '?' . http_build_query($data);
    }
    \Think\Log::write("发送URL[" . $url . "]");
    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);
    curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($con, CURLOPT_SSL_VERIFYHOST, false);
    return curl_exec($con);
}

function doFileGetContent($url)
{
    if (!$url)
        return false;
    else
        return file_get_contents($url);

}

//解决json_encode转换中文的问题，在php5.4下json_encode本身解决的这个问题
function unescapedUnicode($match)
{
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

//把汉字转换为数字
function getUnicodeFromOneUTF8($word)
{
    //获取其字符的内部数组表示，所以本文件应用utf-8编码!
    //$word = iconv("gb2312", "utf-8", $word);
    if (is_array($word))
        $arr = $word;
    else
        $arr = str_split($word);
    //此时，$arr应类似array(228, 189, 160)
    //定义一个空字符串存储
    $bin_str = '';
    //转成数字再转成二进制字符串，最后联合起来。
    foreach ($arr as $value)
        $bin_str .= decbin(ord($value));
    //此时，$bin_str应类似111001001011110110100000
    //正则截取
    $bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/', '$1$2$3', $bin_str);
    //此时， $bin_str应类似0100111101100000,如果是汉字"你"
    return bindec($bin_str);
    //返回类似20320， 汉字"你"
    //return dechex(bindec($bin_str));
    //如想返回十六进制4f60，用这句
}

//根据经纬度计算距离，单位为米
function getDistance($lng1, $lat1, $lng2, $lat2)
{
    //将角度转为狐度
    $radLat1 = deg2rad($lat1);
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);
    $a = $radLat1 - $radLat2;//两纬度之差,纬度<90
    $b = $radLng1 - $radLng2;//两经度之差纬度<180
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137;
    return round($s, 2);
}

function array_sort($arr, $keys, $type = 'asc')
{
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v) {
        $keysvalue[$k] = $v[$keys];
    }
    if ($type == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k => $v) {
        $new_array[] = $arr[$k];
    }
    return $new_array;
}

function genAllUrl($toURL, $paras)
{
    $allUrl = null;
    if (null == $toURL) {
        die("toURL is null");
    }
    if (strripos($toURL, "?") == "") {
        $allUrl = $toURL . "?" . $paras;
    } else {
        $allUrl = $toURL . "&" . $paras;
    }
    return $allUrl;
}

function create_noncestr($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        //$str .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    return $str;
}

function splitParaStr($src, $token)
{
    $resMap = array();
    $items = explode($token, $src);
    foreach ($items as $item) {
        $paraAndValue = explode("=", $item);
        if ($paraAndValue != "") {
            $resMap[$paraAndValue[0]] = $parameterValue[1];
        }
    }
    return $resMap;
}

function trimString($value)
{
    $ret = null;
    if (null != $value) {
        $ret = $value;
        if (strlen($ret) == 0) {
            $ret = null;
        }
    }
    return $ret;
}

function formatQueryParaMap($paraMap, $urlencode)
{
    $buff = "";
    ksort($paraMap);
    foreach ($paraMap as $k => $v) {
        if (null != $v && "null" != $v && "sign" != $k) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
    }
    $reqPar;
    if (strlen($buff) > 0) {
        $reqPar = substr($buff, 0, strlen($buff) - 1);
    }
    return $reqPar;
}

function formatBizQueryParaMap($paraMap, $urlencode)
{
    $buff = "";
    ksort($paraMap);
    foreach ($paraMap as $k => $v) {
        if ($urlencode) {
            $v = urlencode($v);
        }
        $buff .= strtolower($k) . "=" . $v . "&";
    }
    $reqPar;
    if (strlen($buff) > 0) {
        $reqPar = substr($buff, 0, strlen($buff) - 1);
    }
    return $reqPar;
}

function arrayToXml($arr)
{
    $xml = "<xml>";
    foreach ($arr as $key => $val) {
        if (is_numeric($val)) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
    }
    $xml .= "</xml>";
    return $xml;
}

function sign($content, $key)
{
    $signStr = $content . "&key=" . $key;
    return strtoupper(md5($signStr));
}

function verifySignature($content, $sign, $md5Key)
{
    $signStr = $content . "&key=" . $md5Key;
    $calculateSign = strtolower(md5($signStr));
    $tenpaySign = strtolower($sign);
    if ($calculateSign == $tenpaySign)
        return true;
    else
        return false;
}

function guid()
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12)
            . chr(125);// "}"
        return $uuid;
    }
}

//更改为通过微信原始id，去admin库中获取微信号，如果通过无意义的主键获取是有问题的
//里边返回的字段也是有问题的，不应该是account,而应该就是微信号
//因为刘伟那边api通讯用的主键都是微信号
//wehre 替换成刘哥扩展的whereNotExtra，这样不自己带company_id的查询条件
//20140917 陈
function getAccessToken($pubid)
{
    $options = array(
        'weixin_id' => $pubid
    );
    $weixinApi = new \Common\Library\Com\Util\WeixinAPI($options);
    $token = $weixinApi->getAccessToken();
    \Think\Log::write('获取获取获取' . $token, '', '', C('LOG_PATH') . 'wx_token_' . date('y_m_d') . '.log');
    return $token;

}


/**根据自定义条件查询平台appid
 * @param $where
 * @return mixed
 */
function getComponentAppid($where)
{
    if (!empty($where)) {
        $api = new \Common\Model\ApiDbManagerModel();
        $dsn = $api->getDsn('');
        $_company_db = "{$dsn['DB_TYPE']}://{$dsn['DB_USER']}:{$dsn['DB_PWD']}@{$dsn['DB_HOST']}:{$dsn['DB_PORT']}/{$dsn['DB_NAME']}";
        $pub_model = Mrx('Pub', 'rkylin_', $_company_db);
        $where['status'] = 1;
        $component_appid = $pub_model->whereNotExtra($where)->getField('component_appid');
        if (!empty($component_appid)) {
            return $component_appid;
        } else {
            \Think\Log::write('common.php中根据字段查平台appid返回值出错SQL=' . $pub_model->getLastSql());
        }
    } else {
        \Think\Log::write('common.php中根据字段查平台appid参数错误');
    }
    exit;
}

/**
 * 转换url
 * @param $urls
 * @param $account
 * @param string $remarks
 * @param string $scopes
 * @return mixed
 */
function formatUrl($urls, $account, $remarks = '备注', $scopes = '0')
{
    $api = new \Common\Model\ApiDbManagerModel();
    $dsn = $api->getDsn('');
    $_company_db = "{$dsn['DB_TYPE']}://{$dsn['DB_USER']}:{$dsn['DB_PWD']}@{$dsn['DB_HOST']}:{$dsn['DB_PORT']}/{$dsn['DB_NAME']}";
    $pub_model = Mrx('Pub', 'rkylin_', $_company_db);
    $service_type_info = $pub_model->whereNotExtra("pub_id='$account' and status=1")->getField("service_type_info");//从admin库查询服务号
    if ($service_type_info != 2) return $urls;
    $data['account'] = $account;
    $data['url'] = htmlspecialchars_decode($urls);
    $data['remark'] = htmlspecialchars_decode($remarks);
    $data['scope'] = htmlspecialchars_decode($scopes);
    $data['component_appid'] = getComponentAppid(array('account' => $account));
    $posturl = C('URL_NAME') . "RopSdk/response.php?id=59";
    $result = doCurlPostRequest($posturl, json_encode($data), 30);
    $json = json_decode(trim($result), true);
    \Think\Log::write('common.php转换url参数==' . json_encode($data));
    \Think\Log::write('common.php转换url返回==' . $result);
    if (isset($json['redirect_url'])) {
        $urlArr = explode(';|;', $urls);
        $resArr = explode(';|;', $json['redirect_url']);
        foreach ($urlArr as $key => $value) {
            if (preg_match('|([^/]*//[^/]*weixin\.qq\.com)|i', $urlArr[$key])) {
                $resArr[$key] = $urlArr[$key];
            }
        }
        $resStr = implode(';|;', $resArr);
        return $resStr;
    } else {
        return $urls;
    }
}

/**
 * 添加关键词
 * @param array $data
 * @return mixed
 */
function WxKeyWordAdd($data = array())
{
    G('WxKeyWordAdd_begin');
    $url = C('URL_NAME') . "RopSdk/response.php?id=50";
    $data['component_appid'] = getComponentAppid(array('account' => $data['account']));
    $result = doCurlPostRequest($url, json_encode($data));
    G('WxKeyWordAdd_end');
    \Think\Log::write("添加关键词用时=" . G('WxKeyWordAdd_begin', 'WxKeyWordAdd_end') . 's');
    \Think\Log::write($url . '添加关键词参数==' . json_encode($data));
    \Think\Log::write($url . '添加关键词返回==' . $result);
    $json = json_decode(trim($result), true);
    return $json;
}

/**
 * 删除关键词
 * @param array $data
 * @return mixed
 */
function WxKeyWordDelete($data = array())
{
    G('WxKeyWordDelete_begin');
    $url = C('URL_NAME') . "RopSdk/response.php?id=51";
    $data['component_appid'] = getComponentAppid(array('account' => $data['account']));
    $result = doCurlPostRequest($url, json_encode($data));
    G('WxKeyWordDelete_end');
    \Think\Log::write("删除关键词用时=" . G('WxKeyWordDelete_begin', 'WxKeyWordDelete_end') . 's');
    \Think\Log::write($url . '删除关键词参数==' . json_encode($data));
    \Think\Log::write($url . '删除关键词返回==' . $result);
    $json = json_decode(trim($result), true);
    return $json;
}


function get_option($num)
{
    if ($num == 0) {
        $option = 'A';
    } else if ($num == 1) {
        $option = 'B';
    } else if ($num == 2) {
        $option = 'C';
    } else if ($num == 3) {
        $option = 'D';
    } else if ($num == 4) {
        $option = 'E';
    } else if ($num == 5) {
        $option = 'F';
    } else if ($num == 6) {
        $option = 'G';
    } else if ($num == 7) {
        $option = 'H';
    }
    return $option;
}

function time2string($time)
{
    $time1 = strtotime($time);
    $time2 = strtotime(now);
    $second = $time1 - $time2;
    $day = floor($second / (3600 * 24));
    $second = $second % (3600 * 24);//除去整天之后剩余的时间
    $hour = floor($second / 3600);
    $second = $second % 3600;//除去整小时之后剩余的时间
    $minute = floor($second / 60);
    //$second = $second%60;//除去整分钟之后剩余的时间
    //返回字符串
    return $day . '天' . $hour . '小时' . $minute . '分';
}

// 字符串截取，支持中文和其他编码
function rx_substr($str, $length, $start = 0, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr")) {
        if ($suffix) {
            if ($str == mb_substr($str, $start, $length, $charset)) {
                return mb_substr($str, $start, $length, $charset);
            } else {
                return mb_substr($str, $start, $length, $charset) . "…";
            }
        } else {
            return mb_substr($str, $start, $length, $charset);
        }
    } elseif (function_exists('iconv_substr')) {
        if ($suffix) {
            if ($str == iconv_substr($str, $start, $length, $charset)) {
                return iconv_substr($str, $start, $length, $charset);
            } else {
                return iconv_substr($str, $start, $length, $charset) . "…";
            }
        } else {
            return iconv_substr($str, $start, $length, $charset);
        }
    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix) {
        return $slice . "…";
    }
    return $slice;
}


/**
 * 暂时只测试了一维数组的比较
 * @param $oldArr   旧数组
 * @param $newArr   新数组
 * @return array    数组差集
 * auth             闪电
 */
function arr_diff($oldArr, $newArr)
{
    $arr = array();
    $arr['del'] = array();//删除的元素
    $arr['add'] = array();//新增的元素
    $arr['all'] = array();//所有的差异元素
    //遍历旧数组
    foreach ($oldArr as $val) {
        if (!in_array($val, $newArr)) {
            $arr['del'][] = $val;
            $arr['all'][] = $val;
        }
    }
    //遍历新数组
    foreach ($newArr as $v) {
        if (!in_array($v, $oldArr)) {
            $arr['add'][] = $v;
            $arr['all'][] = $v;
        }
    }
    return $arr;
}

/**
 * 转换文件大小格式
 * @param $filesize
 * @return string
 */
function size_count($filesize, $style = '')
{
    //  根据要求改写
    if ($style == 'G') {
        $filesize = round($filesize / 1073741824 * 100) / 100 . ' G';
    } else if ($style == 'M') {
        $filesize = round($filesize / 1048576 * 100) / 100 . ' M';
    } else if ($style == 'K') {
        $filesize = round($filesize / 1024 * 100) / 100 . ' K';
    } else {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' G';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' M';
        } elseif ($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' K';
        } else {
            $filesize = $filesize . ' bytes';
        }
    }
    return $filesize;
}

function get_broadcast_info($id, $tid)
{
    if ($tid == 1)
        $info = Mrx("Text")->find($id);
    else if ($tid == 3)
        $info = Mrx("image_text")->find($id);
    else if ($tid == 4)
        $info = Mrx("Sound")->find($id);
    else if ($tid == 5)
        $info = Mrx("Video")->find($id);
    echo $info['title'];
}

/**
 * 实例化一个没有模型文件的Model，此方法与框架中的M的不同在于，此方法是以Common\Model\RxModel为基础进行实例化
 * @param string $name Model名称 支持指定基础模型 例如 MongoModel:User
 * @param string $tablePrefix 表前缀
 * @param mixed $connection 数据库连接信息
 * @return Model
 */
function Mrx($name = '', $tablePrefix = '', $connection = '')
{
    if (strpos($name, ':')) {
        list($class, $name) = explode(':', $name);
    } else {
        $class = 'Common\Library\Model\RxModel';
    }
    return M($class . ':' . $name, $tablePrefix, $connection);
}

/**
 * 实例化模型类 格式 [资源://][模块/]模型，此方法与框架中的D方法不同之处在于，如果模型不存在，则实例化Common\Model\Rxmodel类
 * @param string $name 资源地址
 * @param string $layer 模型层名称
 * @return Model
 */
function Drx($name = '', $layer = '')
{
    if (empty($name)) return new Common\Library\Model\RxModel();
    static $_model = array();
    $layer = $layer ?: C('DEFAULT_M_LAYER');
    if (isset($_model[$name . $layer]))
        return $_model[$name . $layer];
    $class = parse_res_name($name, $layer);
    if (class_exists($class)) {
        $model = new $class(basename($name));
    } elseif (false === strpos($name, '/')) {
        // 自动加载公共模块下面的模型
        if (!C('APP_USE_NAMESPACE')) {
            import('Common/' . $layer . '/' . $class);
        } else {
            $class = '\\Common\\' . $layer . '\\' . $name . $layer;
        }
        $model = class_exists($class) ? new $class($name) : new Common\Library\Model\RxModel($name);
    } else {
        \Think\Log::write('D方法实例化没找到模型类' . $class, Think\Log::NOTICE);
        $model = new Common\Library\Model\RxModel(basename($name));
    }
    $_model[$name . $layer] = $model;
    return $model;
}


/**
 * @param $model 模型对象
 * @param $name 地区名称
 * @param $type 地区类型（1国家，2省，3市）
 * @return mixed 返回地区编号
 */

function getCityCode($model, $name, $type)
{
    $map['name'] = array('like', "%" . $name . "%");
    $map['type'] = $type;
    $code = $model->whereNotExtra($map)->getField('id');
    \Think\Log::write('获取地区【' . $name . '】的code==' . $code);
    \Think\Log::write('获取地区code的SQL==' . $model->getLastSql());
    return $code;
}

/**
 * @param $url      请求的地址
 * @param $json     提交的数据
 * @param string $type 请求类型
 * @param string $out_type 输出格式是否为json格式
 * @return mixed
 */
function customCurlRequest($url, $json, $type = 'POST', $out_type = 'json', $timeout = 10)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, (int)$timeout);
    if ($out_type == 'json') {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json))
        );
    }
    $result = curl_exec($ch);
    return $result;
}

/**
 * 获取客户端IP
 * @return string
 */
function getClientIp()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return $ip;
}

/**
 * 判断是否为json格式
 * @param $json
 * @return bool true:是
 */
function is_json($json)
{
    return !is_null(json_decode($json));
}

//校验rop小程的下发消息，isv授权，取消授权等的握手验证
//crg 20160503
function checkRopSignature()
{

    $token = C('ROPSIGNATURE_TOKEN');

    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];

    $tmpArr = array($token, $timestamp, $nonce);
    // use SORT_STRING rule
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode($tmpArr);
    $tmpStr = sha1($tmpStr);

    if ($tmpStr == $signature) {
        return true;
    } else {
        return false;
    }

}

 function model_http_curl_get($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)');
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

