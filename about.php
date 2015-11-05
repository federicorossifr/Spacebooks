<!DOCTYPE html>
<?php
	$alonglongtime = 2147483647; //max age 2038
	setcookie("firstTime","1",$alonglongtime,"/");
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bookd</title>
		<link rel="stylesheet" media="screen and (max-width: 640px)" type="text/css" href="css/responsive.css">
		<link rel="stylesheet" media="screen and (min-width: 641px)" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	</head>

	<body id="index">
		<header>
			<h1>Bookd</h1>
		</header>

		<main id="about">
			<header><h2>Cos&apos;&egrave; Bookd</h2></header>

			<a href="index.php" class="prettyButton">Inizia!</a>

			<article>
				<header><h3>Condivisione</h3></header>

				<p>
					Registrati a Bookd e inizia a condividere la tua conoscenza<wbr>
					Puoi condividere appunti, testi, racconti e perfino interi libri di tua crezione!<br>
					Consulta i migliori documenti di qualsiasi argomento,<wbr>
					sfrutta i crediti guadagnati per acquistare documenti<wbr>
					e imparare nuove cose!
				</p>
			</article>

			<article>
				<header>
					<h3>Guadagno</h3>
				</header>

				<p>
					Quando condividi un documento, puoi scegliere un prezzo di vendita<wbr>
					cos&igrave; altri utenti potranno comprare le tue creazioni e tu riceverai<wbr>
					il tuo compenso in crediti.
				</p>
			</article>


			<article>
				<header><h3>Social</h3></header>

				<p>
					Segui i tuoi creatori preferiti e rimani aggiornato<wbr>
					su ogni nuovo documento.
					Scegli i tuoi tag preferiti e guarda i contenuti adatti a te.
				</p>

			</article>

		
		</main>

	</body>
</html>