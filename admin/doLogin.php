<?php
header("Content-type: text/html; charset=utf-8");
require_once '../core/admin.inc.php';
require_once '../lib/mysql.func.php';

connect();
session_start();
$username = $_POST['username'];
$password = md5($_POST['password']);
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];

//echo $username.$password.$verify;
if($verify == $verify1){
	$sql="select * from imooc_admin where username='{$username}' and password='{$password}'";//sql语句不要以分号结尾，
	$res = checkAdmin($sql);
//	var_dump($res);
	if($res){
		$_SESSION['adminName']=$res['username'];
		alertMes("登录成功","index.php");
	}else{
		alertMes("登录失败","login.php");
	}
}else{
	alertMes("验证码错误","login.php");
}
?>
