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
	tmpImg.alt = documentData.title + "Cover";
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

function getTaggedDocuments(start,step,callback) {
	var loadedTags = loadTags();
	if(loadedTags)
		loadedTags = loadedTags.split(";");
	var tags = JSON.stringify(loadedTags);
	var params = [{'id':'start','value':start},
					{'id':'by','value':step},
					{'id':'tag','value':tags},
					{'id':'action','value':'1'}
				];
	DataLoad("./php/async/documentsIncrementalLoading.php",params,callback);
}

function getPurchasedDocuments(start,step,callback) {
	var params = [{'id':'start','value':start},
					{'id':'by','value':step},
					{'id':'action','value':'2'}];
	DataLoad("./php/async/documentsIncrementalLoading.php",params,callback);
}

function DocumentsDisplay(data,boot,container) {
	var containerObj = document.getElementById(container);
	if(data && data.length) {
		this.lastGet = data[data.length -1].id;
    	containerObj.parentElement.querySelector("[data-role=\"empty\"]").style.display= "none";

		for(var i = 0; i < data.length; ++i) {
			containerObj.appendChild(makeDocumentEntry(data[i]));
		}
	} 
	if(!data || data.noMore)	{
		if(!boot)
			//new Modal("Attenzione","Nessun documento da caricare");
		if(boot) {
			containerObj.parentElement.querySelector("[data-role='empty']").style.display="block"
		}
		containerObj.parentElement.querySelector("[data-role='loadMore']").style.display="none";
	}


}

function homeInit() {
	var homeFragment = new Fragment("homeFragmentContainer");
	homeFragment.makeSelectors("a");
	homeFragment.loadState();
	var suggested = document.getElementById("suggestedDocuments");
	
	var dataHandler = new handler(function(data,boot) {DocumentsDisplay(data,boot,"suggestedDocuments");},getTaggedDocuments);
	var dataPurchaseHandler = new handler(function(data,boot) {DocumentsDisplay(data,boot,"purchaseList");},getPurchasedDocuments);
	document.getElementById("loadMore").addEventListener("click",dataHandler.moreData.bind(dataHandler));
	document.getElementById("loadMorePurch").addEventListener("click",dataPurchaseHandler.moreData.bind(dataPurchaseHandler));
	dataPurchaseHandler.moreData(null,1);
	dataHandler.moreData(null,1);
}
