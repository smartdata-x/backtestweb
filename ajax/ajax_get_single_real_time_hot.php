<?php
/**
 * 获取股票页面实时热度
 */

require_once(dirname(__FILE__) . "/../common/Request.class.php");
require_once(dirname(__FILE__) . "/../common/iwookongConfig.class.php");
require_once(dirname(__FILE__) . "/../common/CheckUserLogin.class.php");
if (CheckLogin::check() == -1) {
    print_r(json_encode(array("status" => -1, "result" => "未知登录状态")));
    return;
}
$stockCode = isset($_POST['stock']) ? $_POST['stock'] : "";
//获取实时热度
$real_timehot_result = RequestUtil::get(iwookongConfig::$requireUrl . "stock/1/single_real_time_hot.fcgi",
    array(
        "user_id" => $_SESSION['user_id'],
        "token" => $_SESSION["token"],
        "stock_code" => $stockCode . ","
    ));
$json_rtr = json_decode($real_timehot_result, true);
if ($json_rtr['status'] != "0") {
    print_r($real_timehot_result);
    return;
} else {
    if ($json_rtr['msg'] == "权限不够") {
        print_r(json_encode(array("status" => -100, "result" => $json_rtr['msg'])));
    } else {
        print_r(json_encode(array("status" => 0, "result" => $json_rtr['msg'])));
        return;
    }
}
