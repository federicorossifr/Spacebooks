<script type="text/javascript" src="js/components/body.js"></script>
<body onload="bodyMain()">
	<header>
		<h1>Bookd</h1>
	</header>

	<nav>
		<ul id="navToggle">
			<li><a >Menu</a></li>
		</ul>

		<ul id="nav">
			<li <?php if($thisUrl == "/profile.php") echo "class='active' " ?> id="picture"><a id="toggleProfile"  href="#"><img src="<?= $user->picture ?>" alt="Profile"><?= " " . $user->username ?></a></li>

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

			<li class="right" id="searchButton"><a id="toggleSearch" href="#search"><img src="./img/search.png" >Cerca</a></li>
		</ul>
	</nav>


	<aside id="profile">

			<div id="pictureContainer">
				<img id="bigPicture" src="<?= $user->picture ?>" width="100" height="100" alt="Profile">
				<span id="changePicButton"  class="change">Change</span>

				<form method="POST" id="upPicture" action="php/newpic.php" enctype="multipart/form-data">
					<input id="fileInput" type="file" name="pic">
				</form>

			
			</div>

			<div id="close"></div>

			<header>
				<h2><?= $user->name . ' ' . $user->surname?></h2>
			</header>

			<ul id="sideButtons">
				<li><a class="prettyButton" href="profile.php">Profile</a></li>
				<li><a class="prettyButton" href="./php/logout.php">Logout</a></li>
			</ul>
		</aside>


		<aside id="search">
				<header>
					<h2>Ricerca</h2>
				</header>
			<form id="searchForm" method="POST" action="./test.php">



				<label for="data">Cosa vuoi cercare?</label>
				<input class="light" name="data" type="text" autocomplete="off">
				
				<ul class="shadow" id="resultList">


				</ul>



			</form>


			<script type="text/javascript">
				var searchForm = document.getElementById("searchForm");
				var dataInput = searchForm.data;
				var resultList = document.getElementById("resultList");

				function empty() {
					while(resultList.firstChild)
						resultList.removeChild(resultList.firstChild);
				}

				searchForm.onsubmit = function(event) {
					event.preventDefault();
					return false;
				}


				function displaySuggestion(data) {
					empty();
					var datas = data.split("]");
					var usrData = datas[1] + "]";
					var docData = datas[0] + "]";
					var decodedUsrData = JSON.parse(usrData);
					var decodedDocData = JSON.parse(docData);
					for(var i = 0; i < decodedDocData.length; ++i) {
						console.log(i + ": " + decodedDocData[i].title);
						var tmp = document.createElement("li");
						tmp.textContent=decodedDocData[i].title;
						resultList.appendChild(tmp);
					}

					for(var i = 0; i < decodedUsrData.length; ++i) {
						console.log(i + ": " + decodedUsrData[i].username);
						var tmp = document.createElement("li");
						tmp.textContent=decodedUsrData[i].username;
						resultList.appendChild(tmp);
					}
				}

				var postClient = new AsyncReq("./test.php",displaySuggestion);

				dataInput.oninput = function() {
					var searchData = dataInput.value.replace(/^[ ]+$/,"");
					if(searchData.length == 0) {empty(); return false;}
					var params = [{'id':'data','value':dataInput.value}];
					postClient.POST(params,"application/x-www-form-urlencoded");
				}
			</script>


		</aside>
