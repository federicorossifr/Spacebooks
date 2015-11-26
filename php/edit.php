<?php
	require __DIR__ . "/lib/core.php";
	session_start();
	$model = $_POST['model'];
	$_SESSION['user']->refresh();

	switch ($model) {
		case 'user':
			$user = User::auth($_SESSION['user']->username,$_POST['oldPassword']);
			if(!$user) {
				break;
				$_SESSION['eError'] = "Password errata";
				//die();
			}
			if(isset($_POST['username']) && $_POST['username'] != ""	)
				$user->username = $_POST['username'];
			if(isset($_POST['password']) && $_POST['password'] != "") {
				$pwd = $_POST['password'];
				$editCryptStrategy = new Crypto($pwd,"");
				$hashedPwd = $editCryptStrategy->doCrypt();
				$user->password = $hashedPwd;
			}
			$user->update();
			$_SESSION['user']->refresh();
			header("Location: ../profile.php");
			break;
		
		default:
			# code...
			break;
	}

