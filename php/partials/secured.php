<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/php/lib/core.php";

	session_start();
	if($_SESSION['user'])
		$user = $_SESSION['user'];

	if(!$_SESSION['logged'] || !$_SESSION['user']) {
		header("Location: /");
	}