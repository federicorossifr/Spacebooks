<?php
	$db = require __DIR__ . "/db.php";
	require __DIR__ . "/crypto.php";
	function toArray($mysqliResult) {
		$output = array();
		while($row = $mysqliResult->fetch_assoc())
			array_push($output, $row);
		return $output;

	}

	function drawStars($score,$max) {
		for($i = 0; $i < $max; ++$i) {
			if($i < $score)
				echo "<img class=\"star \" src=\"img/star_on.png\" width=\"30\">";
			else 
				echo "<img class=\"star \" src=\"img/star_off.png\" width=\"30\">";
		}
	}
	
	require __DIR__ . "/model/User.php";
	require __DIR__ . "/model/Document.php";

