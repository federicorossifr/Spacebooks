<?php
	$data = $_POST['data'];

	$fromJson = json_decode($data);
	print_r($fromJson);