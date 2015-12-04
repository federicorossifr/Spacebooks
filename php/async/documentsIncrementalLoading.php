<?php
	require "../lib/core.php";
	$dataConnection = require "../lib/db.php";


	function loader($lastId,$stepBy,$tag) {
		global $dataConnection;
		$query = "SELECT D.id,D.title,F.path,D.score,D.votings,D.price
				  FROM document D
				  INNER JOIN tagship ON D.id = document
				  INNER JOIN file F ON F.id = cover
				  WHERE D.id > ?
				  AND tag = ?
				  LIMIT ?";
		$stmnt = $dataConnection->prepare($query);
		$stmnt->bind_param("iii",$lastId,$tag,$stepBy);
		$stmnt->execute();
		$result = $stmnt->get_result();
		return toArray($result);
	}


	$lId = $_GET['start'];
	$iBy = $_GET['by'];
	$tag = $_GET['tag'];

	echo json_encode(loader($lId,$iBy,$tag));