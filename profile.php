<?php
	include "./php/partials/secured.php";
?>
<!DOCTYPE html>
<?php
	$profile = null;
	$self = false;
	if(!isset($_GET['id']) || $_GET['id'] == $user->id) {
		$profile = $user;
		$self = true;
	} 
	else {
		$id = $_GET['id'];
		try {
			$profile = User::read($id);
		} catch(Exception $e) {
			renderErrorPage($e->getMessage());
			die;
		}
	}

	$followers = null;
	$documents = $profile->getDocuments();
	$followers = $profile->getFellows();
	$_SESSION['visiting'] = $profile->email;
	$following = false;
	foreach($followers as $follower) {
		if($follower['follower'] == $user->id)
			$following = true;
	}
?>
<html lang="it">
	<?php
		include "./php/partials/header.php";
		include "./php/partials/body.php";
	?>

	<main id="mainFragment">
		<header><h2>Profilo di <?= $profile->name ?></h2></header>

		<article data-fragment data-name="Profilo Pubblico">
			<header><h3>Profile info</h3></header>
			<div class="left">
				<img class="profilePicture" src="<?= $profile->picture ?>"  alt="no">
				
				<?php if(!$self && !$following) { ?>
					<a id="follow" onclick="ajaxFollow(this)" data-mate="<?= $profile->id ?>" data-follow="0" class="prettyButton">Segui</a>
				<?php }?>
				<?php if(!$self && $following) { ?>
					<a id="follow" onclick="ajaxFollow(this)" data-mate="<?= $profile->id ?>" data-follow="1" class="prettyButton">Smetti di seguire</a>
				<?php } ?> 
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
					<dd><img src="./php/generateMail.php" alt="Email address"><dd>
				</dl>
		</article>

		<article data-fragment data-name="Documenti">
			<header><h3>Documenti di <?= $profile->username  ?></h3></header>
		
			<?php if($documents) {	?>		
			<table class="userTable">
				<thead>
					<th>Copertina( clicca per aprire il documento )</th>
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
											<img class='shadow' onclick='bigDocumentPicture(event,this)' src='{$document->picturePath}' width=\"200\" alt='no '/></a>
										<td>$document->title
										<td>$document->price
										<td>$document->created
										<td>";
									if($document->votings > 0) echo $document->score/$document->votings;
									else echo 0;
							}	
					?>
				</tbody>

			</table>
			<?php 
				} else {
					echo "<p class='emptyResult'>L'utente non ha caricato ancora nulla, torna un&apos;altra volta</p>";
				}



			?>
		</article>


		<?php if($self) { ?>
		<article id="private" data-fragment data-name="Profilo Privato">



			<dl class="left">
					<dt>I tuoi crediti</dt>
					<dd><?= $profile->credits ?>
					</dd>

					<dt>Il tuo nome utente per l'accesso</dt>
					<dd><?= $profile->username ?></dd>

					<dt>La tua email</dt>
					<dd><?= $profile->email ?>
					</dd>

			</dl>

			<div class="right shadow">
				<h3>Modifica dati accesso</h3>
				<form method="POST" action="./php/edit.php" id="editForm">
						<label  for="oldPassword">Vecchia password</label>
						<input class="light" type="password" id="oldPassword" name="oldPassword" required>
						<label for="username">Nuovo nome utente (lascia vuoto per non cambiare)</label>
						<input data-query="./php/async/exists.php?label=" data-query-error="Username già esistente" pattern="[a-zA-Z0-9_-]{6,10}"  title="Inserisci tra i 6 e i 10 caratteri,numeri o i simboli '-_'" class="light" type="text" id="username" name="username">
						<label for="password">Nuova password (lascia vuoto per non cambiare)</label>
						<input pattern=".{7,20}" title="Inserisci una password corretta: almeno 7 caratteri e/o numeri (max 20)" class="light" type="password" id="password" name="password">
						<label for="password2">Ripeti password</label>
						<input data-match="password" data-match-error="Le password non coincidono" class="light" type="password" id="password2" name="password2">
						<input type="hidden" value="user" name="model">
						<input type="submit" class="prettyButton" value="Fatto"><br>
				</form>
			</div>



		</article>
		<?php } ?>
	</main>
	</body>
	<script type="text/javascript" src="./js/components/profile.js"></script>
	<script type="text/javascript">
		initProfile();
		<?php
			if(isset($_SESSION['eError'])) {
				echo "new Modal('Errore','{$_SESSION['eError']}',null)";
				unset($_SESSION['eError']);
			}
		?>
	</script>
	<?php include("./php/partials/footer.php");?>


</html>

