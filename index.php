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
						<input type="text" pattern="[A-Z]{1}[a-z]+" id="name" name="name" placeholder="Example: Mario" title="Inserire un nome valido, prima lettera maiuscola, solo lettere." required />
						<label id="surnameW" for="surname">Cognome</label><br>
						<input type="text" id="surname" name="surname" title="Inserire un cognome valido, prima lettera maiuscola, solo lettere." placeholder="Example: Rossi" required />
						<label id="countryW"  for="country">Nazione</label><br>
						<input type="text" title="Inserire una nazione corretta: solo lettere" id="country" name="country" placeholder="Example: Inghilterra" required>
						<label for="birthdate">Data di nascita</label><br>
						<input type="text" pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$" title="Inserire una data nel formato gg/mm/aaaa" placeholder="Example: 15/09/1995" id="birthdate" name="birthdate" required>
					</div>
					<div id="cB">
						<label for="usernameR">Username</label>
						<input data-query="./php/async/exists.php?label=" data-query-error="Username già esistente" pattern=".{6,9}" placeholder="Almeno 5 caratteri-numeri" title="Inserisci tra i 6 e i 10 caratteri e/o numeri" type="text" name="username" id="usernameR" required />
						<label for="email">Email</label><br>
						<input pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Inserisci un email corretta: email@provider.ext" type="email" placeholder="Ex: email@mail.com" id="email" name="email" required>
						<label  for="password1">Password</label>
						<input type="password" pattern=".{7,20}" title="Inserisci una password corretta: almeno 7 caratteri e/o numeri (max 20)" placeholder="7-20 caratteri-numeri" id="password1" name="password1" required />
						<label for="password2">Ripeti</label>
						<input data-match="password1" type="password" id="password2" title="Le due password devono coincidere" placeholder="Le password devono coincidere" name="password2" required />
					</div>
					<button type="submit">REGISTRATI</button>
				</form>

			<a class="prettyButton" href="about.php">Cos&apos;&egrave; Bookd?</a>
		</section>
		<script type="text/javascript" src="js/components/index.js"></script>
	</body>
</html>