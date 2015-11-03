<?php
	require ".\php\lib\core.php";
	session_start();
	if($_SESSION['user'])
		$user = $_SESSION['user'];

	if(!$_SESSION['logged']) {
		header("Location: /");
	}