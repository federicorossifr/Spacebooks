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
		var tmp = document.createElement("li");
		tmp.className = "documentResult";
		var tmpA = document.createElement("a");
		tmpA.textContent=decodedDocData[i].title;
		tmpA.href ="./document.php?id=" + decodedDocData[i].id;
		tmp.appendChild(tmpA);
		resultList.appendChild(tmp);
	}

	for(var i = 0; i < decodedUsrData.length; ++i) {
		var tmp = document.createElement("li");
		var tmpA = document.createElement("a");
		tmpA.textContent = decodedUsrData[i].username;
		tmpA.href =  "./profile.php?id=" + decodedUsrData[i].id;
		tmp.appendChild(tmpA);
		tmpA.style.backgroundImage = "url('."+decodedUsrData[i].picture+"')";
		resultList.appendChild(tmp);
	}
}




function Body() {
	this.profileSide = document.getElementById("profile"); // Barra laterale "aside" a comparsa
	this.searchSide = document.getElementById("search");

	this.navList = document.getElementById("nav"); // Elemento "nav" per la navigazione
	this.navToggle = document.getElementById("navToggle"); // Pulsante di toggle per il nav responsive
	
	this.closeProfile = document.getElementById("close"); // Pulsante di chiusura della barra "aside"
	this.profileToggle = document.getElementById("toggleProfile"); // Pulsante di apertura della barra "aside"

	this.changePicButton = document.getElementById("changePicButton"); // Pulsante per il cambio dell'immagine di profilo
	this.profilePictureForm = document.getElementById("upPicture"); // Form contente l'input file della nuova immagine di profilo
	this.profilePictureFileInput = document.getElementById("fileInput"); // File input dell form.
	
	this.searchToggle = document.getElementById("toggleSearch");
	this.closeSearch = document.getElementById("closeSearch");
	
	this.profileState = false;
	this.searchState = false;
	this.menuState = true;
	
	this.windowWidth = window.innerWidth;
	this.logo = document.getElementById("logo");

	this.closeProfile.onclick = this.profile.bind(this);
	this.profileToggle.onclick = this.profile.bind(this);
	this.navToggle.onclick = this.menu.bind(this);
	this.changePicButton.onclick = this.changePic.bind(this);
	this.searchToggle.onclick = this.searchT.bind(this);
	this.closeSearch.onclick = this.searchT.bind(this);

	with(this) {
		window.onresize = function() {
			windowWidth = window.innerWidth;
		if(windowWidth < 1024) {
			navList.style.display = "none";
			navList.style.maxHeight = "0";
			this.menuState = false;
		}
		else
			navList.style.display = "block";
	}}

	this.menu();
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
		navList.style.transition = "max-height 0.3s ease-in-out";
		if(menuState) 
			navList.style.maxHeight = "0";
		else {
			navList.style.maxHeight = "500px";
			navList.style.display = "block";
		}
		menuState = !menuState;
	}
}

Body.prototype.searchT = function() {
	with(this) {
		if(searchState) {
			searchSide.style.left = "-100%";

		} else {
			searchSide.style.left = "0";
			document.getElementById("searchForm").data.focus();
		}
		searchState = !searchState;
	}
}

Body.prototype.profile = function() {
	with(this) {
		if(profileState) {
			profileSide.style.left = "-100%";
		} else {
			profileSide.style.left = "0";
		}
		profileState = !profileState;
	}
}


function bodyMain() {
	new Body();
	Search();
	var navContainer = document.getElementsByTagName("nav")[0];
	navContainer.className = "static";

	window.onscroll = function() {  // evento di scroll per mantenere una barra di navigazione nel top dell'applicazione
		var scrolled = parseInt(document.body.scrollTop);
		var threshold = 85;
		if(scrolled >= threshold) {
			navContainer.className = "fixed";
			document.body.style.marginTop = threshold + "px";
			document.getElementById("logo").style.maxWidth ="200px";
		} else {
			navContainer.className = "static";
			document.body.style.marginTop = 0;
			document.getElementById("logo").style.maxWidth = "0";
		}
	}
}




