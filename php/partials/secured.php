<?php
	
	require __DIR__ . "/../lib/core.php";

	session_start();
	if(isset($_SESSION['user']) && $_SESSION['user'])
		$user = $_SESSION['user'];

	if(!$_SESSION['logged'] || !$_SESSION['user']) {
		header("Location: /");
	}