<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
	print_r($_COOKIE);
	$userPurchases = $user->getPurchases();
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
		homeFragment.makeSelectors("a");
		var tgs = loadTags().split(";");

		function handler(data) {
			this.lastGet = 0;
		}

		handler.prototype.onData = function(data) {
			data = JSON.parse(data);

			if(data.length)
				this.lastGet = data[data.length -1].id;
			console.log(data);
			console.log(this.lastGet)
		}


		function getTaggedDocuments(tag,start,step,callback) {
			var params = [{'id':'start','value':start},{'id':'by','value':step},{'id':'tag','value':tag}];
			DataLoad("./php/async/documentsIncrementalLoading.php",params,callback);
		}

		var dataHandler = new handler("");
		getTaggedDocuments(1,dataHandler.lastGet,5,dataHandler.onData);



	</script>
</html>