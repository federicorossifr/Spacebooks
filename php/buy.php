<?php
    require __DIR__ . "/partials/secured.php";
    
    if($user && $docId = $_GET['id']) {
    	$result = $user->purchase($docId);
    	if($result) {
    		header("Location: ../document.php?id=$docId");
        }
    	else
    		header("Location: ../home.php");
    } else {
    	header ("Location: ../home.php");
    }
