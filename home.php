<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="it">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
	$userPurchases = $user->getPurchases();
	$fellows = $user->getFellows(0);
?>
		<main>
			<header><h2>Home</h2></header>
			<div id="homeFragmentContainer">
					<article data-fragment data-name="Ultimi acquisti">
						<header><h3>Ultimi acquisti</h3></header>
						<?php
							if(!sizeof($userPurchases)) {
								echo "<p class='emptyResult'>Non hai ancora acquistato nessuno documento,cerca il documento che fa per te e acquistalo</p>";
							}
						?>
						<ul id="purchaseList" class="documentList">
							
						</ul>
					</article>

					<article data-fragment data-name="Consigliati">
							<header><h3>Consigliati</h3></header>
							<ul id="suggestedDocuments" class="documentList">
							</ul>
							<a id="loadMore" class="prettyButton">Carica altro</a>
					</article>

					<article data-fragment data-name="Seguiti">
							<header><h3>Seguiti</h3></header>
							<?php
								if(!sizeof($fellows)) echo "<p class='emptyResult'>Non stai seguendo nessun utente,<br> cerca qualcuno da seguire con il pulsante 'Cerca'</p>";
							?>
							<ul class="documentList people">
								<?php
									foreach($fellows as $fellow) {
										echo "<li class='shadow'>";
											echo "<a href='./profile.php?id={$fellow['id']}'>";
												echo "<img alt='cover' src={$fellow['picture']}>";
												echo "<div class='title shadow'><p>{$fellow['username']}</p></div>";
											echo "</a>";
										echo "</li>";									
									}
								?>



							</ul>



					</article>
			</div>
		</main>
	</body>
	<script type="text/javascript" src="./js/components/home.js"></script>
	<script type="text/javascript">
		homeInit();
	</script>
</html>