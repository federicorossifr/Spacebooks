<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
?>

	

		<main>
			<header><h2>Home</h2></header>

			<div id="homeFragmentContainer">
					<article data-fragment data-name="Ultimi acquisti">
						
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