<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";

	if($user->role == "user") header("Location: ./home.php");
	$users = User::fetchAll();
?>

	<main id="coso">
		<article data-fragment data-name="Utenti">
			<header><h2>Utenti</h2></header>
			<table class="userTable">
				<thead>
					<th>Nome</th>
					<th>Cognome</th>
					<th>Username</th>
					<th>Email</th>
					<th>Password</th>
					<th>Data di nascita</th>
					<th>Nazionalità</th>
				</thead>
				<tbody>
					<?php
						foreach ($users as $tmp) {
							echo "
								<tr>
									<td>$tmp->name</td>
									<td>$tmp->surname</td>
									<td>$tmp->username</td>
									<td>$tmp->email</td>
									<td>$tmp->password</td>
									<td>$tmp->birthdate</td>
									<td>$tmp->country</td>
								</tr>


							";
						}
				?>	
				</tbody>
			</table>

		</article>

		<article data-fragment data-name="Documenti">
			<header><h2>Documenti</h2></header>

			
		</article>
		
		<article data-fragment data-name="Moderatori">
			<header><h2>Moderatori</h2></header>

			
		</article>

	</main>

<script type="text/javascript">
	var coso = new Fragment("coso");
	coso.makeSelectors("a");
</script>