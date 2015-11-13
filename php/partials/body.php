<body>
	<header>
		<h1>Bookd</h1>
	</header>

	<nav>
		<ul id="navToggle">
			<li><a onclick="BodyInstance.menu()">Menu</a></li>
		</ul>

		<ul id="nav">
			<li <?php if($thisUrl == "/profile.php") echo "class='active' " ?> id="picture"><a onclick="BodyInstance.profile()" href="#"><img src="<?= $user->picture ?>" alt="Profile"></a></li>

			<?php
				foreach ($menuVoices as $name => $address) {
					if($name == "admin" && $user->role != "admin") continue;
					if($name == "moderate" && $user->role != "moderator") continue;
					$name = ucfirst($name);
					echo "<li ";
					if($address == $thisUrl) echo "class='active'";
					echo "><a href='.$address' >$name</a></li>"; 
				}
			?>
		</ul>
	</nav>


	<aside id="profile">

			<div id="pictureContainer">
				<img id="bigPicture" src="<?= $user->picture ?>" width="100" height="100" alt="Profile">
				<span onclick="BodyInstance.changePic()" class="change">Change</span>

				<form method="POST" id="upPicture" action="php/newpic.php" enctype="multipart/form-data">
					<input id="fileInput" type="file" name="pic">
				</form>

			
			</div>

			<div onclick="BodyInstance.profile()" id="close"></div>

			<header>
				<h2><?= $user->name . ' ' . $user->surname?></h2>
			</header>

			<ul id="sideButtons">
				<li><a class="prettyButton" href="profile.php">Profile</a></li>
				<li><a class="prettyButton" href="./php/logout.php">Logout</a></li>
			</ul>
		</aside>

<script type="text/javascript" src="js/components/body.js"></script>