<?php
/**
 * 加载sdk包以及错误代码包
 */
 class OssUploadUtil {


/**
 * 函数定义
 */
/*%**************************************************************************************************************%*/
// Service 相关

//获取bucket列表
function get_service($obj){
	$response = $obj->list_bucket();
	_format($response);
}

/*%**************************************************************************************************************%*/
// Bucket 相关

//创建bucket
function create_bucket($obj){
	$bucket = 'gfceshi1';
	//$acl = ALIOSS::OSS_ACL_TYPE_PRIVATE;
	$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ;
	//$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ_WRITE;
	
	$response = $obj->create_bucket($bucket,$acl);
	_format($response);
}

//删除bucket
function delete_bucket($obj){
	$bucket = 'phpsdk1349849369';
	
	$response = $obj->delete_bucket($bucket);
	_format($response);
}

//设置bucket ACL
function set_bucket_acl($obj){
	$bucket = 'phpsdk1349849394';
	//$acl = ALIOSS::OSS_ACL_TYPE_PRIVATE;
	//$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ;
	$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ_WRITE;
	
	$response = $obj->set_bucket_acl($bucket,$acl);
	_format($response);
}

//获取bucket ACL
function get_bucket_acl($obj){
	$bucket = 'phpsdk1349849394';
	$options = array(
		ALIOSS::OSS_CONTENT_TYPE => 'text/xml',
	);
		
	$response = $obj->get_bucket_acl($bucket,$options);
	_format($response);	
}

//设置bucket logging
function  set_bucket_logging($obj){
	$bucket = 'phpsdk1349849394';
	$target_bucket='backet2';
	$target_prefix='test';
	
	$response = $obj->set_bucket_logging($bucket,$target_bucket,$target_prefix);
	_format($response);	
}

//获取bucket logging
function  get_bucket_logging($obj){
	$bucket = 'phpsdk1349849394';
	
	$response = $obj->get_bucket_logging($bucket);
	_format($response);	
}

//删除bucket logging
function  delete_bucket_logging($obj){
	$bucket = 'phpsdk1349849394';
	
	$response = $obj->delete_bucket_logging($bucket);
	_format($response);	
}

//设置bucket website
function  set_bucket_website($obj){
	$bucket = 'phpsdk1349849394';
	$index_document='index.html';
    $error_document='error.html';
	
    $response = $obj->set_bucket_website($bucket,$index_document,$error_document);
	_format($response);	
}

//获取bucket website
function  get_bucket_website($obj){
	$bucket = 'phpsdk1349849394';
	
	$response = $obj->get_bucket_website($bucket);
	_format($response);	
}

//删除bucket website
function  delete_bucket_website($obj){
	$bucket = 'phpsdk1349849394';
	
	$response = $obj->delete_bucket_website($bucket);
	_format($response);	
}

/*%**************************************************************************************************************%*/
//跨域资源共享(CORS)

//设置bucket cors
function  set_bucket_cors($obj){
	$bucket = 'phpsdk1349849394';
	
	$cors_rule[ALIOSS::OSS_CORS_ALLOWED_HEADER]=array("x-oss-test");
	$cors_rule[ALIOSS::OSS_CORS_ALLOWED_METHOD]=array("GET");
	$cors_rule[ALIOSS::OSS_CORS_ALLOWED_ORIGIN]=array("http://www.b.com");
	$cors_rule[ALIOSS::OSS_CORS_EXPOSE_HEADER]=array("x-oss-test1");
	$cors_rule[ALIOSS::OSS_CORS_MAX_AGE_SECONDS] = 10;
	$cors_rules=array($cors_rule);
	
    $response = $obj->set_bucket_cors($bucket, $cors_rules);
	_format($response);	
}

//获取bucket cors
function  get_bucket_cors($obj){
	$bucket = 'phpsdk1349849394';
	
	$response = $obj->get_bucket_cors($bucket);
	_format($response);	
}

//删除bucket cors
function  delete_bucket_cors($obj){
	$bucket = 'phpsdk1349849394';
	
	$response = $obj->delete_bucket_cors($bucket);
	_format($response);	
}

//options object
function  options_object($obj){
	$bucket = 'phpsdk1349849394';
	$object='1.jpg';
	$origin='http://www.b.com';
	$request_method='GET';
	$request_headers='x-oss-test';
	
	$response = $obj->options_object($bucket, $object, $origin, $request_method, $request_headers);
	_format($response);	
}

/*%**************************************************************************************************************%*/
// Object 相关

//获取object列表
function list_object($obj){
	$bucket = 'invalidxml3';
	$options = array(
		'delimiter' => '/',
		'prefix' => '',
		'max-keys' => 10,
		//'marker' => 'myobject-1330850469.pdf',
	);
	
	$response = $obj->list_object($bucket,$options);	
	_format($response);
}

//创建目录
function create_directory($obj){
	$bucket = '1e59d76464844f779db10eb953e55dbc';
	//$dir = '"><img src=\"#\" onerror=alert(\/';
	$dir = 'myfoll////';
	
	$response  = $obj->create_object_dir($bucket,$dir);
	_format($response);
}

//通过路径上传图片
function upload_by_content($bucket, $apiParams, $file_path){
	@session_start();
	$accessId = $apiParams['accessId'] == '' ? '1Mq5RScP2vBwHO6A':$apiParams['accessId'];
	$secretId = $apiParams['secretId'] == '' ? '0En7RBmiUtj84IBoC3lXFaMP9EpJIa':$apiParams['secretId'];
	
	@define('OSS_ACCESS_ID', $accessId);
	@define('OSS_ACCESS_KEY', $secretId);

	$_SESSION['OSS_DATEX'] = $apiParams['date'];
	$_SESSION['OSS_SIGN'] = $apiParams['sign'];

	require_once 'AliyunOpenServices/sdk.class.php';

	$obj = new ALIOSS();

		$bucket = $bucket;
		$object = $bucket."/".$apiParams['cosFile'];
		$bucket = $apiParams['bucketId'];
	//	$object = $apiParams['cosFile'];


		$content  = file_get_contents($file_path);
		/**
	    for($i = 1;$i<100;$i++){
			$content .= $i;
		}
		*/
	    
		$upload_file_options = array(
			'content' => $content,
			'length' => strlen($content),
//			ALIOSS::OSS_HEADERS => array(
//				'Expires' => '2022-10-01 08:00:00',
//			),
		);
		
		$response = $obj->upload_file_by_content($bucket,$object,$upload_file_options);	

		//echo 'upload file {'.$object.'}'.($response->isOk()?'ok':'fail')."\n";
	if($response->isOk() == 'ok')
	{
		$arr['code'] = 0;
		$arr['msg'] = '成功';
	}
	else{
		$arr['code'] = $response->code;
		$arr['msg'] = $response->msg;
	}

return $arr;
	//_format($response);
}

//通过内容上传图片
function upload_by_pic_content($bucket, $apiParams, $picturestream){
	@session_start();
	$accessId = $apiParams['accessId'] == '' ? '1Mq5RScP2vBwHO6A':$apiParams['accessId'];
	$secretId = $apiParams['secretId'] == '' ? '0En7RBmiUtj84IBoC3lXFaMP9EpJIa':$apiParams['secretId'];
	
	@define('OSS_ACCESS_ID', $accessId);
	@define('OSS_ACCESS_KEY', $secretId);

	$_SESSION['OSS_DATEX'] = $apiParams['date'];
	$_SESSION['OSS_SIGN'] = $apiParams['sign'];

	require_once 'AliyunOpenServices/sdk.class.php';

	$obj = new ALIOSS();

		$bucket = $bucket;
		$object = $bucket."/".$apiParams['cosFile'];
		$bucket = $apiParams['bucketId'];
	//	$object = $apiParams['cosFile'];


		$content  = $picturestream;
		/**
	    for($i = 1;$i<100;$i++){
			$content .= $i;
		}
		*/
	    
		$upload_file_options = array(
			'content' => $content,
			'length' => strlen($content),
//			ALIOSS::OSS_HEADERS => array(
//				'Expires' => '2022-10-01 08:00:00',
//			),
		);
		
		$response = $obj->upload_file_by_content($bucket,$object,$upload_file_options);	
		
		//echo 'upload file {'.$object.'}'.($response->isOk()?'ok':'fail')."\n";
	if($response->isOk() == 'ok')
	{
		$arr['code'] = 0;
		$arr['msg'] = '成功';
	}
	else{
		$arr['code'] = $response->code;
		$arr['msg'] = $response->msg;
	}
return $arr;
	//_format($response);
}

//通过路径上传文件
function upload_by_file($bucket, $apiParams, $file_path){
$accessId = $apiParams['accessId'] == '' ? '1Mq5RScP2vBwHO6A':$apiParams['accessId'];
$secretId = $apiParams['secretId'] == '' ? '0En7RBmiUtj84IBoC3lXFaMP9EpJIa':$apiParams['secretId'];
define('OSS_ACCESS_ID', $accessId);
//ACCESS_KEY
define('OSS_ACCESS_KEY', $secretId);

define('OSS_DATEX', $apiParams['date']);
define('OSS_SIGN', $apiParams['sign']);
require_once 'AliyunOpenServices/sdk.class.php';

$obj = new ALIOSS();

//设置是否打开curl调试模式
$obj->set_debug_mode(FALSE);
try{

	$bucket = $bucket;
	//$bucket = '1e59d76464844f779db10eb953e55dbc';
	$object = $apiParams['cosFile'];
	$file_path = $file_path;
	

	$response = $obj->upload_file_by_file($bucket,$object,$file_path);
	
	$this->_format($response);
	
}catch (Exception $ex){
	die($ex->getMessage());
}
}

//拷贝object
function copy_object($obj){
		//copy object
		$from_bucket = 'invalidxml';
		$from_object = '&#26;&#26;_100.txt';
		$to_bucket = 'invalidxml';
		$to_object = '&#26;&#26;_100.txt';
		$options = array(
			'content-type' => 'application/json',
		);

		$response = $obj->copy_object($from_bucket,$from_object,$to_bucket,$to_object,$options);
		_format($response);
}

//获取object meta
function get_object_meta($obj){
	$bucket = 'invalidxml';
	$object = '&#26;&#26;_100.txt'; 

	$response = $obj->get_object_meta($bucket,$object);
	_format($response);
}

//删除object
function delete_object($obj){
	$bucket = 'invalidxml';
	$object = '&#26;&#26;_100.txt'; 
	$response = $obj->delete_object($bucket,$object);
	_format($response);
}

//删除objects
function delete_objects($obj){
	$bucket = 'phpsdk1349849394';
	$objects = array('myfoloder-1349850940/','myfoloder-1349850941/',);   
	
	$options = array(
		'quiet' => false,
		//ALIOSS::OSS_CONTENT_TYPE => 'text/xml',
	);
	
	$response = $obj->delete_objects($bucket,$objects,$options);
	_format($response);
}

//获取object
function get_object($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh'; 
	
	$options = array(
		ALIOSS::OSS_FILE_DOWNLOAD => "d:\\cccccccccc.sh",
		//ALIOSS::OSS_CONTENT_TYPE => 'txt/html',
	);	
	
	$response = $obj->get_object($bucket,$object,$options);
	_format($response);
}

//检测object是否存在
function is_object_exist($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh';  
							
	$response = $obj->is_object_exist($bucket,$object);
	_format($response);
}

//通过multipart上传文件
function upload_by_multi_part($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'Mining.the.Social.Web-'.time().'.pdf';  //英文
	$filepath = "D:\\Book\\Mining.the.Social.Web.pdf";  //英文
		
	$options = array(
		ALIOSS::OSS_FILE_UPLOAD => $filepath,
		'partSize' => 5242880,
	);

	$response = $obj->create_mpu_object($bucket, $object,$options);
	_format($response);
}

//通过multipart上传整个目录
function upload_by_dir($obj){
	$bucket = 'phpsdk1349849394';
	$dir = "D:\\alidata\\www\\logs\\aliyun.com\\oss\\";
	$recursive = false;
	
	$response = $obj->create_mtu_object_by_dir($bucket,$dir,$recursive);
	var_dump($response);	
}

//通过multi-part上传整个目录(新版)
function batch_upload_file($obj){
	$options = array(
		'bucket' 	=> 'phpsdk1349849394',
		'object'	=> 'picture',
		'directory' => 'D:\alidata\www\logs\aliyun.com\oss',
	);
	$response = $obj->batch_upload_file($options);
}



/*%**************************************************************************************************************%*/
// 签名url 相关

//生成签名url,主要用户私有权限下的访问控制
function get_sign_url($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh';
	$timeout = 3600;

	$response = $obj->get_sign_url($bucket,$object,$timeout);
	var_dump($response);
}

/*%**************************************************************************************************************%*/
// 结果 相关

//格式化返回结果
function _format($response) {
	echo '|-----------------------Start---------------------------------------------------------------------------------------------------'."\n";
	echo '|-Status:' . $response->status . "\n";
	echo '|-Body:' ."\n"; 
	echo $response->body . "\n";
	echo "|-Header:\n";
	print_r ( $response->header );
	echo '-----------------------End-----------------------------------------------------------------------------------------------------'."\n\n";
}

}



