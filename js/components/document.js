function initDocument() {
	storeTags(tags);
	var docFragm = new Fragment("documentFragment");
	docFragm.makeSelectors('a');
	docFragm.loadState();
	var reviewForm = new FormControl("reviewForm");
	var initialSelect = reviewForm.form.score.value;
	var filesTable = document.getElementById("filesTable");
	var rev = new Reviewer("stars",5,initialSelect,function(selectedValue) {
		reviewForm.form.score.value = selectedValue + 1;
	});
	document.getElementById("openDoc").onclick = function() {
		docFragm.that(2);
	}
	makeResponsive(filesTable);
}