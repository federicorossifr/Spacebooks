<?php
    require __DIR__ . "/lib/dbFS.php";
    require __DIR__ . "/lib/core.php";
	session_start();

  	if(!$_SESSION['logged']) {
		header("Location: /");
	}

    $fs = new DbFS('./uploads/documentFiles/');

	$files = $_FILES['file'];
	$cover = $_FILES['cover'];
	print_r($files);
	print_r($cover);

	$arranged = DbFS::organize($files);
	$author = $_SESSION['user']->id;
	$_POST['author'] = $author;

	$coverFs = new DbFS('./uploads/documentPictures/');

	if(!$cover['error']) {
		$coverId = $coverFs->saveFile($cover,1);
		$_POST['cover'] = $coverId;
		echo $coverId;
	}

	$doc = new Document($_POST);
	$dId = $doc->create();

	foreach($arranged as $file) {
		if(!$file['error']) {
			$id = $fs->saveFile($file,1);
			$doc->addFile($id);
			echo $id . "<br>";
		} else {
			$doc->delete();
			header("Location: ../home.php");
			die;
		}
	}

	header("Location: ../document.php?id=$dId");
