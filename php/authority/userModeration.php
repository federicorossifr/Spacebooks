<?php
	require "../lib/core.php";
	$usrId = $_POST['id'];
	$action = $_POST['action'];

	$usr = User::read($usrId);

	switch ($action) {
		case '0':
			$usr->role = "moderator";
			echo $usr->update();
		break;

		case '1':
			$usr->role = "user";
			var_dump($usr->update());
			break;
		case '3':

			break;
		case '2':
			$usr->delete();
			break;

		default:
			echo "Invalid";
	}