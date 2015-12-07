function makeDocumentEntry(documentData) {
	var tmpLi = document.createElement("li");
	var tmpA = document.createElement("a");
	var tmpImg = document.createElement("img");
	var tmpDiv = document.createElement("div");
	var tmpP = document.createElement("p");

	tmpLi.className ="shadow";
	tmpA.href = "./document.php?id=" + documentData.id;
	tmpImg.src = documentData.path;
	tmpDiv.className = "title shadow";
	tmpP.textContent = documentData.title;

	tmpDiv.appendChild(tmpP);
	tmpA.appendChild(tmpImg);
	tmpA.appendChild(tmpDiv);
	tmpLi.appendChild(tmpA);
	return tmpLi;
}


function handler(data,dataQuery) {
	this.lastGet = 0;
	this.dataQuery = dataQuery;
}

handler.prototype.onData = function(data) {
	data = JSON.parse(data);
	if(data.length)
		this.lastGet = data[data.length -1].id;
	for(var i = 0; i < data.length; ++i) {
		document.getElementById("suggestedDocuments").appendChild(makeDocumentEntry(data[i]));
	}
}



handler.prototype.moreData = function(event,boot) {
	var curr = this;
	getTaggedDocuments(curr.dataQuery,curr.lastGet,5,function(data) {
		curr.onData(data);
		var dataSize = JSON.parse(data).length;
		if(dataSize < 1) {
			if(event)
				event.target.style.display = "none";
			if(!boot)
				new Modal("Attenzione","Nient'altro da caricare");
			else {
				document.getElementById("loadMore").style.display = "none";
			}
		}
	});
}

function getTaggedDocuments(tags,start,step,callback) {
	var params = [{'id':'start','value':start},{'id':'by','value':step},{'id':'tag','value':tags}];
	DataLoad("./php/async/documentsIncrementalLoading.php",params,callback);
}


function homeInit() {
	var loadedTags = loadTags().split(";");
	var jsonedTags = JSON.stringify(loadedTags);
	var suggested = document.getElementById("suggestedDocuments");
	var dataHandler = new handler("",jsonedTags);
	var homeFragment = new Fragment("homeFragmentContainer");
	homeFragment.makeSelectors("a");
	document.getElementById("loadMore").addEventListener("click",dataHandler.moreData.bind(dataHandler));
	dataHandler.moreData(null,1);
}