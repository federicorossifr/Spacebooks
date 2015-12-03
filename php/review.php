<?php
	require __DIR__ . "/lib/core.php";
	session_start();
	$score = $_POST['score'];
	$comment = $_POST['text'];
	$docId = $_POST['document'];
	$userId = $_SESSION['user']->id;

	$doc = Document::read($docId);
	$doc->rate($score,$comment,$userId);
	$db->close();
	header("Location: ../document.php?id=$docId");