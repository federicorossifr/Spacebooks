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
	var editForm = document.getElementById("editForm");
	FormControl(editForm);
	
}

editFormCheck();