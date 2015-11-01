var createForm = document.getElementById("createForm");
var myUploader = new PicUploader("uploader");
var initialFileUploader = document.getElementById("initial");
var myUp = new multiUploader();
myUp.addUploader(initialFileUploader,false);
var formH = new Form("createForm");
formH.addConstraint("title",/^([A-Z]{1}[a-z ]{1,45})$/);
formH.addConstraint("price",/^\d{1,2}$/)
formH.addConstraint("tags",/^(\w+;)+$/);

var fragments = new Fragment("createForm");
fragments.makeSelectors("a");


var editor = document.getElementById("description");
var editorOut = new Array();

createForm.onsubmit = function(e) {
	e.preventDefault();
	parse(editor,editorOut);
	var strOut = editorOut.join("");
	this.description.value = strOut;
	var editorRawText = editor.textContent.replace(/\s+/g, '');
	if(editorRawText == "" || editorRawText.length < 100) {alert("La descrizione è obbligatoria e deve essere di almeno 100 caratteri"); return;}
	if(!myUp.lastUsed) {alert("Un uploader non è stato utilizzato"); return;}
	this.submit();
}

