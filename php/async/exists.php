<?php
	require "../lib/core.php";
	$label = $_GET['label'];
	echo User::exists($label);