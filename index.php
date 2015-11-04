<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	$cookies=false; 
	if($cookies) header("Location: ./home.php");
	include "./php/partials/header.php";
?>


	<body onload="Index()" id="index">
		<header>
			<h1>Bookd</h1>
		</header>

		<section id="loginSection">
			<header>
				<h2>Login</h2>
			</header>

			<form id="loginForm" method="POST" action="php/login.php">
				<label for="username">Username</label><br>
				<input type="text" id="username" name="username" />
				<label for="password">Password</label><br>
				<input type="password" id="password" name="password"  />
				<button type="submit">LOGIN</button>

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
				<h2>Register</h2>
			</header>
				<form id="registerForm" method="POST" action="php/register.php">
					<div id="cA">
						<label id="nameW" for="name">Name</label><br>
						
						<input type="text" id="name"  name="name" placeholder="Example: Federico" required />
						<label id="surnameW" for="surname">Surname</label><br>
						<input type="text" id="surname" name="surname" placeholder="Example: Rossi" required />
						<label id="countryW" for="country">Country</label><br>
						<input type="text" id="country" name="country" placeholder="Example: Italia" required>
						<label for="birthdate">Birthdate</label><br>
						<input type="text" pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$" placeholder="Example: 15/09/1995" id="birthdate" name="birthdate" required>
					</div>
					<div id="cB">
						<label for="usernameR">Username</label>
						<input placeholder="At least 5 keys" type="text" name="username" id="usernameR" required />
						<label for="email">Email</label><br>
						<input type="email" placeholder="Ex: email@mail.com" id="email" name="email" required>
						<label for="password1">Password</label>
						<input type="password" placeholder="Between 6 and 8 keys" id="password1" name="password1" required />
						<label for="password2">Again</label>
						<input type="password" id="password2" placeholder="Passwords must match" name="password2" required />
					</div>
					<button type="submit">REGISTER</button>

					<span class="flash">
						<i>
						<?php
							if(isset($_SESSION['rerror'])) {
								echo $_SESSION['rerror'];
								unset($_SESSION['rerror']);
							}
						?>
						</i>
					</span>



				</form>

			<a class="prettyButton" href="about.html">Cos&apos;&egrave; Bookd?</a>


		</section>
		<script type="text/javascript" src="js/components/index.js"></script>
	</body>
</html>