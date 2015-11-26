<?php
	session_start();
	require __DIR__ . "/lib/core.php";


	$username = $_POST['username'];
	$password = $_POST['password'];
	$user = User::auth($username,$password);

	if($user) {
		$_SESSION['user'] = $user;
		$_SESSION['logged'] = true;
		header("Location: ../home.php");

	}
	else {
		$_SESSION['lerror'] = "Login error";
		header("Location: ../index.php");
	}
?>