<?php
	session_start();
?>
<!DOCTYPE html>
<?php
	if(!isset($_SESSION['exception'])) {
		$_SESSION['exception'] = "Nulla da mostrarti qua";
	}
?>
<html lang="it">
<?php
	include "./php/partials/header.php";
?>

	<main>
		<header><h2>Attenzione</h2></header>

		<article class="exception">
			<header><h3><?php echo $_SESSION['exception'] ?></h3></header>
			<p>
				Ci sono stati degli errori nel processare la tua richiesta
			</p>
			<a class="prettyButton" href="./">Torna alla home</a>
		</article>
	</main>
	<?php
		unset($_SESSION['exception']);
	?>
</body>