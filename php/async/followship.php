<?php
	require("../lib/core.php");
	session_start();
	if(isset($_SESSION['user']) && $_SESSION['user']) {
		$follower = $_SESSION['user']->id;
		$followed = (isset($_POST['mate'])) ? $_POST['mate'] : null;
		$unfollow = (isset($_POST['unfollow'])) ? $_POST['unfollow'] : null;

		if($followed == null || $unfollow == null) { echo 0; return; }
		echo $_SESSION['user']->follow($followed,$unfollow);
		return;
	} else echo 0;