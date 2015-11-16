function Tag(tagInput) {
	this.tagInput = document.getElementById(tagInput);
	this.tags = Array();
	with(this) {
		tagInput.oninput = function(event) {
			tags = event.target.value.split(";");
			console.log(tags[tags.length-1]);
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