<?php
require_once 'mysql.func.php';
connect();
$sql = "select * from imooc_admin";
$totalRows = getResultNum($sql);
echo '总条数：' . $totalRows . '<br/>';
$pageSize = 2;
//得到总页数
$totalPage = ceil($totalRows / $pageSize);
echo '总页数：' . $totalPage . '<br/>';
//$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : 1;
$page = 3;
if ($page < 1 || $page == null || !is_numeric($page)) {
	$page = 1;
}
if ($page >= $totalPage){
	$page = $totalPage;
}

$offset = ($page -1) * $pageSize;//从第几条开始
echo 'offset：' . $offset . '<br/>';
$sql = "select * from imooc_admin limit {$offset},{$pageSize}";
echo 'sql：' . $sql . '<br/>';
$rows = fetchAll($sql);
print_r($rows);
echo  '<br/>';
foreach ($rows as $row) {
	echo "编号：" . $row['id'], "<br/>";
	echo "管理员的名称:" . $row['username'], "<hr/>";
}
//echo showPage($page, $totalPage);
//echo "<hr/>";
//echo showPage($page, $totalPage, "cid=5&pid=6");
?>
