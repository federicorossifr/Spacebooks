function makeStars(num,max,container) {
	for(var i = 0; i < max; ++i) {
		var tmpImg = document.createElement("img");
		tmpImg.alt = "star" + i;
		tmpImg.className = "star";
		if ( i < num) {
			tmpImg.src = STAR_ON;
		} else {
			tmpImg.src = STAR_OFF;
		}
		container.appendChild(tmpImg);
	}
}

function makeDocumentEntry(documentData) {
	var tmpLi = document.createElement("li");
	var tmpA = document.createElement("a");
	var tmpImg = document.createElement("img");
	var tmpDiv = document.createElement("div");
	var tmpStarDiv = document.createElement("div");
	var tmpP = document.createElement("p");

	tmpLi.className ="shadow";
	tmpA.href = "./document.php?id=" + documentData.id;
	tmpImg.src = documentData.path;
	tmpDiv.className = "title shadow";
	tmpStarDiv.className = "stars shadow";
	tmpP.textContent = documentData.title;


	var starNumber = Math.floor(documentData.score / documentData.votings);
	makeStars(starNumber,5,tmpStarDiv);

	tmpDiv.appendChild(tmpP);
	tmpA.appendChild(tmpImg);
	tmpA.appendChild(tmpDiv);
	tmpA.appendChild(tmpStarDiv);
	tmpLi.appendChild(tmpA);
	return tmpLi;
}

function getTaggedDocuments(tags,start,step,callback) {
	var params = [{'id':'start','value':start},
					{'id':'by','value':step},
					{'id':'tag','value':tags},
					{'id':'action','value':'1'}
				];
	DataLoad("./php/async/documentsIncrementalLoading.php",params,callback);
}

function getPurchasedDocuments(dataQuery,start,step,callback) {
	var params = [{'id':'start','value':0},
					{'id':'by','value':1},
					{'id':'action','value':'2'}];
	DataLoad("./php/async/documentsIncrementalLoading.php",params,callback);
}

function suggestedDocumentsDisplay(data) {
	console.log(data);
	data = JSON.parse(data);
	if(data.length)
		this.lastGet = data[data.length -1].id;
	for(var i = 0; i < data.length; ++i) {
		document.getElementById("suggestedDocuments").appendChild(makeDocumentEntry(data[i]));
	}
}

function purchasedDocumentsDisplay(data) {
	console.log(data);
	data = JSON.parse(data);
	if(data.length)
		this.lastGet = data[data.length -1].id;
	for(var i = 0; i < data.length; ++i) {
		document.getElementById("purchaseList").appendChild(makeDocumentEntry(data[i]));
	}
}



function homeInit() {
	var loadedTags = loadTags();
	if(loadedTags)
		loadedTags = loadedTags.split(";");
	var jsonedTags = JSON.stringify(loadedTags);
	var homeFragment = new Fragment("homeFragmentContainer");
	homeFragment.makeSelectors("a");
	homeFragment.loadState();
	var suggested = document.getElementById("suggestedDocuments");

	
	var dataHandler = new handler("",jsonedTags,suggestedDocumentsDisplay,getTaggedDocuments);
	var dataPurchaseHandler = new handler("","",purchasedDocumentsDisplay,getPurchasedDocuments);
	document.getElementById("loadMore").addEventListener("click",dataHandler.moreData.bind(dataHandler));
	dataHandler.moreData(null,1,document.getElementById("loadMore"));
	dataPurchaseHandler.moreData(null,1,document.getElementById("loadMore"));
}



	var params = [{'id':'start','value':0},
					{'id':'by','value':1},
					{'id':'action','value':'2'}
				];
DataLoad("./php/async/documentsIncrementalLoading.php",params,function(data) {console.log(data)})