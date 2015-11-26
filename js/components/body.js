function Search() {
	var searchForm = document.getElementById("searchForm");
	var dataInput = searchForm.data;
	var resultList = document.getElementById("resultList");

	var postClient = new AsyncReq("./php/async/search.php",function(data) {
		displaySuggestion(data,resultList)
	});

	dataInput.oninput = function() {
		var searchData = dataInput.value.replace(/^[ ]+$/,"");
		if(searchData.length == 0) {empty(resultList); return false;}
		var params = [{'id':'data','value':dataInput.value}];
		postClient.POST(params,"application/x-www-form-urlencoded");
	}

	searchForm.onsubmit = function(event) {
		event.preventDefault();
		return false;
	}
}

function empty(element) {
	while(element.firstChild)
		element.removeChild(element.firstChild);
}

function displaySuggestion(data,resultList) {
	empty(resultList);
	var datas = data.split("]");
	var usrData = datas[1] + "]";
	var docData = datas[0] + "]";
	var decodedUsrData = JSON.parse(usrData);
	var decodedDocData = JSON.parse(docData);
	for(var i = 0; i < decodedDocData.length; ++i) {
		console.log(i + ": " + decodedDocData[i].title);
		var tmp = document.createElement("li");
		var tmpA = document.createElement("a");
		tmpA.textContent=decodedDocData[i].title;
		tmpA.href ="./document.php?id=" + decodedDocData[i].id;
		tmp.appendChild(tmpA);
		resultList.appendChild(tmp);
	}

	for(var i = 0; i < decodedUsrData.length; ++i) {
		console.log(i + ": " + decodedUsrData[i].username);
		var tmp = document.createElement("li");
		var tmpA = document.createElement("a");
		tmpA.textContent = decodedUsrData[i].username;
		tmpA.href =  "./profile.php?id=" + decodedUsrData[i].id;
		tmp.appendChild(tmpA);
		resultList.appendChild(tmp);
	}
}




function Body() {
	this.profileSide = document.getElementById("profile"); // Barra laterale "aside" a comparsa
	this.searchSide = document.getElementById("search");
	this.nav = document.getElementById("nav"); // Elemento "nav" per la navigazione
	this.closeProfile = document.getElementById("close"); // Pulsante di chiusura della barra "aside"
	this.navToggle = document.getElementById("navToggle"); // Pulsante di toggle per il nav responsive
	this.profileToggle = document.getElementById("toggleProfile"); // Pulsante di apertura della barra "aside"
	this.changePicButton = document.getElementById("changePicButton"); // Pulsante per il cambio dell'immagine di profilo
	this.profilePictureForm = document.getElementById("upPicture"); // Form contente l'input file della nuova immagine di profilo
	this.profilePictureFileInput = document.getElementById("fileInput"); // File input dell form.
	this.searchToggle = document.getElementById("toggleSearch");
	this.closeSearch = document.getElementById("closeSearch");
	this.profileState = false;
	this.searchState = false;
	this.menuState = false;
	this.windowWidth = window.innerWidth;

	var curr = this; // Aliasing dell'oggetto this per le istruzioni successive.
	this.closeProfile.onclick = function() {curr.profile();}
	this.profileToggle.onclick = function() {curr.profile();}
	this.navToggle.onclick = function() {curr.menu();}
	this.changePicButton.onclick = function() {curr.changePic();}
	this.searchToggle.onclick = function() {curr.searchT()}
	this.closeSearch.onclick = function() {curr.searchT()}

	with(this) {
		window.onresize = function() {
			windowWidth = window.innerWidth;
			profileSide.style.display = "none";
			if(windowWidth >= 720) {
				nav.style.display = "block";
				profileSide.style.top = "0";
				profileSide.style.left = "-300px";
				profileState = false;
			}
			else {
				nav.style.display = "none";
				profileSide.style.left = "0";
				profileSide.style.top = "-150%";
				profileState = false;
			}

				profileSide.style.display = "block";
				
		}

		if(windowWidth < 720)
			nav.style.display = "none";
	}
}


Body.prototype.changePic = function() {
	with(this) {
		profilePictureFileInput.click();	
		profilePictureFileInput.onchange = function() {
			profilePictureForm.submit();
		}
	}
}

Body.prototype.menu = function() {
	with(this) {
		if(menuState) 
			nav.style.display = "none";
		else
			nav.style.display = "block";
		menuState = !menuState;
	}
}

Body.prototype.searchT = function() {
	with(this) {
		if(searchState) {
			document.documentElement.style.overflowY = "auto"; // enable page scroll when panel is not triggered
			searchSide.style.left = "-100%";

		} else {
			document.documentElement.style.overflowY = "hidden"; // disable page scroll when panel is triggered
			if(windowWidth < 720) searchSide.style.left = "0";
			else searchSide.style.left = "calc(100% - 300px)";
			document.getElementById("searchForm").data.focus();
		}

		searchState = !searchState;
	}
}

Body.prototype.profile = function() {
	with(this) {
		if(profileState) {
			document.documentElement.style.overflowY = "auto"; // enable page scroll when panel is not triggered
			if(windowWidth < 720) profileSide.style.top = "-150%";
			else profileSide.style.left = "-100%";
		} else {
			document.documentElement.style.overflowY = "hidden"; // disable page scroll when panel is triggered
			if(windowWidth < 720) profileSide.style.top = "0";
				else profileSide.style.left = "0";
		}
		profileState = !profileState;
	}
}


function bodyMain() {
	new Body();
	Search();
}


