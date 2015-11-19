<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
	$profile = null;
	if(!isset($_GET['id']) || $_GET['id'] == $user->id) {
		$profile = $user;
		$self = true;
	} else {
		$id = $_GET['id'];
		$profile = User::read($id);
	}

	if($profile)
		$documents = $profile->getDocuments();

?>
<html lang="en">
	<?php
		include "./php/partials/header.php";
		include "./php/partials/body.php";
	?>

	<main id="mainFragment">
		<header><h2>Profilo di <?= $profile->username ?></h2></header>

		<article data-fragment data-name="Profilo Pubblico">
			<header><h3>Profile info</h3></header>
			<div class="left">
				<img class="shadow" src="<?= $profile->picture ?>" width="200" alt="no">
				
				<?php if(!$self) { ?>	
					<a class="prettyButton">Follow</a>
				<?php }?>
			</div>
			
				<dl>
					<dt>Name</dt>
					<dd><?= $profile->name ?></dd>

					<dt>Surname</dt>
					<dd><?= $profile->surname ?></dd>

					<dt>Birthdate</dt>
					<dd><?= $profile->birthdate ?></dd>

					<dt>Country</dt>
					<dd><?= $profile->country ?></dd>

					<dt>Email</dt>
					<dd><?= $profile->email ?></dd>

				</dl>

		</article>

		<article data-fragment data-name="Documenti" class="right">
			<header><h3>Documenti di <?= $profile->username  ?></h3></header>
			
			<table class="userTable">
				<thead>
					<th>Visualizza</th>
					<th>Titolo</th>
					<th>Prezzo</th>
					<th>Data pubblicazione</th>
					<th>Valutazione</th>
				</thead>

				<tbody id="documentsTable">
					<?php
						foreach($documents as $document) {
							echo "<tr>
									<td><a href='./document.php?id=$document->id' class='view'>
										<img src='./img/compass.png' alt='no '/></a>
									<td>$document->title
									<td>$document->price
									<td>$document->created
									<td>$document->score";
						}	
					?>
				</tbody>

			</table>
		</article>


		<article data-fragment data-name="Profilo Privato"></article>

	</main>
	</body>
	<script type="text/javascript">
		var frgMnts = new Fragment("mainFragment");
		frgMnts.makeSelectors();
		var documentsTable = document.getElementById("documentsTable");
		makeResponsive(documentsTable);
	</script>
</html>

