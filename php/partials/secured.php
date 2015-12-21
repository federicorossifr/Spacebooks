<?php

	function upDirectory($currentDirectory) {
		$pieces = explode(DIRECTORY_SEPARATOR,$currentDirectory);
		$piecesSize = sizeof($pieces);
		unset($pieces[$piecesSize - 1]);
		$previousDirectory = implode($pieces,DIRECTORY_SEPARATOR);
		return $previousDirectory . DIRECTORY_SEPARATOR;
	}
	
	require upDirectory(__DIR__) . "lib/core.php";

	session_start();
	if($_SESSION['user'])
		$user = $_SESSION['user'];

	if(!$_SESSION['logged'] || !$_SESSION['user']) {
		header("Location: /");
	}