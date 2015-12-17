function parse(parent,vector) {
	if(!parent) return;

	if(parent.tagName) {
		var startTag = "<" + parent.tagName + " ";

		for(var i = 0; i < parent.attributes.length; ++i) {
			if(parent.attributes[i].nodeName == "contenteditable" || parent.attributes[i].nodeName == "id") continue;
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

function emitter(editor) {
	var editorOut = new Array();
	parse(editor,editorOut);
	var strOut = editorOut.join("");
	var editorRawText = editor.textContent.replace(/\s{2,}/g, '');
	var result = new Array();
	result['rawData'] = editorRawText;
	result['outData'] = strOut;
	return result;
}