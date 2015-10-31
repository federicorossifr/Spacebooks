<body>
	<header>
		<h1>Bookd </h1>
	</header>

	<nav>
		<ul id="navToggle">
			<li><a onclick="menu()">Menu</a></li>
		</ul>

		<ul id="nav">
			<li id="picture"><a onclick="profile()" href="#profile"><img src="<?= $user->picture ?>" alt="no"></a></li>
			
			<?php
				foreach ($menuVoices as $name => $address) {
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
				<img id="bigPicture" src="<?= $user->picture ?>" width="100" height="100" alt="noImg">
				<span onclick="go()" class="change">Change</span>

				<form method="POST" id="upPicture" action="php/newpic.php" enctype="multipart/form-data">
					<input id="fileInput" type="file" name="pic">
				</form>

			
			</div>

			<a onclick="profile()" href="#" id="close">&times;</a>

			<header>
				<h2><?= $user->name . ' ' . $user->surname?></h2>
			</header>

			<ul id="sideButtons">
				<li><a class="prettyButton" href="profile.php">Profile</a></li>
				<li><a class="prettyButton" href="#">Links</a></li>
				<li><a class="prettyButton" href="/">Logout</a></li>
			</ul>
		</aside>

<script type="text/javascript" src="js/components/body.js"></script>