<?php
    require __DIR__ . "/partials/secured.php";
    
    if($docId = $_GET['id']) { // SE IL GET HA SUCCESSO
    	$result = $user->purchase($docId); // PROCEDO A REGISTRARE L'ACQUISTO (IL CONTROLLO DEI CREDITI E' SVOLTO VIA DATABASE)
    	if($result) { // SE TUTTO E' ANDATO A BUON FINE
    		header("Location: ../document.php?id=$docId");
        }
    	else
    		throw new Exception("C'è stato un errore nell'acquisto del documento");
    } else {
    	header ("Location: ../home.php");
    }
