<?php

class RopAPI
{
    protected $sdk_client;
    protected $sdk_session;

    public function __construct($customConfig = null)
    {
        date_default_timezone_set('Asia/Shanghai'); //设置中国时区
        include_once dirname(__FILE__) . '/RopSdk.php';
        $this->sdk_client = new RopClient;
        $this->sdk_client->appkey = C('ROPSDK_APPKEY');//瑞雪分配的appkey
        $this->sdk_client->secretKey = C('ROPSDK_APPSECRET');//瑞雪分配的secretKey
        $this->sdk_client->gatewayUrl = C('ROPSDK_GATEWAYURL') ;//api调用地址
        $this->sdk_client->format = 'json';
        //print_r($config);
        $sdk_req = new ExternalSessionGetRequest;
        $sdk_resp = $this->sdk_client->execute($sdk_req);
        if (!empty($sdk_resp->session)) {
            $this->sdk_session = $sdk_resp->session;
        } else {
            $this->sdk_session = '12345';//没有校验，session为空给死值
        }
    }



    //发送微信客服消息
    public function send_wx_customer_sms($data)
    {
        $req = new HfiveWeixinCsmSendRequest();
        $req->setAccount($data['account']);
        $req->setId($data['id']);
        $req->setType($data['type']);
        $req->setOpenids(json_encode($data['openids']));//注意这里需要的是字符串，所以必须用json_encode,把数组格式进行转换。
        $req->setContent($data['content']);

        $result_obj = $this->sdk_client->execute($req,$this->sdk_session);
        //返回的是对象，需要先转化为json，然后转换为数组
        $result_array = json_decode(json_encode($result_obj), true);

        return $result_array;

    }


    /**
     * 执行api
     *
     * @param $req
     * @return mixed
     */
    public function executeApi($req)
    {
        $row = $this->sdk_client->execute($req, $this->sdk_session);
        $row_array = json_decode(json_encode($row), true);
        return $row_array;
    }
}
