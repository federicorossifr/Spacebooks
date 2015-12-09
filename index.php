<!DOCTYPE html>
<html lang="it">
<?php
	session_start();
	if(!isset($_COOKIE['firstTime'])) {
		header("Location: ./about.php");
	}

	if(isset($_SESSION['user']) && $_SESSION['user']) {
		header("Location: ./home.php");
	}
	include "./php/partials/header.php";
?>


	<body onload="Index()" id="index">
		<header>
			<h1>Bookd</h1>
		</header>

		<section id="loginSection">
			<header>
				<h2>Accedi...</h2>
			</header>

			<form id="loginForm" method="POST" action="php/login.php">
				<label for="username">Username</label><br>
				<input type="text" id="username" name="username" />
				<label for="password">Password</label><br>
				<input type="password" id="password" name="password"  />
				<button id='loginButton' type="submit">ACCEDI</button>

				<span class="flash">
				<i>
				<?php
					if(isset($_SESSION['lerror'])) {
						echo $_SESSION['lerror'];
						unset($_SESSION['lerror']);
					}
				?>
				</i>
				</span>

			</form>
		</section>

		<section id="registerSection">
			<header>
				<h2>...o registrati</h2>
			</header>
				<form id="registerForm" method="POST" action="php/register.php">
					<div id="cA">
						<label id="nameW" for="name">Nome</label><br>
						<input type="text" id="name"  name="name" placeholder="Example: Mario" required />
						<label id="surnameW" for="surname">Cognome</label><br>
						<input type="text" id="surname" name="surname" placeholder="Example: Rossi" required />
						<label id="countryW" for="country">Nazione</label><br>
						<input type="text" id="country" name="country" placeholder="Example: Inghilterra" required>
						<label for="birthdate">Data di nascita</label><br>
						<input type="text" pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$" placeholder="Example: 15/09/1995" id="birthdate" name="birthdate" required>
					</div>
					<div id="cB">
						<label for="usernameR">Username</label>
						<input placeholder="Almeno 5 caratteri-numeri" type="text" name="username" id="usernameR" required />
						<label for="email">Email</label><br>
						<input type="email" placeholder="Ex: email@mail.com" id="email" name="email" required>
						<label for="password1">Password</label>
						<input type="password" placeholder="6-8 caratteri-numeri" id="password1" name="password1" required />
						<label for="password2">Ripeti</label>
						<input type="password" id="password2" placeholder="Le password devono coincidere" name="password2" required />
					</div>
					<button type="submit">REGISTRATI</button>
				</form>

			<a class="prettyButton" href="about.php">Cos&apos;&egrave; Bookd?</a>
		</section>
		<script type="text/javascript" src="js/components/index.js"></script>
	</body>
</html>