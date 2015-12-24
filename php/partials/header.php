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



