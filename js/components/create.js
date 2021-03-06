function Create() {
	this.createForm = document.getElementById("createForm");
	
	this.myUploader = new PicUploader("uploader");
	this.initialFileUploader = document.getElementById("initial");
	
	this.myUp = new multiUploader();
	this.myUp.addUploader(this.initialFileUploader,false);
	
	FormControl(this.createForm);
	this.fragments = new Fragment("createForm");
	this.fragments.makeSelectors("a");

	this.tagHandler = new Tag('tags');

	var curr = this;
	this.initialFileUploader.onclick = function() {
		curr.myUp.addUploader(this,true);
	}

	this.editor = document.getElementById("description");
	this.editorOut = new Array();

	countLeft(document.getElementById("description"),100,document.getElementById("count"));

	with(this) {
		this.createForm.onsubmit = function(e) {
			editorOut = new Array();
			e.preventDefault();
			editor.id = "";
			editor.className = "description";
			var dataEmitted = emitter(editor);
			this.description.value = dataEmitted['outData'];
			var editorRawText =	dataEmitted['rawData'];

			if(editorRawText == "" || editorRawText.length < 100) {
				var pop = new Modal(
					"Attenzione",
					"La descrizione è obbligatoria e deve essere di almeno 100 caratteri",
					function() {fragments.that("1");}
				);
				return;
			}

			if(!myUp.lastUsed) {
				var pop = new Modal(
					"Attenzione",
					"Non sono stati usati tutti gli uploader.Elimina l'uploader o utilizzalo.",
					function() {fragments.that("2")}
				);
				return;
			}

			this.tags.value = tagHandler.emit();
			this.submit();
		}
	}
}

window.onbeforeunload = function(event) {
	console.log(event.target);
	return "Stai creando un documento, vuoi abbandonare?"
};