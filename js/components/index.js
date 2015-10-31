var registerForm = new Form("registerForm");
registerForm.addConstraint("name",/^[A-Z]{1}[a-z]+$/);
registerForm.addConstraint("surname",/[A-Z]{1}[a-z]+/);
registerForm.addConstraint("country",/[A-Z]{1}[a-z]+/);
registerForm.addConstraint("birthdate",/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/);
registerForm.addConstraint("username",/.{5}/);
registerForm.addConstraint("email",/.{20}/);
registerForm.addConstraint("password1",/.{6,10}/);

registerForm.addConstraintExtension("./php/async/exists.php","label","email","0","Already exists");
registerForm.addConstraintExtension("./php/async/exists.php","label","username","0","Already exists");


registerForm.addMutualConstraint("password1","password2");