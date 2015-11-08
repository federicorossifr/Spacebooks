<?php
    require __DIR__ . "/lib/core.php";
    session_start();
    $user = $_SESSION['user'];
    if($user && $docId = $_GET['id']) {
    	$result = $user->purchase($docId);
    	if($result) {
            $user->refresh();
    		header("Location: ../document.php?id=$docId");
        }
    	else
    		header("Location: ../home.php");
    } else {
    	header ("Location: ../home.php");
    }
