<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM faculty_list where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
$asd = "true";

include 'new_teacher.php';
?>