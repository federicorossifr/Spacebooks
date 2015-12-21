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
			<h1><a href="./">Spacebooks</a></h1>
		</header>

		<main id="about">
			<header><h2>Cos&apos;&egrave; Spacebooks</h2></header>

			<div id="aboutFragments">
									<a href="index.php" class="prettyButton">Inizia ad usare Spacebooks!</a>

				<article data-fragment data-name="Condivisione" class="about">
					<header><h3>Condivisione</h3></header>
					<div class="darken"></div>
					<p>
						Con SPACEBOOKS<wbr>
						puoi condividere appunti, testi, racconti e perfino interi libri di tua crezione!<br>
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
						il tuo compenso in crediti.<br>
						Se invece preferisci condividerlo gratis, puoi farlo!<wbr>
						Ti baster&agrave; scegliere il prezzo 0.

					</p>
				</article>


				<article id="3" data-fragment data-name="Social" class="about">
					<header><h3>Social</h3></header>
					<div class="darken"></div>

					<p>
						Inoltre puoi seguire i tuoi creatori preferiti<wbr>
						e grazie alle funzionalità di tag dei documenti<br>
						ti consiglieremo sempre ciò che fa per te!
					</p>

				</article>

				<article id="3" data-fragment data-name="Sicurezza" class="about">
					<header><h3>Sicurezza</h3></header>
					<div class="darken"></div>

					<p>
						Una volta condiviso, un documento non potrà essere modificato ulteriormente.<br>
						Così non potrai perdere i documenti che hai acquistato ed aver speso crediti<br>
						inutilmente.
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