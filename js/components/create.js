function Create() {
	this.createForm = document.getElementById("createForm");
	
	this.myUploader = new PicUploader("uploader");
	this.initialFileUploader = document.getElementById("initial");
	
	this.myUp = new multiUploader();
	this.myUp.addUploader(this.initialFileUploader,false);
	
	this.formH = new Form("createForm");
	this.formH.addConstraint("title",/^([A-Z]{1}[a-z ]{1,45})$/);
	this.formH.addConstraint("price",/^\d{1,2}$/)
	this.formH.addConstraint("tags",/^(\w+;)+$/);
	
	this.fragments = new Fragment("createForm");
	this.fragments.makeSelectors("a");

	var curr = this;
	this.initialFileUploader.onclick = function() {
		curr.myUp.addUploader(this,true);
	}

	this.editor = document.getElementById("description");
	this.editorOut = new Array();


	with(this) {
		this.createForm.onsubmit = function(e) {
			editorOut = new Array();
			e.preventDefault();
			parse(editor,editorOut);
			var strOut = editorOut.join("");
			this.description.value = strOut;
			var editorRawText = editor.textContent.replace(/\s+/g, '');
			
			if(editorRawText == "" || editorRawText.length < 100) {
				var pop = new Pophover(this.submitForm,"Attenzione",
										"La descrizione è obbligatoria e deve essere di almeno 100 caratteri",
										function() {fragments.that("1");});
				pop.show();
				return;
			}

			if(!myUp.lastUsed) {
				var pop = new Pophover(this.submitForm,"Attenzione","Non sono stati usati tutti gli uploader.Elimina l'uploader o utilizzalo.",
														function() {fragments.that("2")});
				pop.show();
				return;


			}
			this.submit();
		}
	}

}

