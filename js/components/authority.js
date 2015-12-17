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

function UserAction(obj) {
	var rowAffected = obj.parentElement.parentElement;
	var cells = rowAffected.cells;
	console.log(obj.value);
	if(obj.value == "0" || obj.value == "1") {
		var changeCell = cells[cells.length - 2];
		var changeOption = obj.querySelector("[value='" + obj.value +"']");
		changeCell.textContent = (obj.value == "0")? "moderator":"user";
		changeOption.value = (obj.value == "0")? "1":"0";
		changeOption.textContent = (obj.value == "1")? "Revoca promozione":"Promuovi a moderatore";
	} 
	actionPerformed(rowAffected,obj);
}

function DocumentAction(obj) {
	var rowAffected = obj.parentElement.parentElement;
	var cells = rowAffected.cells;
	if(obj.value == "0") cells[cells.length -2].textContent = "1";
	if(obj.value == "1") cells[cells.length -2].textContent = "0";
	actionPerformed(rowAffected,obj);
}

function actionPerformed(rowAffected,obj) {
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
		case "document": requestClient = new AsyncReq('./php/authority/documentModeration.php',function() {DocumentAction(obj);}); break;
		case "user" : requestClient = new AsyncReq('./php/authority/userModeration.php',function(data) {UserAction(obj);}); break;
	}

	var params = [{'id':'id','value':dbModelId},{'id':'action','value':dbModelAction}];
	var conf = confirm("Procedere?");
	if(conf)
		requestClient.POST(params,'application/x-www-form-urlencoded');
}


function main() {
	var authorityFragmentContainer = new Fragment("authorityFragmentContainer");
	authorityFragmentContainer.makeSelectors("a");
	authorityFragmentContainer.loadState();
	initData("userTable","userFilter","userSelector");
	initData("documentTable","documentFilter","documentSelector");
}
