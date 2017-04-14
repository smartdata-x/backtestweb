<?php
/**
 * Description: 首页搜索自动提示
 * op 0全部  1股票
 */
require_once(dirname(__FILE__) . "/../../common/Request.class.php");
require_once(dirname(__FILE__) . "/../../common/iwookongConfig.class.php");
require_once(dirname(__FILE__) . "/../../common/CheckUserLogin.class.php");
if (CheckLogin::check() == -1) {
    print_r(json_encode(array("status" => -1, "result" => "未知登录状态")));
    return;
}
$mac_adr=getallheaders(); //获取header头信息
$mac_adr=isset($mac_adr['uuid']) ? $mac_adr['uuid'] : ""; //mac地址
$message = isset($_GET["message"]) ? $_GET["message"] : "";
$type = isset($_GET["type"]) ? 0  : 1; //0所有类型 1股票
if (empty($message)) {
    print_r(json_encode(array("status" => 0, "result" => "搜索关键字为空")));
    return;
}
//$url=iwookongConfig::$requireUrl."search/1/search.fcgi";
$url="http://61.147.114.67/cgi-bin/luyao/wookong/search/search.fcgi";
$result = RequestUtil::get($url,
    array(
        "user_id" => $_SESSION['user_id'],
        "token" => $_SESSION["token"],
        "uuid"  => $mac_adr,
        "message" => $message,
        "op" => $type
    ));
print_r($result);