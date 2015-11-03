function Body() {
	this.profileSide = document.getElementById("profile");
	this.nav = document.getElementById("nav");
	this.closeProfile = document.getElementById("close");
	this.profileState = false;
	this.menuState = false;
	this.windowWidth = window.innerWidth;
	this.profilePictureForm = document.getElementById("upPicture");
	this.profilePictureFileInput = document.getElementById("fileInput");

	with(this) {
		window.onresize = function() {
			windowWidth = window.innerWidth;
			profileSide.style.display = "none";
			if(windowWidth >= 720) {
				nav.style.display = "block";
				profileSide.style.top = "0";
			}
			else {
				nav.style.display = "none";
				profileSide.style.left = "0";
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


