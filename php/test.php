<?php
	$db = require "./lib/db.php";

	function toArray($result) {
		$rows = array();

		while($row = $result->fetch_assoc())
			array_push($rows, $row);
		return $rows;
	}

	function incremental($size,$start) {
		global $db;
		$stmnt = $db->prepare("SELECT * FROM test WHERE id > ? LIMIT ?");
		$stmnt->bind_param("ii",$start,$size);
		$stmnt->execute();

		$result = $stmnt->get_result();
		return toArray($result);
	}


	$howMuch =$_GET['hw'];
	$fromWhere = $_GET['fw'];
	$rows = incremental($howMuch,$fromWhere); 
	$jsoned = json_encode($rows);
	echo $jsoned;