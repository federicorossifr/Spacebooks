<?php
	require __DIR__ . "lib/core.php";
	$score = $_POST['score'];
	$comment = $_POST['text'];
	$userId = $_SESSION['user']->id;

	