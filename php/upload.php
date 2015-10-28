<?php
    require __DIR__ . "/lib/dbFS.php";
    require __DIR__ . "/lib/core.php";
	session_start();

  	if(!$_SESSION['logged']) {
		header("Location: /");
	}

    $fs = new DbFS('./uploads/');

	$files = $_FILES['file'];

	$arranged = DbFS::organize($files);
	$author = $_SESSION['user']->id;
	$_POST['author'] = $author;
	$doc = new Document($_POST);
	$dId = $doc->create();


	foreach($arranged as $file) {
		$id = $fs->saveFile($file,1);
		$doc->addFile($id);
	}


	header("Location: ../document.php?id=" . $dId);

