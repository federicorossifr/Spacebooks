<?php
	require __DIR__ . "/partials/secured.php";

  	$pic = (isset($_FILES['pic']))? $_FILES['pic']:null;
  	if($pic && !$pic["error"]) {
	  	$fs = new DbFS('./uploads/profilePictures/');
	  	$path =  $fs->saveFile($pic);
	  	$_SESSION['user']->picture = $path; 
	  	$_SESSION['user']->update();
  	}
	
	$db->close();

  	header("Location: ../home.php");
