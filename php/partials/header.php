<?php
	$menuVoices = array();
	$menuVoices['home'] = "/home.php";
	$menuVoices['crea'] = "/create.php";
	$menuVoices['admin'] = "/authority.php";
	$menuVoices['modera'] = "/authority.php";
	$thisUri = $_SERVER['REQUEST_URI'];
	$explodedUri = explode("/", $thisUri);
	$index = count($explodedUri) - 1;
	$thisUrl = "/" . $explodedUri[$index];
?>

<head>
	<meta charset="utf-8">
	<title>Spacebooks</title>

	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/style_.css">
	<link rel="stylesheet" type="text/css" href="css/responsive_.css">
 	<link rel="shortcut icon" type="image/png" href="./img/favicon.ico"/>
 	
	<!-- Javascript Libraries -->
	<script type="text/javascript" src="./js/Async.js"></script>
	<script type="text/javascript" src="./js/FormControl.js"></script>
	<script type="text/javascript" src="./js/PicUploader.js"></script>
	<script type="text/javascript" src="./js/Fragment.js"></script>
	<script type="text/javascript" src="./js/Parser.js"></script>
	<script type="text/javascript" src="./js/MultiUploader.js"></script>
	<script type="text/javascript" src="./js/Reviewer.js"></script>
	<script type="text/javascript" src="./js/Utilities.js"></script>
	<script type="text/javascript" src="./js/Pophover.js"></script>
	<script type="text/javascript" src="./js/Tag.js"></script>
	<script type="text/javascript" src="./js/Modal.js"></script>
	<!-- End of Javascript Libraries -->
</head>


<noscript>
	<style type="text/css">
		.noscript {
			display: block;
			position: fixed;
			top:0;
			left:0;
			width:100%;
			height:100%;
			z-index: 10;
			background-color: white;
		}

		body {
			opacity: 1;
		}

		html {
			background: none;
			overflow: hidden;
		}


	</style>

	<article class="noscript exception">
		<header><h3>Javasript non è stato rilevato</h3></header>

		<p>
			Senza Javsacript Spacebooks non può funzionare al meglio,
			se vuoi utilizzare il servizio, per favore attiva Javascript.
		</p>

	</article>
</noscript>
