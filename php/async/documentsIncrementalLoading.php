<?php
	require "../lib/core.php";
	$dataConnection = require "../lib/db.php";


	function loader($lastId,$stepBy,$tags) {
		global $dataConnection;
		$query = "SELECT DISTINCT D.id,D.title,F.path,D.score,D.votings,D.price
				  FROM document D
				  INNER JOIN tagship ON D.id = document
				  INNER JOIN file F ON F.id = cover
				  WHERE D.id > $lastId AND D.available = 1 AND ( tag = {$tags[0]} ";

		foreach($tags as $tag) {
			$query.= "OR tag=$tag ";
		}

		$query.= ") LIMIT $stepBy";

		$result = $dataConnection->query($query);
		return toArray($result);
	}


	$lId = $_GET['start'];
	$iBy = $_GET['by'];
	$tags = $_GET['tag'];
	$decodedTags = json_decode($tags);

	echo json_encode(loader($lId,$iBy,$decodedTags));