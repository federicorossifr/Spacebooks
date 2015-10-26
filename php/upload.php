<?php

    require __DIR__ . "\lib\dbFS.php";
    require __DIR__ . "\lib\core.php";

  	if(!$_SESSION['logged']) {
		header("Location: /");
	}

    $fs = new DbFS('./uploads/');

	$files = $_FILES['file'];
	$arranged = DbFS::organize($files);
	$author = 6;
	$_POST['author'] = $author;
	$doc = new Document($_POST);
	$doc->create();


	foreach($arranged as $file) {
		$id = $fs->saveFile($file,1);
		var_dump($doc->addFile($id));
	}

