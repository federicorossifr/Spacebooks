<?php
	unset($_SESSION['user']);
	unset($_SESSION['logged']);
	session_destroy();
	header("Location: ../index.php");