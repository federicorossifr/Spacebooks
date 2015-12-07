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
						<ul id="purchaseList" class="documentList">
							<?php 
								foreach($userPurchases as $purch) {
									echo "<li class='shadow'>";
										echo "<a href='./document.php?id={$purch['document']->id}'>";
											echo "<img alt='cover' src={$purch['document']->picturePath}>";
											echo "<div class='title shadow'><p>{$purch['document']->title}</p></div>";
											echo "<div class='stars shadow'>";
											drawStars(floor($purch['document']->avg),5);
											echo "</div>";
										echo "</a>";
									echo "</li>";
								}
							?>
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