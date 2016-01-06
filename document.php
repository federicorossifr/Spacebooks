<?php
	include "./php/partials/secured.php";
?>
<!DOCTYPE html>
<?php
	$docId = $_GET['id'];
	$doc = null;
	$reviews = null;
	$userReview = null;
	$isPurchased = null;
	try{
		$doc = Document::read($docId);
		$doc->populate();
		$reviews = $doc->reviews;
		$userReview = $doc->getUserRate($_SESSION['user']->id);
		$isPurchased = $user->hasPurchased($doc->id);
	} catch(Exception $e) {
		renderErrorPage($e->getMessage());
		die;
	}
	if( !$doc->available && $doc->author != $user->id && $user->role == "user") {
		renderErrorPage("Il documento non è ancora disponibile");
	}
	
?>
<html lang="it">
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
					<div class="stars">
						<?php
							drawStars(floor($doc->avg),5);
						?><br>
						<strong><?php echo $doc->avg . " ($doc->votings)" ?></strong>
					</div>
					<hr>
					<img id="docCover" src=" <?= $doc->picturePath ?> " width="200" alt="no">
					<a href="<?= ($doc->extendedAuthor)? "./profile.php?id=" . $doc->extendedAuthor->id: "#" ?>" class="prettyButton">Autore: <?= ($doc->extendedAuthor)? $doc->extendedAuthor->username: "Anonimo" ?></a>
					<span class="prettyButton">Prezzo: <?= $doc->price ?> crediti</span>

					<?php
						if($doc->price <= $user->credits && !$isPurchased && $doc->available)	
							echo "<a href=\"./php/buy.php?id=$doc->id\" class=\"prettyButton\">Acquista</a>";
						if($isPurchased)
							echo "<a id='openDoc' href='#' onclick='docFragm.that(2)' class=\"prettyButton\">Apri</a>";
						if($doc->price > $user->credits)
							echo "<a href='#' class=\"prettyButton\">Crediti insufficienti</a>";
						if(!$doc->available)
							echo "<a href='#' class=\"prettyButton\">Non disponibile</a>"
					?>

				</div>
					<div class="descriptionContainer"><?= $doc->description ?></div>
					

			</article>

			<?php if($isPurchased) { ?>
			<article data-fragment data-name="Files">
				<header><h2>File del documento</h2></header>
				<table class="userTable">
					<thead>
						<th>Nome</th>
						<th>Dimensione</th>
						<th>Data</th>
						<th>Link</th>
					</thead>

					<tbody id="filesTable">	
						<?php
							foreach($doc->files as $file) {
								$fileName = $file['name'];
								$fileSize = $file['size'];
								$fileId = $file['id'];
								$fileDate = $file['created'];
								echo "<tr>
										<td>$fileName</td>
										<td>$fileSize</td>
										<td>$fileDate</td>
										<td><a class='prettyButton' href='./php/download.php?did=$docId&fid=$fileId'>Scarica</a></td>
									</tr>";
							}
						?>
					</tbody>
				</table>
			</article>
			<?php } ?>

			<article id="reviews" data-fragment data-name="Recensioni">
			
			<?php if($user->id != $doc->author) { ?>
				<div class="left shadow">
					<h3>Dai una recensione</h3>
					<div id="stars"></div>
					<form id="reviewForm" method="POST" action="./php/review.php">
						<label for="text">Testo valutazione</label>
						<textarea class="light" id="text" name="text"><?= ($userReview != null)? $userReview['opinion']:'' ?></textarea>
						<input type="hidden" name="score" value="<?= ($userReview != null)? $userReview['score']:0 ?>">
						<input type="hidden" name="document" value="<?= $doc->id ?>">
						<input type="submit" class="prettyButton" value="INVIA" />
						<br>
					</form>
				</div>
			<?php } ?>

				<div class="shadow left">
					<h3>Recensioni degli utenti</h3>

					<?php if(!$reviews) {
						echo "<p class='emptyResult'>Non ci sono ancora recensioni da parte degli utenti</p>";
					}
					?>	
					<ul class="reviewList">
						<?php

							foreach($reviews as $rev) {
								if(!$rev['user']) {
									$rev['user'] = new stdClass(); //generic class for generic anonymous user
									$rev['user']->picture = "./img/default.png";
									$rev['user']->username = "Anonimo";
								}
								echo "<li>";
								echo "<img src='" . $rev['user']->picture . "'/>";
								echo "<div>";
									drawStars($rev['score'],5);
								echo "</div>";
								echo "<span>" . $rev['user']->username . "</span>";
								echo "<p>" . $rev['opinion'] . "</p>";
								echo "</li>";
							}

						?>
					</ul>

				</div>

			</article>

			<?php if($user->id == $doc->author) { ?>
			<article data-fragment data-name="Modifica">
				<header><h2>Modifica</h2></header>
				<form action="./php/edit.php" method="POST" id="editForm">
					<label>Titolo</label><br>
					<input type="text" value="<?= $doc->title ?>" name="title">
					<input type="hidden" name="description">
					<input type="hidden" name="model" value="document">
					<input type="hidden" name="docId" value="<?= $doc->id ?>">
					<label>Inserisci una descrizione di almeno 100 caratteri che illustri il contenuto del tuo documento.</label><br>
					<strong id="count">0</strong> caratteri inseriti. 					<div class="comboButton">
					<a class="prettyButton" href="#" onclick="command(event)" id="bold">Grassetto</a>
					<a class="prettyButton" href="#" onclick="command(event)" id="underline">Sottolineato</a>
					<a class="prettyButton" href="#" onclick="command(event)" id="italic">Corsivo</a>
					</div>
					<div class="descriptionContainer wide" id="editDescription"><?= $doc->description ?></div><br>
					<input class="prettyButton" type="submit" value="Modifica">
				</form>
			</article>
			<?php } ?>
		</div>
	</main>
	<script type="text/javascript" src="./js/components/document.js"></script>
	<script type="text/javascript">
		<?php
			echo "var tags = " . json_encode($doc->tags) . ";";
		?>
		initDocument();
	</script>
	<?php include("./php/partials/footer.php");?>
	</body>