<?php
	require __DIR__ . "/partials/secured.php";
	
	$dId = (isset($_GET['did']))? $_GET['did']:null;
	$fId = (isset($_GET['fid']))? $_GET['fid']:null;
	$filePath = null;
	
	if(!$user->hasPurchased($dId)) throw new Exception("Non hai ancora acquistato questo documento");

	$document = Document::read($dId);
	if(!$document) die;
	$filePath = DbFS::getFileLink($fId);
	if($filePath) serveFile("." . $filePath);
	else throw new Exception("Il file non esiste o è stato cancellato");

