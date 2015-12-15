function Tag(tagInput) {
	this.tagInput = document.getElementById(tagInput);
	this.tags = Array();
	with(this) {
		var noCollide = tagInput.oninput;
		tagInput.oninput = function(event) {
			noCollide(event);
			tags = event.target.value.split(", ");
		}
	}
}

Tag.prototype.emit = function() {
	var filtered = Array();
	for(var i = 0; i < this.tags.length; ++i) {
		if(this.tags[i] != "")
			filtered.push(this.tags[i]);
	}

	var jsonData = JSON.stringify(filtered);
	return jsonData;
}


function loadTags() {
	var stored = localStorage.getItem("tags");
	return stored;
}

function isSavedTag(tags,tag) {
	for(var i = 0; i < tags.length; ++i) {
		if(tags[i] == tag.id) return true;
	}
	return false;
}

function storeTags(tags) {
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

function clearTags() {
	localStorage.setItem("tags","");
}