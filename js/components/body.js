var profileSide = document.getElementById("profile");
var form = document.getElementById("upPicture");
var fileInput = document.getElementById("fileInput");
var nav = document.getElementById("nav");
var closeProfile = document.getElementById("close");
var profileState = false;
var menuState = true;
function go() {
	fileInput.click();	
	fileInput.onchange = function() {
		form.submit();
	}
}

function menu() {
	if(menuState) 
		nav.style.display = "none";
	else
		nav.style.display = "block";

	menuState = !menuState;
}

function profile() {
	if(profileState) {
		document.documentElement.style.overflowY = "auto";
	} else {
		document.documentElement.style.overflowY = "hidden";
	}

	profileState = !profileState;
}


window.onresize = function() {
	var width = window.innerWidth;
	if(width >= 720)
		nav.style.display = "block";
}

