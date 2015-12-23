<?php //restituisce un'immagine contenente la stringa dell'email. Per evitare lo spam.
	header("Content-type: image/png");
	$email = $_GET['email'];
	$mailLength = strlen($email)*8;
	$im = imagecreate(300, 20);
	$backgroundColor = imagecolorallocate($im, 255, 255, 255);
	$textColor = imagecolorallocate($im, 0, 0, 0);
	imagestring($im,10,5,2,$email,$textColor); // imagestring(image,size,x,y,string,color);
	imagepng($im);
?>