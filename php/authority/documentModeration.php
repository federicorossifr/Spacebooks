<?php
	require "../lib/core.php";
	$docId = $_POST['id'];
	$action = $_POST['action'];

	$document = Document::read($docId);

	switch ($action) {
		case '0':
			$document->available = 1;
			echo $document->update();
		break;

		case '1':
			$document->available = 0;
			echo $document->update();
			break;

		case '2':
			echo $document->delete();
			break;

		default:
			echo "Invalid";
	}