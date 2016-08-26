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
	$sql="select * from imooc_admin where username='{$username}' and password='{$password}'";
//	sql样本：$sql="select * from imooc_admin where username='king' and password='b2086154f101464aab3328ba7e060deb''";
	$res = checkAdmin($sql);
	var_dump($res);
	if($res){
		$_SESSION['adminName']=$row['username'];
		header("location:index.php");
	}else{
		echo "<script>alert('登录失败');</script>";
		echo "<script>window.location='login.php';</script>";
	}
}else{
	echo "<script>alert('验证码错误');</script>";
	echo "<script>window.location='login.php';</script>";
}
?>
