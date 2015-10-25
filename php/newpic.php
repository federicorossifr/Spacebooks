<?php
	require __DIR__ . "\lib\core.php";
	session_start();
  	require __DIR__ . "\lib\dbFS.php";
  	$pic = $_FILES['pic'];
  	print_r($pic);
  	if(!$pic["error"]) {
	  	$fs = new DbFS('./uploads/profilePictures/');
	  	$path =  $fs->saveFile($pic);
	  	$_SESSION['user']->picture = $path; 
	  	$_SESSION['user']->update();
  	}
  	
  	header("Location: ../home.php");
