<?php
	require __DIR__ . "/secured.php";
	if($user->role == "user") {
		header("Location: ./");	
	}
