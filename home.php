<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";

	$userPurchases = $user->getPurchases();
?>


		<main>
			<header><h2>Home</h2></header>

			<div id="homeFragmentContainer">
					<article data-fragment data-name="Ultimi acquisti">
						<ul id="purchaseList" class="documentList">
							<?php 
								foreach($userPurchases as $purch) {
									echo "<li class='shadow'>";
										echo "<a href='./document.php?id={$purch['document']->id}'>";
											echo "<img src={$purch['document']->picturePath}>";
											echo "<span class='shadow'><p>{$purch['document']->title}</p></span>";
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
							<table class="userTable">
								<thead>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
								</thead>
								<tbody id="body">

								</tbody>
							</table>

							<a class="prettyButton">Carica altro</a>

					</article>



			</div>


		</main>



	</body>

	<script type="text/javascript">
		var homeFragment = new Fragment("homeFragmentContainer");
		homeFragment.makeSelectors();

	</script>
</html>