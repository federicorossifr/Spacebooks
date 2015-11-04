<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";

	if($user->role == "user") header("Location: ./home.php");
?>

	<main id="coso">
		<article data-fragment data-name="Utenti">
			

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