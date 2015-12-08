function initProfile() {
	var frgMnts = new Fragment("mainFragment");
	frgMnts.makeSelectors("a");
	var documentsTable = document.getElementById("documentsTable");
	makeResponsive(documentsTable);
	document.getElementById("searchButton").className+= " active";
}

function bigDocumentPicture(event,obj) {
	event.stopPropagation();
	event.preventDefault();
	var img = new Image();
	img.src = obj.src;
	img.alt = obj.alt;
	img.width = "200";
	var link = obj.parentElement.href;
	PictureModal("Premi OK per andare al documento",img,function() {location.href=link});
}

function editFormCheck() {
	var editForm = new FormControl("editForm");
	if(editForm.error) return;
	if(!editForm) return false;
	editForm.addConstraint("username",/.?/);
	editForm.addConstraint("password",/^$|.{6,9}/);
	editForm.addConstraintExtension("./php/async/exists.php","label","username","0","Already exists");

	editForm.form.onsubmit = function(event) {
		if(this.password.value != this.password2.value) {
			new Modal("Attenzione","Le password devono coincidere",function() {editForm.form.password2.focus()},false);
			event.preventDefault();
		}
	}

}

editFormCheck();