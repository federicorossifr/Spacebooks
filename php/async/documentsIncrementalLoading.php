<?php
	require "../lib/core.php";
	session_start();
	$dataConnection = require "../lib/db.php";


	function manifactureResponse($responseArray,$error,$stepBy) {
		$ajaxResponse = array();
		$ajaxResponse["data"] = $responseArray;
		$ajaxResponse["size"] = sizeof($responseArray);
		$ajaxResponse["error"] = $error;
		$ajaxResponse["noMore"] = false;
		if(sizeof($responseArray) < $stepBy) $ajaxResponse["noMore"] = true;
		return $ajaxResponse;
	}


	function loader($lastId,$stepBy) {
		global $dataConnection;

		$tags = $_GET['tag'];
		$decodedTags = json_decode($tags);
		if(!$decodedTags) {return manifactureResponse(array(),false);}

		$decodedTags[0] = $dataConnection->real_escape_string($decodedTags[0]);
		$query = "SELECT DISTINCT D.id,D.title,IF(F.path IS NULL,'./img/file-esplora.png',F.path) AS path,D.score,D.votings,D.price
				  FROM document D
				  INNER JOIN tagship ON D.id = document
				  LEFT OUTER JOIN file F ON F.id = cover
				  WHERE D.id > $lastId AND D.available = 1 AND ( tag = {$decodedTags[0]} ";

		foreach($decodedTags as $tag) {
			if($tag == "") continue;
			$tag = $dataConnection->real_escape_string($tag);
			$query.= "OR tag=$tag ";
		}


		$query.= ") LIMIT $stepBy";

		$result = $dataConnection->query($query);
		$result = toArray($result);
		$error = $dataConnection->error == 1;
		$response = manifactureResponse($result,$error,$stepBy);
		return $response;
	}


	function purchaseLoader($lastId,$stepBy) {
		global $dataConnection;
		$purchaserId = $_SESSION['user']->id;
		$query = "SELECT DISTINCT D.id,D.title,IF(F.path IS NULL,'./img/file-esplora.png',F.path) AS path,D.score,D.votings,D.price
				  FROM document D
				  INNER JOIN purchase ON D.id = document AND purchaser = $purchaserId
				  LEFT OUTER JOIN file F ON F.id = cover
				  WHERE D.id > $lastId LIMIT $stepBy";

		$result = $dataConnection->query($query);
		$result = toArray($result);
		$error = $dataConnection->error == 1;
		$response = manifactureResponse($result,$error,$stepBy);
		return $response;
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