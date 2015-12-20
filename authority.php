<?php
	include "./php/partials/secured.php";
?>
<!DOCTYPE html>
<html lang="it">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";

	if($user->role == "user") header("Location: ./home.php");
	$users = User::fetchAll();
	$documents = Document::fetchAll();
?>

		<main id="authorityFragmentContainer">
			<?php if($user->role == "admin") { ?>
			<article data-fragment data-name="Utenti">
				<form class="combo">
					<input class="light" type="search" id="userFilter">
					<select class="light" id="userSelector"></select>
				</form>
				<header><h2>Utenti</h2></header>
				<table class="userTable">
					<thead>
						<th>Id</th>
						<th>Username</th>
						<th>Email</th>
						<th>Data di nascita</th>
						<th>Nazionalità</th>
						<th>Ruolo</th>
						<th>Azione</th>
					</thead>
					<tbody id="userTable">
						<?php
							foreach ($users as $tmp) {
								echo "
									<tr>
										<td>$tmp->id</td>
										<td>$tmp->username</td>
										<td>$tmp->email</td>
										<td>$tmp->birthdate</td>
										<td>$tmp->country</td>
										<td>$tmp->role</td>
										<td>
											<select onchange='action(this)' data-id='$tmp->id' data-model='user'>
												<option value='-1'>Scegli azione</option>";
										if($tmp->role == "user")
											echo "<option value='0'>Promuovi a moderatore</option>";
										if($tmp->role == "moderator")
											echo "<option value='1'>Revoca promozione</option>";
								echo "

												<option value='3'>Sospendi</option>
												<option value='2'>Rimuovi</option>
											</select>
										</td>
									</tr>
								";
							}
					?>	
					</tbody>
				</table>

			</article>
			<?php } ?>

			<article data-fragment data-name="Documenti">
				<header><h2>Documenti</h2></header>
				<form class="combo">
					<input class="light" type="search" id="documentFilter">
					<select class="light" id="documentSelector"></select>
				</form>
				<table class="userTable">
					<thead>
						<th>Titolo</th>
						<th>Link</th>
						<th>Creazione</th>
						<th>Ultima Modifica</th>
						<th>Autore</th>
						<th>Disponibile</th>
						<th>Azione</th>
					</thead>
					<tbody id="documentTable">
						<?php
							foreach ($documents as $tmp) {
								if(!$tmp->author) $tmp->author = 0;
								echo "
									<tr>
										<td>$tmp->title</td>
										<td><a class='prettyButton' href='./document.php?id=$tmp->id'>Vai</a></td>
										<td>$tmp->created</td>
										<td>$tmp->updated</td>
										<td>$tmp->author</td>
											<td>$tmp->available</td>
										<td>
											<select onchange='action(this)' data-id='$tmp->id' data-model='document'>
												<option value='-1'>Scegli azione</option>
												<option value='0'>Convalida</option>
												<option value='1'>Sospendi</option>
												<option value='2'>Rimuovi</option>
											</select>
										</td>
									</tr>
								";
							}
					?>	
					</tbody>
				</table>
				
			</article>
		</main>
	<script type="text/javascript" src="./js/components/authority.js"></script>
	<script type="text/javascript">main()</script>
	<?php include("./php/partials/footer.php");?>
	</body>



</html>