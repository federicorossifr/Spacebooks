function parse(parent,vector) {  //Funzione di utilità per estrarre una stringa di codice HTML dall'albero DOM
								 // a partire da un elemento padre, con una visita radice->figli
	if(!parent) return; // Se ho raggiunto la fine del percorso ritorno

	if(parent.tagName) { // Se l'elemento non è un TextNode ne recupero il tagName e gli attributi
		var startTag = "<" + parent.tagName + " ";

		for(var i = 0; i < parent.attributes.length; ++i) {
			if(parent.attributes[i].nodeName == "contenteditable" || parent.attributes[i].nodeName == "id") continue;
			startTag+= parent.attributes[i].nodeName + "='" + parent.attributes[i].value + "' ";
		}

		startTag+=">"; // Finisco di formare lo startTag

		var endTag = String("</" + String(parent.tagName) +">"); // Formo l'end tag inserisco in coda all'array lo startTag
		vector.push(startTag);
	} else {
		var txt = parent.textContent; // se l'elemento è un textNode recupero il contenuto. (In queso caso il nodeValue è il TextContent)
		txt =  txt.replace(/&/g, "&amp;") // Escape di caratteri non consentiti come < > e di apostrofi
         .replace(/</g, "")
         .replace(/>/g, "")
         .replace(/"/g, "")
         .replace(/'/g, "&#039;");
		vector.push(txt);
	}

	var chdrn = parent.childNodes; // recupero i figli per proseguire con la visita generica
	for(var j = 0; j < chdrn.length; ++j) {
		parse(chdrn[j],vector); // richiamo ricorsivamente la funzione per effettuare la visita
	}


	if(parent.tagName) { // chiudo la composizione dell'elemento inserendo l'endTag
		vector.push(endTag);
	}
	
}

function emitter(editor) {  // Funzione di utilizzo di parser(). Emette un array associativo
							// con la stringa HTML ricavata in  "outData" e
							// il testo contenuto in tutto l'editor
	var editorOut = new Array(); // Creo un vettore di appoggio per il parser
	parse(editor,editorOut); // Effettuo la chiamata sull'editor passato come argomento
	var strOut = editorOut.join(""); // Concateno in una stringa il vettore ottenuto
	var editorRawText = editor.textContent.replace(/\s{2,}/g, ''); // Sostituisco 2+ spazi con uno singolo nel testo puro dell'editor
	var result = new Array(); // Formo un vettore di risposta
	result['rawData'] = editorRawText; // Testo puro dell'editor
	result['outData'] = strOut; // Codice Markup HTML del contenuto del testo
	return result;
}
