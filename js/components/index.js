function Index() {
	var registerForm = document.forms[1];
	FormControl(registerForm);
}


function handleLoginResult(data) {
	if(data == 0) {
		new Modal("Attenzione","Le credenziali fornite non sono corrette");
	} else {
		location.href = "./home.php";
	}

	document.forms[0].loginButton.className = "";
	document.forms[0].loginButton.textContent = "LOGIN";
}

document.forms[0].onsubmit = function(event) {
	document.activeElement.blur(); // disable multiple "enter" press
	event.preventDefault();

	this.loginButton.className = "loading";
	this.loginButton.textContent = "";

	var username = this.username.value;
	var password = this.password.value;
	var loginParams =  [{'id':'username','value':username},
					    {'id':'password','value':password}];
	var loginClient = new AsyncReq("./php/login.php",handleLoginResult);
	loginClient.POST(loginParams,"application/x-www-form-urlencoded");
}