function parse(parent,vector) {
	if(!parent) return;

	if(parent.tagName) {
		var startTag = "<" + parent.tagName + " ";

		for(var i = 0; i < parent.attributes.length; ++i) {
			if(parent.attributes[i].nodeName == "contenteditable") continue;
			startTag+= parent.attributes[i].nodeName + "='" + parent.attributes[i].nodeValue + "' ";
		}

		startTag+=">";
		
		var endTag = String("</" + String(parent.tagName) +">");
		vector.push(startTag);
	} else {
		var txt = parent.textContent;
		txt =  txt.replace(/&/g, "&amp;")
         .replace(/</g, "")
         .replace(/>/g, "")
         .replace(/"/g, "")
         .replace(/'/g, "&#039;");
		vector.push(txt);
	}

	var chdrn = parent.childNodes;
	for(var i = 0; i < chdrn.length; ++i) {
		parse(chdrn[i],vector);
	}


	if(parent.tagName) {
		vector.push(endTag);
	}

}