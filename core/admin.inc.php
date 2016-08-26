<?php
require_once '../lib/mysql.func.php';
/**
 * 检查管理员是否存在
 */
 function checkAdmin($sql){
 	return fetchOne($sql);
 }
?>
