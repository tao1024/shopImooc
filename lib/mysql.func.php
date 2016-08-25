<?php
require_once '../configs/configs.php';
/**
 * 连接数据库
 */
function connect() {
	$link = mysql_connect(DB_HOST, DB_USER, DB_PWD) or die("数据库连接失败Error:" . mysql_errno() . ":" . mysql_error());
	mysql_set_charset(DB_CHARSET);
	mysql_select_db(DB_DBNAME) or die("指定数据库打开失败");
	return $link;
}
//connect();

/**
 * 完成记录插入的操作
 */
function insert($table, $array) {
	$keys = join(",", array_keys($array));
	$vals = "'" . join("','", array_values($array)) . "'";
	$sql = "insert {$table}($keys) values({$vals})";
	mysql_query($sql);
	return mysql_insert_id();
}
// 比如：insert("dd",array('a','b','c'));---->打印出$sql：insert dd(0,1,2) values('a','b','c')
//sql样本：


/**
 * 记录的更新操作
 */
function update($table, $array, $where = null) {
	foreach ($array as $key => $val) {
		if ($str == null) {
			$sep = "";
		} else {
			$sep = ",";
		}
		$str .= $sep . $key . "='" . $val . "'";
	}
	$sql = "update {$table} set {$str} " . ($where == null ? null : " where " . $where);
	$result = mysql_query($sql);
	if ($result) {
		return mysql_affected_rows();
	} else {
		return false;
	}
}
//sql样本：update imooc_admin set username='king' where id=1

/**
 *	删除记录
 */
function delete($table, $where = null) {
	$where = $where == null ? null : " where " . $where;
	$sql = "delete from {$table} {$where}";
	mysql_query($sql);
	return mysql_affected_rows();
}
//sql样本：

/**
 *得到指定一条记录
 */
function fetchOne($sql, $result_type = MYSQL_ASSOC) {
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result, $result_type);
	return $row;
}
//sql样本：

/**
 * 得到结果集中所有记录
 */
function fetchAll($sql, $result_type = MYSQL_ASSOC) {
	$result = mysql_query($sql);
	while (@ $row = mysql_fetch_array($result, $result_type)) {
		$rows[] = $row;
	}
	return $rows;
}
//sql样本：

/**
 * 得到结果集中的记录条数
 */
function getResultNum($sql) {
	$result = mysql_query($sql);
	return mysql_num_rows($result);
}
//sql样本：

/**
 * 得到上一步插入记录的ID号
 */
function getInsertId() {
	return mysql_insert_id();
}
//sql样本：
?>
