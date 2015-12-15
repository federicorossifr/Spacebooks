<!DOCTYPE html>
<?php
	$alonglongtime = 2147483647; //max age 2038
	setcookie("firstTime","1",$alonglongtime,"/");
?>
<html lang="it">
	<?php
		include("./php/partials/header.php");
	?>

	<body id="index">
		<header>
			<h1>Spacebooks</h1>
		</header>

		<main id="about">
			<header><h2>Cos&apos;&egrave; Spacebooks</h2></header>

			<div id="aboutFragments">
				<article data-fragment data-name="Condivisione" class="about">
					<header><h3>Condivisione</h3></header>
					<div class="darken"></div>
					<p>
						Registrati a Spacebooks e inizia a condividere la tua conoscenza<wbr>
						Puoi condividere appunti, testi, racconti e perfino interi libri di tua crezione!<br>
						Consulta i migliori documenti di qualsiasi argomento,<wbr>
						sfrutta i crediti guadagnati per acquistare documenti<wbr>
						e imparare nuove cose!

						<a href="index.php" class="prettyButton">Inizia!</a>
					</p>
				</article>

				<article id="2" data-fragment data-name="Guadagno" class="about">
					<header>
						<h3>Guadagno</h3>
					</header>
					<div class="darken"></div>


					<p>
						Quando condividi un documento, puoi scegliere un prezzo di vendita<wbr>
						cos&igrave; altri utenti potranno comprare le tue creazioni e tu riceverai<wbr>
						il tuo compenso in crediti.
					</p>
				</article>


				<article id="3" data-fragment data-name="Social" class="about">
					<header><h3>Social</h3></header>
					<div class="darken"></div>

					<p>
						Segui i tuoi creatori preferiti e rimani aggiornato<wbr>
						su ogni nuovo documento.
						Grazie ai tag, troverai sempre i documenti<wbr>
						adatti a te.
					</p>

				</article>
			</div>
		
		</main>
	</body>

	<script type="text/javascript">
	var frgm = new Fragment("aboutFragments");
	frgm.makeSelectors('a');
	window.setInterval(function() {frgm.next();},15000);
	</script>
</html>