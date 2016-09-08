<?php
require_once 'mysql.func.php';


/*connect();
showPage(3, 2);

function showPage($pageSize, $page) {
	$sql = "select * from imooc_admin";
	$totalRows = getResultNum($sql);
	echo '总条数：' . $totalRows . '<br/>';
	//得到总页数
	$totalPage = ceil($totalRows / $pageSize);
	echo '总页数：' . $totalPage . '<br/>';
	//$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : 1;
	if ($page < 1 || $page == null || !is_numeric($page)) {
		$page = 1;
	}
	if ($page >= $totalPage) {
		$page = $totalPage;
	}

	$offset = ($page -1) * $pageSize; //从第几条开始
	echo 'offset：' . $offset . '<br/>';
	$sql = "select * from imooc_admin limit {$offset},{$pageSize}";
	echo 'sql：' . $sql . '<br/>';
	$rows = fetchAll($sql);
	print_r($rows);
	echo '<br/>';
	foreach ($rows as $row) {
		echo "编号：" . $row['id'], "<br/>";
		echo "管理员的名称:" . $row['username'], "<hr/>";
	}
}*/


function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
	$where=($where==null)?null:"&".$where;
	$url = $_SERVER ['PHP_SELF'];//$_SERVER['PHP_SELF'] 表示当前 php 文件相对于网站根目录的位置地址
	$index = ($page == 1) ? "首页" : "<a href='{$url}?page=1{$where}'>首页</a>";
	$last = ($page == $totalPage) ? "尾页" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
	$prevPage=($page>=1)?$page-1:1;
	$nextPage=($page>=$totalPage)?$totalPage:$page+1;
	$prev = ($page == 1) ? "上一页" : "<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
	$next = ($page == $totalPage) ? "下一页" : "<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";
	$str = "总共{$totalPage}页/当前是第{$page}页";
	$p = null;
	for($i = 1; $i <= $totalPage; $i ++) {
		//当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
		}
	}
 	$pageStr=$str.$sep . $index .$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
 	return $pageStr;
}
?>
