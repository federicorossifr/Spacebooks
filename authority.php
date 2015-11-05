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
			
		</article>
		
		<article data-fragment data-name="Moderatori">
			
		</article>

	</main>

<script type="text/javascript">
	var coso = new Fragment("coso");
	coso.makeSelectors();
</script>