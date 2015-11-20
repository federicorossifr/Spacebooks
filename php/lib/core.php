<?php
	$db = require __DIR__ . "/db.php";

	function toArray($mysqliResult) {
		$output = array();
		while($row = $mysqliResult->fetch_assoc())
			array_push($output, $row);
		return $output;

	}
	
	require __DIR__ . "/model/User.php";
	require __DIR__ . "/model/Document.php";

