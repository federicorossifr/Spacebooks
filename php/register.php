<?php
	require __DIR__ . "/lib/core.php";
	session_start();
	$fieldExists = null;


	if($_POST["password1"] == $_POST["password2"]) {
		$password = $_POST["password" ];
		unset($_POST["password1"]);
		unset($_POST["password2"]);
		$regStrategy = new Crypto($password,"");
		$password = $regStrategy->doCrypt();
		$_POST['password'] = $password;

		$_POST["birthdate"] = str_replace('/','-',$_POST['birthdate']);
		$_POST["birthdate"] = date("Y-m-d", strtotime($_POST['birthdate']));
		$newUser = new User($_POST);
		$newUserId = $newUser->create();
		$user = User::read($newUserId);
		$_SESSION['user'] = $user;
		$_SESSION['logged'] = true;
		$db->close();
		header("Location: ../profile.php");
		die;
	} else {
		$_SESSION['rerror'] = "Passwords does not match";
		header("Location: ../index.php");
	}




