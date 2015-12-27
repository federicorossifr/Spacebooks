<?php
	require __DIR__ . "/lib/core.php";
	session_start();

	$password = $_POST["password1"];
	unset($_POST["password1"]);
	unset($_POST["password2"]);

	$regStrategy = new Crypto($password,""); // BCRYPT DELLA PASSWORD CON SALT CASUALE.
	$password = $regStrategy->doCrypt();

	$_POST['password'] = $password;

	$_POST["birthdate"] = str_replace('/','-',$_POST['birthdate']);  // FORMATTAZINOE DELLA DATA IN YYYY/MM/DD PER MYSQL
	$_POST["birthdate"] = date("Y-m-d", strtotime($_POST['birthdate']));

	$newUser = new User($_POST); // CREAZIONE DELL'OGGETTO UTENTE A PARTIRE DALL'ARRAY POST
	$newUserId = $newUser->create(); // SALVATAGGIO IN DATABASE DELL'OGGETTO APPENA CREATO.

	$user = User::read($newUserId); // RECUPERO L'UTENTE APPENA CREATO ED ESEGUO IL LOGIN
	$_SESSION['user'] = $user;
	$_SESSION['logged'] = true;
	$db->close();
	header("Location: ../profile.php"); // RIMANDO L'UTENTE AL SUO PROFILO




