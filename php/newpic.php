<?php
	require __DIR__ . "/lib/core.php";
	session_start();
  	require __DIR__ . "/lib/dbFS.php";
  	$pic = $_FILES['pic'];
  	if(!$pic["error"]) {
	  	$fs = new DbFS('./uploads/profilePictures/');
	  	$path =  $fs->saveFile($pic);
	  	$_SESSION['user']->picture = $path; 
	  	$_SESSION['user']->update();
  	}
	
	$db->close();

  	header("Location: ../home.php");
