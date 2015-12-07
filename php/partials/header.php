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
	<title>Bookd</title>

	<meta name="theme-color" content="#3F51B5">


	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link rel="stylesheet" media="screen and (max-width: 719px)" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" media="screen and (min-width: 720px)" type="text/css" href="css/style.css">

	<!-- Javascript Libraries -->
	<script type="text/javascript" src="./js/Async.js"></script>
	<script type="text/javascript" src="./js/FormControl.js"></script>
	<script type="text/javascript" src="./js/PicUploader.js"></script>
	<script type="text/javascript" src="./js/Fragment.js"></script>
	<script type="text/javascript" src="./js/Parser.js"></script>
	<script type="text/javascript" src="./js/MultiUploader.js"></script>
	<script type="text/javascript" src="./js/Reviewer.js"></script>
	<script type="text/javascript" src="./js/DataUtilities.js"></script>
	<script type="text/javascript" src="./js/Pophover.js"></script>
	<script type="text/javascript" src="./js/Tag.js"></script>
	<script type="text/javascript" src="./js/Modal.js"></script>
	<!-- End of Javascript Libraries -->
</head>



