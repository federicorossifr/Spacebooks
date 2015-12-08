
function Index() {
	var registerForm = new FormControl("registerForm");
	registerForm.addConstraint("name",/^[A-Z]{1}[a-z]+$/);
	registerForm.addConstraint("surname",/[A-Z]{1}[a-z]+/);
	registerForm.addConstraint("country",/[A-Z]{1}[a-z]+/);
	registerForm.addConstraint("birthdate",/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/);
	registerForm.addConstraint("username",/.{5}/);
	registerForm.addConstraint("email",/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/);
	registerForm.addConstraint("password1",/.{6,10}/);
	registerForm.addConstraintExtension("./php/async/exists.php","label","email","0","Already exists");
	registerForm.addConstraintExtension("./php/async/exists.php","label","username","0","Already exists");
	registerForm.addMutualConstraint("password1","password2");
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