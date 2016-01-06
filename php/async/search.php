<?php
	require "../lib/core.php";
	$str = "%" . $_POST['data'] . "%";
	$queryDoc = "SELECT DISTINCT D.id,D.title FROM document D INNER JOIN tagship T ON T.document = D.id
													 INNER JOIN tag TT ON TT.id = T.tag
				 WHERE (D.title LIKE ? OR D.description LIKE ? OR TT.name LIKE ?) AND D.available = 1";
	$queryUsr = "SELECT id,username,picture FROM user WHERE name LIKE ? OR surname LIKE ? OR username LIKE ? ";
   	$stmntDoc = $db->prepare($queryDoc);
   	$stmntDoc->bind_param("sss",$str,$str,$str);

   	$stmntUsr = $db->prepare($queryUsr);
   	$stmntUsr->bind_param("sss",$str,$str,$str);

   	$stmntDoc->execute();
   	$docRes = $stmntDoc->get_result();
   	$stmntUsr->execute();
   	$usrRes = $stmntUsr->get_result();

   	echo JSON_ENCODE(toArray($docRes));
   	echo JSON_ENCODE(toArray($usrRes));