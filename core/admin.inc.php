<?php
require_once '../lib/mysql.func.php';
require_once '../lib/common.php';
/**
 * 检查管理员是否存在
 */
function checkAdmin($sql) {
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
function checkLogined() {
	if (isset ($_SESSION['adminName'])) {
		if ($_SESSION['adminName'] == "") {
			alertMes("请先登陆", "login.php");
		}
	} else
		if (isset ($_COOKIE['adminId'])) {
			if ($_COOKIE['adminId'] == "") {
				alertMes("请先登陆", "login.php");
			}
		} else {
			alertMes("请先登陆", "login.php");
		}
}
/**
 * 注销
 */
function logout() {
	session_start(); //此行代码不能省略
	$_SESSION = array ();
	if (isset ($_COOKIE[session_name()])) {
		setcookie(session_name(), "", time() - 1);
	}
	if (isset ($_COOKIE['adminId'])) {
		setcookie('adminId', "", time() - 1);
	}
	if (isset ($_COOKIE['adminName'])) {
		setcookie('adminName', "", time() - 1);
	}

	session_destroy();
	header("location:login.php");
}
/**
 * 添加管理员
 */
function addAdmin() {
	$arr = $_POST;
	$arr['password'] = md5($_POST['password']);
	if (insert("imooc_admin", $arr)) {
		$mes = "添加成功<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	} else {
		$mes = "添加失败<br/><a href='addAdmin.php'>重新添加</a>";
	}

	return $mes;
}
/**
 * 修改管理员信息
 */
function editAdmin($id) {
	$arr = $_POST;
	$arr['password'] = md5($_POST['password']);
	if (update("imooc_admin", $arr, "id={$id}")) {
		$mes = "编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	} else {
		$mes = "编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
	}
	return $mes;
}
/**
 * 删除管理员的操作
 */
function delAdmin($id) {
	if (delete("imooc_admin", "id={$id}")) {
		$mes = "删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	} else {
		$mes = "删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
	}
	return $mes;
}

/**
 * 获得所有管理员信息
 */
function getAllAdmin() {
	$sql = "select id,username,email from imooc_admin";
	$rows = fetchAll($sql);
	return $rows;
}

/**
 * 根据分页获得所有管理员信息
 */
function getAdminByPage($page, $pageSize = 2) {
	$sql = "select * from imooc_admin";
	global $totalRows;
	$totalRows = getResultNum($sql);
	global $totalPage;
	$totalPage = ceil($totalRows / $pageSize);
	if ($page < 1 || $page == null || !is_numeric($page)) {
		$page = 1;
	}
	if ($page >= $totalPage)
		$page = $totalPage;
	$offset = ($page -1) * $pageSize;
	$sql = "select id,username,email from imooc_admin limit {$offset},{$pageSize}";
	$rows = fetchAll($sql);
	return $rows;
}
?>
