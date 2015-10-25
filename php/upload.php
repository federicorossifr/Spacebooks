<?php

    require __DIR__ . "\lib\dbFS.php";




    $fs = new DbFS('./uploads/');

	$files = $_FILES['file'];
	$arranged = DbFS::organize($files);


	foreach($arranged as $file) {
		echo $fs->saveFile($file);
	}