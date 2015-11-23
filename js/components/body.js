function Body() {


	this.profileSide = document.getElementById("profile"); // Barra laterale "aside" a comparsa
	this.nav = document.getElementById("nav"); // Elemento "nav" per la navigazione
	this.closeProfile = document.getElementById("close"); // Pulsante di chiusura della barra "aside"
	this.navToggle = document.getElementById("navToggle"); // Pulsante di toggle per il nav responsive
	this.profileToggle = document.getElementById("toggleProfile"); // Pulsante di apertura della barra "aside"
	this.changePicButton = document.getElementById("changePicButton"); // Pulsante per il cambio dell'immagine di profilo
	this.profilePictureForm = document.getElementById("upPicture"); // Form contente l'input file della nuova immagine di profilo
	this.profilePictureFileInput = document.getElementById("fileInput"); // File input dell form.

	this.profileState = false;
	this.menuState = false;
	this.windowWidth = window.innerWidth;

	var curr = this; // Aliasing dell'oggetto this per le istruzioni successive.
	this.closeProfile.onclick = function() {curr.profile();}
	this.profileToggle.onclick = function() {curr.profile();}
	this.navToggle.onclick = function() {curr.menu();}
	this.changePicButton.onclick = function() {curr.changePic();}

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
}


