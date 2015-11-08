<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
	$docId = $_GET['id'];
	$doc = Document::read($docId);
	$cover = $doc->getCover();
	$files = $doc->getFiles();
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
					<img class="shadow" src=" <?= $cover ?> " width="200" alt="no">
					<span class="prettyButton"><?= $doc->price ?>BC</span>
					<a href="./php/buy.php?id=<?= $doc->id ?>" class="prettyButton">Acquista</a>
				</div>

					<?= $doc->description ?>


			</article>

			<article data-fragment data-name="Files">
				<table class="userTable">
					<thead>
						<th>Nome</th>
						<th>Dimensione</th>
						<th>Data</th>
						<th>Download</th>
					</thead>

					<tbody>	
						<?php
							foreach($files as $file) {
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
		</div>
	</main>

	<script type="text/javascript">
		var docFragm = new Fragment("documentFragment");
		docFragm.makeSelectors('a');
	</script>