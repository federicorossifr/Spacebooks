<?php
	require __DIR__ . "/partials/secured.php";
	$score = (isset($_POST['score']))? $_POST['score']:null;
	$comment = (isset($_POST['text']))? $_POST['text']:null;
	$docId = (isset($_POST['document']))? $_POST['document']:null;
	$userId = $user->id;

	$doc = Document::read($docId);
	$doc->rate($score,$comment,$userId);
	$db->close();
	header("Location: ../document.php?id=$docId");