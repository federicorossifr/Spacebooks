function initEditCenter() {
	var editCenter = document.getElementById("editDescription");
	if(!editCenter) return;
	var editForm = document.getElementById("editForm");
	var editor = editCenter.getElementsByTagName("div")[0];
	editor.contentEditable = true;
	countLeft(editor,100,document.getElementById("count"));

	editForm.onsubmit = function(event) {
		event.preventDefault();
		var parseResult = emitter(editor);
		if(parseResult['rawData'].length < 100) {editor.focus(); return;}
		this.description.value = parseResult['outData'];
		this.submit();
	}
}

function initDocument() {
	storeTags(tags);
	var docFragm = new Fragment("documentFragment");
	docFragm.makeSelectors('a');
	docFragm.loadState();
	var reviewForm = document.getElementById("reviewForm");
	var initialSelect = reviewForm.score.value;
	var filesTable = document.getElementById("filesTable");

	var rev = new Reviewer("stars",5,initialSelect,function(selectedValue) {
		reviewForm.score.value = selectedValue + 1;
	});
	try {
	document.getElementById("openDoc").onclick = function() {
		docFragm.that(1);
	}} catch(excp) {};

	try {
		makeResponsive(filesTable);
	} catch(excp) {};

	document.getElementById("searchButton").className+=" active";
	initEditCenter();
}