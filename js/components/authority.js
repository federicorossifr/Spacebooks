function initData(table,filter,selector) {
	var table = document.getElementById(table);
	var filter = document.getElementById(filter);
	var selector = document.getElementById(selector);
	var selectors = generateSelector(table.parentElement.rows[0]);
	selector.parentElement.replaceChild(selectors,selector);

	makeResponsive(table);

	filter.oninput = function(event) {
		if(selectors.value != "-1")
		applyFilter(table,this,selectors);
	}

	selectors.onchange = function(event) {
		if(event.target.value != "-1")
		applyFilter(table,filter,this);	
	}
	
}


function applyFilter(targetTable,textInputField,selectorField) {
	var text =textInputField.value;
	var num = selectorField.value;
	filterTable(targetTable,num,text);
}

function actionPerformed(obj) {
	var rowAffected = obj.parentElement.parentElement;

	if(obj.value == "2")
		rowAffected.parentElement.removeChild(rowAffected);	
	Modal("Moderazione","Operazione completata");
}


function action(obj) {
	var dbModel = obj.getAttribute("data-model");
	var dbModelId = obj.getAttribute("data-id");
	var dbModelAction = obj.value;
	if(dbModelAction == "-1") return false;
	var requestClient = null;
	switch(dbModel) {
		case "document": requestClient = new AsyncReq('./php/authority/documentModeration.php',function() {actionPerformed(obj);}); break;
		case "user" : requestClient = new AsyncReq('./php/authority/userModeration.php',function() {actionPerformed(obj);}); break;
	}

	var params = [{'id':'id','value':dbModelId},{'id':'action','value':dbModelAction}];
	var conf = confirm("Procedere?");
	if(conf)
		requestClient.POST(params,'application/x-www-form-urlencoded');
}


function main() {
	console.log("Fired");
	var coso = new Fragment("coso");
	coso.makeSelectors("a");
	initData("userTable","userFilter","userSelector");
	initData("documentTable","documentFilter","documentSelector");
}
