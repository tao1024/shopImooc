<?php
require_once '../lib/mysql.func.php';
require_once '../lib/common.php';
/**
 * 检查管理员是否存在
 */
function checkAdmin($sql){
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
function checkLogined(){
	if($_SESSION['adminName']==""&&$_COOKIE['adminName']==""){
		alertMes("请先登陆","login.php");
	}
}
?>
