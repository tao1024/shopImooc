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
	$res = checkAdmin($sql);
	var_dump($res);
	if($res){
		$_SESSION['adminName']=$res['username'];
		alertMes("��¼�ɹ���","index.php");
	}else{
		alertMes("��¼ʧ�ܣ�","login.php");
	}
}else{
	alertMes("��֤�����","login.php");
}
?>
