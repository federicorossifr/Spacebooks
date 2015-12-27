<?php
	require __DIR__ . "/partials/secured.php";
    $fs = new DbFS('./uploads/documentFiles/');
	$coverFs = new DbFS('./uploads/documentPictures/');

	$files = $_FILES['file']; // RECUPERO I FILE DEL DOCUMENTO
	$cover = $_FILES['cover']; // RECUPERO LA COPERTINA DEL DOCUMENTO

	$arranged = DbFS::organize($files); // RIORGANIZZO L'ARRAY DEI FILE
	$author = $_SESSION['user']->id; // RECUPERO L'ID DEL CREATORE
	$_POST['author'] = $author; 


	$tags = json_decode($_POST['tags']); // RECUPERO I TAG CODIFICATI JSON


	if(!$cover['error']) {  // SE LA COPERTINA E' STATA CARICATA CON SUCCESSO LA SALVO 
		$coverId = $coverFs->saveFile($cover,1);
		$_POST['cover'] = $coverId;
	}

	$doc = new Document($_POST); // CREO IL NUOVO OGGETTO DOCUMENTO
	$dId = $doc->create(); // E LO SALVO NEL DATABASE

	foreach($arranged as $file) { // PROCEDO A SALVARE OGNI FILE CARICATO E AD ASSOCIARLO AL DOCUMENTO
		if(!$file['error']) { // SE IL FILE E' CARICATO CON SUCCESSO LO SALVO E LO ASSOCIO
			$id = $fs->saveFile($file,1);
			$doc->addFile($id);
		} else { // ALTRIMENTI ELIMINO IL DOCUMENTO E LANCIO L'ECCEZIONE
			$doc->delete();
			$db->close();
			throw new Exception("Errore nella creazione del documento");
		}
	}

	foreach($tags as $tag) { // ASSOCIO I TAG AL DOCUMENTO
		$doc->tag($tag);
	}

	$db->close();

	header("Location: ../document.php?id=$dId"); // CONCLUDO IL CARICAMENTO RIMANDANDO AL DOCUMENTO CARICATO
