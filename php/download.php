<?php
	require __DIR__ . "/lib/core.php";
	session_start();
	$dId = $_GET['did'];
	$fId = $_GET['fid'];
	$document = null;
	$user = null;
	$filePath = null;
	if(isset($_SESSION['user']))
		$user = $_SESSION['user'];

	if(!$user) echo "Not user";

	$purchases = $user->getPurchases();
	$isPurchased = false;
	foreach($purchases as $purch) {
		if($purch['document']->id == $dId) {
			$isPurchased = true;
			$document = $purch['document'];
		}
	}


	if(!$isPurchased) echo "Not purchased";

	$document->populate();
	foreach($document->files as $file) {
		if($file['id'] == $fId);
			$filePath = $file['path'];
	}


	if($filePath) serveFile("." . $filePath);

