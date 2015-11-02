<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
	$profile = null;
	if(!isset($_GET['id'])) {
		$profile = $user;
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

		<article data-fragment data-name="Informazioni">
			<header><h3>Profile info</h3></header>
			<div class="left">
				<img class="shadow" src=" <?= $profile->picture ?> " alt="no">
				<a class="prettyButton">Follow</a>
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
			<p>	
				<ul class="documentList">
					<?php
						foreach($documents as $doc) {
							echo "<li><a href='document.php?id=" . $doc->id . "'>" . $doc->title . "</a></li>";
						}

					?>
				</ul>
			</p>
		</article>

	</main>
	</body>
	<script type="text/javascript">
		var frgMnts = new Fragment("mainFragment");
		frgMnts.makeSelectors();
	</script>
</html>

