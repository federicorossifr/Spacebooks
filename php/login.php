<?php
	session_start();
	require __DIR__ . "/lib/core.php";
	$username = (isset($_POST['username']))? $_POST['username']: "";
	$password = (isset($_POST['password']))? $_POST['password']: "";
	$user = User::auth($username,$password);
	$db->close();

	if($user) {
		$_SESSION['user'] = $user;
		$_SESSION['logged'] = true;
		echo 1;
	}
	else {
		echo 0;
	}

?>