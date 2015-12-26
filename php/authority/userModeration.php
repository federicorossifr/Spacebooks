<?php
	//require "../lib/core.php";
	require "../partials/superSecured.php";
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
			echo $usr->update();
			break;
		case '3':

			break;
		case '2':
			echo $usr->delete();
			break;

		default:
			echo "Invalid";
	}