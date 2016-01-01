function Index(body) {
	document.body.style.opacity = 1;
	document.documentElement.style.backgroundImage = "none";
	var registerForm = document.forms[1];
	FormControl(registerForm);
}


function handleLoginResult(data) {
	if(data == 0) {
		new Modal("Attenzione","Le credenziali fornite non sono corrette");
	} else if(data == 1) {
		location.href = "./home.php";
	} else {
		new Modal("Attenzione","Errore interno del server, riprovare più tardi");
	}

	document.forms[0].loginButton.className = "prettyButton";
	document.forms[0].loginButton.value = "ACCEDI";
}

document.forms[0].onsubmit = function(event) {
	document.activeElement.blur(); // disable multiple "enter" press
	event.preventDefault();

	this.loginButton.className = "prettyButton loading";
	this.loginButton.value = "";

	var username = this.username.value;
	var password = this.password.value;
	var loginParams =  [{'id':'username','value':username},
					    {'id':'password','value':password}];
	var loginClient = new AsyncReq("./php/login.php",handleLoginResult);
	loginClient.POST(loginParams,"application/x-www-form-urlencoded");
}