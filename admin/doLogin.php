<?php
header("Content-type: text/html; charset=utf-8");
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];
echo $username.$password.$verify;
if($verify == $verify1){
	echo "验证码输入正确";
}else{
	echo "<script>alert('验证码错误');</script>";
}
?>
