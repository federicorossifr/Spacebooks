<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
	$docId = $_GET['id'];
	$doc = Document::read($docId);
	$doc->populate();
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
?>

	<main>
		<header><h2><?= $doc->title ?></h2></header>
		<div id="documentFragment">
			<article data-fragment data-name="Presentazione">
				<header><h3>Info documento</h3></header>

				<div class="left">
					<div class="stars shadow">
						<?php
							for($i = 0; $i < 5; ++$i) {
									if($i < floor($doc->avg))
										echo "<img class=\"star \" src=\"img/star_on.png\" width=\"30\">";
									else 
										echo "<img class=\"star \" src=\"img/star_off.png\" width=\"30\">";
							}
						?><br>
						<strong><?php echo $doc->avg . " ($doc->votings)" ?></strong>
					</div>
					<hr>
					<img class="shadow" src=" <?= $doc->picturePath ?> " width="200" alt="no">
					<span class="prettyButton"><?= $doc->price ?>BC</span>

					<?php
						if($doc->price <= $user->credits)	
							echo "<a href=\"./php/buy.php?id=$doc->id\" class=\"prettyButton\">Acquista</a>";
					?>

				</div>

					<?= $doc->description ?>


			</article>

			<article data-fragment data-name="Informazioni e autore">
				
				<div class="left shadow">
					<?php
						foreach($doc->tags as $tag) {
							echo "{$tag['name']}<br>";
						}



					?>
				</div>

				<div class="left shadow">
					<!-- Tag info -->
				</div>


			</article>

			<article data-fragment data-name="Files">
				<header><h2>File del documento</h2></header>
				<table class="userTable">
					<thead>
						<th>Nome</th>
						<th>Dimensione</th>
						<th>Data</th>
						<th>Download</th>
					</thead>

					<tbody id="filesTable">	
						<?php
							foreach($doc->files as $file) {
								$fileName = $file['name'];
								$fileSize = $file['size'];
								$fileId = $file['id'];
								$fileDate = $file['created'];
								echo "<tr><td>$fileName<td>$fileSize<td>$fileDate<td>$fileId</tr>";
							}
						?>
					</tbody>
				</table>
			</article>


			<article id="reviews" data-fragment data-name="Recensioni">
				<div class="left shadow">
					<h3>Dai una recensione</h3>
					<div id="stars"></div>
					<form id="reviewForm" method="POST" action="./php/review.php">
						<label for="text">Testo valutazione</label>
						<textarea class="light" id="text" name="text"></textarea>
						<input type="hidden" name="score">
						<input type="hidden" name="document" value="<?= $doc->id ?>">
						<button type="submit" class="prettyButton">Invia</button>
						<br>
					</form>
				</div>

				<div class="shadow left">
					<h3>Recensioni degli utenti</h3>

				</div>

			</article>
		</div>
	</main>

	<script type="text/javascript">
		var docFragm = new Fragment("documentFragment");
		docFragm.makeSelectors('a');
		var reviewForm = new FormControl("reviewForm");
		var filesTable = document.getElementById("filesTable");
		var rev = new Reviewer("stars",5,0,function(selectedValue) {
			reviewForm.form.score.value = selectedValue + 1;
		});
		makeResponsive(filesTable);
	</script>