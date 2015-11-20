<?php
	$dataConnection = require "../lib/db.php";

	function toArray($mysqliResult) {
		$output = array();
		while($row = $mysqliResult->fetch_assoc())
			array_push($output, $row);
		return $output;

	}



	function loader($lastId,$stepBy) {
		global $dataConnection;
		$query = "SELECT title,created,updated,author,price,IF(votings > 0,score/votings,0) AS avg
				  FROM document WHERE id > ?
				  LIMIT ?";
		$tquery = "SELECT * FROM test WHERE id > ? LIMIT ?";
		$stmnt = $dataConnection->prepare($tquery);
		$stmnt->bind_param("ii",$lastId,$stepBy);
		$stmnt->execute();
		$result = $stmnt->get_result();
		return toArray($result);
	}


	$lId = $_GET['start'];
	$iBy = $_GET['by'];

	echo json_encode(loader($lId,$iBy));