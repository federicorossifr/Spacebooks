<?php
	$db = require __DIR__ . "/db.php";
	require __DIR__ . "/crypto.php";
	require_once __DIR__ . "/dbFS.php";

	function toArray($mysqliResult) {
		$output = array();
		while($row = $mysqliResult->fetch_assoc())
			array_push($output, $row);
		return $output;

	}

	function drawStars($score,$max) {
		for($i = 0; $i < $max; ++$i) {
			if($i < $score)
				echo "<img alt='star$i' class=\"star \" src=\"img/star_on.png\" width=\"30\">";
			else 
				echo "<img alt='star$i' class=\"star \" src=\"img/star_off.png\" width=\"30\">";
		}
	}

	function serveFile($filePath) {
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="bookdFile.pdf"');
		readfile($filePath);
	}

	function exceptionHandler($exception) {
		echo $exception->getMessage();
		die;
	}

	set_exception_handler('exceptionHandler');

	function checkQuery($statement) {
		if(!$statement) {
			throw new Exception("Preparazione query fallita");
		}
	}



	require __DIR__ . "/model/User.php";
	require __DIR__ . "/model/Document.php";

