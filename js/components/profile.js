function initProfile() {
	var frgMnts = new Fragment("mainFragment");
	frgMnts.makeSelectors("a");
	var documentsTable = document.getElementById("documentsTable");
	if(documentsTable)
		makeResponsive(documentsTable);
	document.getElementById("searchButton").className+= " active";
}

function bigDocumentPicture(event,obj) {
	event.stopPropagation();
	event.preventDefault();
	var img = new Image();
	img.src = obj.src;
	img.alt = obj.alt;
	img.width = "200";
	var link = obj.parentElement.href;
	PictureModal("Premi OK per andare al documento",img,function() {location.href=link});
}

function editFormCheck() {
	var editForm = document.getElementById("editForm");
	FormControl(editForm);
	
}


function handleFollowResult(data,obj) {
	data = parseInt(data);
	var newAttr = (data == 2) ? "0":"1"; 
	var newLabel = (data == 2) ? "Segui":"Smetti di seguire";
	obj.setAttribute("data-follow",newAttr);
	obj.firstChild.nodeValue = newLabel;
}

function ajaxFollow(obj) {
	var id = obj.getAttribute("data-mate");
	var unfollow = obj.getAttribute("data-follow");
	var params = [{'id':'mate','value':id},{'id':'unfollow','value':unfollow}];
	var client = new AsyncReq('./php/async/followship.php',function(data) {handleFollowResult(data,obj);});
	client.POST(params,"application/x-www-form-urlencoded");
}

editFormCheck();