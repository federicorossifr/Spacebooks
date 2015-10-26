<?php

    require __DIR__ . "\lib\dbFS.php";




    $fs = new DbFS('./uploads/');

	$files = $_FILES['file'];
	$arranged = DbFS::organize($files);
	$uploadsId;

	foreach($arranged as $file) {
		$id = $fs->saveFile($file);
	}
