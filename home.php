<?php
	require "./php/partials/secured.php";
?>
<!DOCTYPE html>
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
								<p data-role="empty" class='emptyResult'>Non hai ancora acquistato nessuno documento,cerca il documento che fa per te e acquistalo</p>
						<ul id="purchaseList" class="documentList">
							
						</ul>
							<a id="loadMorePurch" data-role="loadMore" class="prettyButton">Carica altro</a>

					</article>

					<article data-fragment data-name="Consigliati">
							<header><h3>Consigliati</h3></header>
							<p data-role="empty" class='emptyResult'>Non hai ancora nessun documento consigliato, comprarirà qualcosa man mano che visiti il sito</p>

							<ul id="suggestedDocuments" class="documentList">
							</ul>
							<a id="loadMore" data-role="loadMore" class="prettyButton">Carica altro</a>
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


	<?php include("./php/partials/footer.php");?>
</html>