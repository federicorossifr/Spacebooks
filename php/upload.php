<?php
    require __DIR__ . "/lib/core.php";
	session_start();

  	if(!$_SESSION['logged']) {
		header("Location: /");
	}

    $fs = new DbFS('./uploads/documentFiles/');

	$files = $_FILES['file'];
	$cover = $_FILES['cover'];

	$arranged = DbFS::organize($files);
	$author = $_SESSION['user']->id;
	$_POST['author'] = $author;

	$coverFs = new DbFS('./uploads/documentPictures/');

	$tags = json_decode($_POST['tags']);


	if(!$cover['error']) {
		$coverId = $coverFs->saveFile($cover,1);
		$_POST['cover'] = $coverId;
	}

	$doc = new Document($_POST);
	$dId = $doc->create();

	foreach($arranged as $file) {
		if(!$file['error']) {
			$id = $fs->saveFile($file,1);
			$doc->addFile($id);
		} else {
			$doc->delete();
			$db->close();
			$_SESSION['cerror'] = "Errore nella creazione del documento";
			header("Location: ../home.php");
			die;
		}
	}

	foreach($tags as $tag) {
		$doc->tag($tag);
	}

	$db->close();

	header("Location: ../document.php?id=$dId");
