<?php
		mysqli_report(MYSQLI_REPORT_STRICT);
		$source = array();
		$source['host'] = "localhost";
		$source['user'] = "root";
		$source['password'] = "";
		$source['database'] = "spacebooks";
		$database = null;

		try {
			$database = new mysqli($source['host'],$source['user'],$source['password'],$source['database']);
		} catch (Exception $e) {
			   $database = false;
			   session_start();
			   unset($_SESSION['logged']);
			   unset($_SESSION['user']);
			   renderErrorPage("Il servizio database non è al momento disponibile");
				die;
		}
	return $database;
?>