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

				<article data-fragment data-name="SPACEBOOKS" class="about">
					<header><h3>SPACEBOOKS</h3></header>
					<div class="darken"></div>
					<p>
						Con SPACEBOOKS<wbr>
						puoi condividere appunti, testi, racconti e perfino interi libri di tua crezione!<br>
					</p>
				</article>

				<article id="2" data-fragment data-name="Condividi" class="about">
					<header>
						<h3>Condividi</h3>
					</header>
					<div class="darken"></div>


					<p>
						Per condividere un documento, scegli i file, una copertina, una descrizione<br>
						un titolo e qualche tag.<br>
						Quando condividi un documento, puoi scegliere anche un prezzo di vendita che ti verrà<wbr>
						accreditato per ogni acquisto di altri utenti.<br>
						Se invece preferisci condividerlo gratis, puoi farlo!<wbr>
					</p>
				</article>


				<article id="3" data-fragment data-name="Social" class="about">
					<header><h3>Social</h3></header>
					<div class="darken"></div>

					<p>
						Su SPACEBOOKS puoi seguire i tuoi creatori preferiti<wbr>
						e grazie alle funzionalità di TAG dei documenti<br>
						ti consiglieremo sempre i documenti che fanno per te!
					</p>

				</article>

				<article id="4" data-fragment data-name="Sicurezza" class="about">
					<header><h3>Sicurezza</h3></header>
					<div class="darken"></div>

					<p>
						Una volta condiviso un documento, i suoi file non potranno essere modificati ulteriormente.<br>
						Potrai però modificare il titolo e la descrizione<br> per farti trovare pi&ugrave; facilmente.
						<br>Così non potrai perdere i documenti che hai acquistato ed aver speso crediti<br>
						inutilmente.
					</p>

				</article>


				<article id="5" data-fragment data-name="Collabora" class="about">
					<header><h3>Collabora</h3></header>
					<div class="darken"></div>


					<p>
						La tua attività nel servizio potrà essere premiata nominandoti moderatore.<br>
						Potrai accedere ad una nuova sezione in cui aiutarci a verificare i documenti caricati.
					</p>
				</article>
			</div>
		
		</main>
	</body>

	<script type="text/javascript">
	var frgm = new Fragment("aboutFragments");
	frgm.makeSelectors('a');
	document.body.style.opacity = 1;
	document.documentElement.style.backgroundImage = "none";
	</script>
</html>