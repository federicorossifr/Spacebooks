<?php
	require __DIR__ . "/lib/core.php";
	session_start();
	$dId = $_GET['did'];
	$fId = $_GET['fid'];
	$user = null;
	$filePath = null;
	if(isset($_SESSION['user']))
		$user = $_SESSION['user'];
	if(!$user) die;
	
	if(!$user->hasPurchased($dId)) die;

	$document = Document::read($dId);
	if(!$document) die;
	$filePath = DbFS::getFileLink($fId);
	if($filePath) serveFile("." . $filePath);
	else die;

