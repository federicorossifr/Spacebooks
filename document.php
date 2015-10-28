<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
	$docId = $_GET['id'];
	$doc = Document::read($docId);

?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
?>

	<main>
		<?php if($doc){ ?>
			<header><h2><?= $doc->title ?></h2></header>

			<article class="left">
				<?= $doc->description ?>
			</article>

		<?php } else { ?>
			<header><h2>Documento non trovato</h2></header>
		<?php } ?>
	</main>