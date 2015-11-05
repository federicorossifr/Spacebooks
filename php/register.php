<?php
	require __DIR__ . "/lib/core.php";
	session_start();
	$fieldExists = null;

	if(User::exists($_POST['email'])) {
		$fieldExists = "Email";
	}

	if(User::exists($_POST['username'])) {
		$fieldExists = "Username";
	}

	if($fieldExists) {
		$_SESSION['rerror'] = $fieldExists .  " is already registered";
		header("Location: ../index.php");
		die;
	}

	if($_POST["password1"] == $_POST["password2"]) {
		$_POST["password" ] = md5($_POST["password1"]);
		unset($_POST["password1"]);
		unset($_POST["password2"]);

		$_POST["birthdate"] = str_replace('/','-',$_POST['birthdate']);
		$_POST["birthdate"] = date("Y-m-d", strtotime($_POST['birthdate']));
		$newUser = new User($_POST);
		$newUserId = $newUser->create();
		$user = User::read($newUserId);
		$_SESSION['user'] = $user;
		$_SESSION['logged'] = true;
		header("Location: ../profile.php");
		die;
	} else {
		$_SESSION['rerror'] = "Passwords does not match";
		header("Location: ../index.php");
	}


