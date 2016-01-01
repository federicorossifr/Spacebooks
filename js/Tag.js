function Tag(tagInput) {   // Raccolta di funzioni per la gestione client dei tag
						   // Gestore di input di tag separati dal ", "
	this.tagInput = document.getElementById(tagInput);
	this.tags = Array();
	with(this) {
		var noCollide = tagInput.oninput;
		tagInput.oninput = function(event) {
			noCollide(event); // Evita collisioni con altri event listener
			tags = event.target.value.split(", ");
		}
	}
}

Tag.prototype.emit = function() { // Emissione dell'array per l'invio al SERVER
	var filtered = Array();
	for(var i = 0; i < this.tags.length; ++i) {
		if(this.tags[i] != "")
			filtered.push(this.tags[i]);
	}

	var jsonData = JSON.stringify(filtered); // codifica JSON dell'array
	return jsonData;
}


function loadTags() {  // caricamento dei tag dalla local storage
	var stored = localStorage.getItem("tags");
	return stored;
}

function isSavedTag(tags,tag) {
	for(var i = 0; i < tags.length; ++i) {
		if(tags[i] == tag.id) return true;
	}
	return false;
}

function storeTags(tags) { // salvataggio dei tag nella local storage a partire da una stringa codificata come
						   // tag1;tag2;tag3;tag4;tag5;tag6
	var stored = loadTags();
	stored = (stored)? stored:"";

	tagsVector = stored.split(";");
	for(var i = 0; i < tags.length; ++i) {
		if(!isSavedTag(tagsVector,tags[i])) {
			stored+= tags[i].id;

			stored+=";";
		}
	}
	localStorage.setItem("tags",stored);
}

function clearTags() { // FUNZIONE DI TEST PER SVUOTARE I TAG DELLA LOCAL STORAGE
	localStorage.setItem("tags","");
}