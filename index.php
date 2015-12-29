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


	<body onload="Index(index);" id="index">
		<header>
			<h1><a href="./">Spacebooks</a></h1>
		</header>

		<main>
		<section id="loginSection">
			<header>
				<h2>Accedi</h2>
				<h6>( L'&apos;username è case <em>sensitive</em> )</h6>
			</header>

			<form id="loginForm" method="POST" action="php/login.php">
				<label for="username">Username</label><br>
				<input type="text" id="username" name="username" />
				<label for="password">Password</label><br>
				<input type="password" id="password" name="password"  />
				<input class="prettyButton" id='loginButton' type="submit" value="ACCEDI">

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
				<h2>registrati</h2>
				<h6> (ricorda che successivamente potrai cambiare solo username e password)</h6>
				<br>
			</header>
				<form id="registerForm" method="POST" action="php/register.php">
					<div id="cA">
						<label id="nameW" for="name">Nome</label><br>
						<input type="text" pattern="^[a-zA-Zìàèò ,.'-]+$" title="Inserisci un nome valido"  id="name" name="name"  required />
						<label id="surnameW"  for="surname">Cognome</label><br>
						<input type="text" title="Inserisci un cognome valido" pattern="^[a-zA-Zìàèò ,.'-]+$"   id="surname" name="surname" required />
						<label id="countryW" for="country">Nazione</label><br>
						<select id="country" name="country" required>
							<option value="">Scegli una nazione</option>
							<option value="Italia">Italia</option>
							<option value="Inghilterra">Inghilterra</option>
							<option value="Islanda">Islanda</option>
						</select>
						<label for="birthdate">Data di nascita</label><br>
						<input type="text" data-date pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$" title="Inserire una data nel formato gg/mm/aaaa"  id="birthdate" name="birthdate" required>
					</div>
					<div id="cB">
						<label for="usernameR">Username</label>
						<input data-query="./php/async/exists.php?label=" data-query-error="Username già esistente" pattern="[a-zA-Z0-9_-]{6,10}"  title="Inserisci tra i 6 e i 10 caratteri,numeri o i simboli '-_'" type="text" name="username" id="usernameR" required />
						<label for="email">Email</label><br>
						<input pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Inserisci un email corretta: email@provider.ext" type="email"  id="email" name="email" required>
						<label  for="password1">Password</label>
						<input type="password" pattern=".{7,20}" title="Inserisci una password corretta: almeno 7 caratteri e/o numeri (max 20)"  id="password1" name="password1" required />
						<label for="password2">Ripeti</label>
						<input data-match="password1" data-match-error="Le password non coincidono" type="password" id="password2" title="Le due password devono coincidere" name="password2" required />
					</div>
					<input class="prettyButton" type="submit" value="REGISTRATI">
				</form>
					<a class="prettyButton" href="#siteFooter">Cos&apos;&egrave; Spacebooks?</a>

		</section>
		</main>
		<script type="text/javascript" src="js/components/index.js"></script>
		<?php include("./php/partials/footer.php");?>
	</body>


</html>