<?php
	require "./php/lib/crypto.php";

	$examplePass = "password";
	$strategy = new Crypto($examplePass,"");
	echo $strategy->doCrypt();
	echo $strategy->doMatch();