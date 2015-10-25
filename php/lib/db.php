<?php
	$source = array();
	$source['host'] = "localhost";
	$source['user'] = "root";
	$source['password'] = "";
	$source['database'] = "pweb";


	return new mysqli($source['host'],$source['user'],$source['password'],$source['database']);
?>