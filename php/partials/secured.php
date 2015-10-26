<?php
	require ".\php\lib\core.php";
	session_start();
	$user = $_SESSION['user'];

	if(!$_SESSION['logged']) {
		header("Location: /");
	}