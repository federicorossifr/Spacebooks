<?php
	require "../lib/core.php";
	session_start();
	$dataConnection = require "../lib/db.php";


	function loader($lastId,$stepBy) {
		global $dataConnection;

		$tags = $_GET['tag'];
		$decodedTags = json_decode($tags);
		if(!$decodedTags) {echo "[]"; return;}


		$query = "SELECT DISTINCT D.id,D.title,F.path,D.score,D.votings,D.price
				  FROM document D
				  INNER JOIN tagship ON D.id = document
				  INNER JOIN file F ON F.id = cover
				  WHERE D.id > $lastId AND D.available = 1 AND ( tag = {$decodedTags[0]} ";

		foreach($decodedTags as $tag) {
			$query.= "OR tag=$tag ";
		}

		$query.= ") LIMIT $stepBy";

		$result = $dataConnection->query($query);
		return toArray($result);
	}


	function purchaseLoader($lastId,$stepBy) {
		global $dataConnection;
		$purchaserId = $_SESSION['user']->id;
		$query = "SELECT DISTINCT D.id,D.title,F.path,D.score,D.votings,D.price
				  FROM document D
				  INNER JOIN purchase ON D.id = document AND purchaser = $purchaserId
				  INNER JOIN file F ON F.id = cover
				  WHERE D.id > $lastId LIMIT $stepBy";
		$result = $dataConnection->query($query);
		return toArray($result);
	}


	$lId = $_GET['start'];
	$iBy = $_GET['by'];
	$act = $_GET['action'];


	switch ($act) {
		case '1':
			echo json_encode(loader($lId,$iBy));
			break;

		case '2':
			echo json_encode(purchaseLoader($lId,$iBy));
			break;
		
		default:
			# code...
			break;
	}