function DataLoad(url,params,callback) {
	var client = new AsyncReq(url,callback);
	client.GET(params);
}

function generateSelector(tableHead) {
	var headItems = tableHead.cells;
	var select = document.createElement("select");
	var helpOpt = document.createElement("option");
	var helpOptLabel = document.createTextNode("Filtra il campo");
	helpOpt.appendChild(helpOptLabel);
	helpOpt.value ="-1";
	select.appendChild(helpOpt);
	for(var index = 0; index < headItems.length; ++index) {
		var opt = document.createElement("option");
		var optLabel = document.createTextNode(headItems[index].firstChild.nodeValue);
		opt.value = index;
		opt.appendChild(optLabel);
		select.appendChild(opt);
	}
	return select;
}

function matrixToTable(matrix,table) {
	var rows = table.rows;

	for(var index in matrix) {
		var matrixRow = matrix[index];
		var tmpRow = table.insertRow(rows.length);
		
		for(var prop in matrixRow ) {
			var tmpCell = tmpRow.insertCell(tmpRow.cells.length);
			tmpCell.textContent = matrixRow[prop];
		}
	}
}

function filterTable(table,field,text) {
	var rows = table.rows;
	var reg = new RegExp(text);
	var rowMatch = new Array();
	for(var rowIndex in rows) {
		var cells = rows[rowIndex].cells;

		if(!cells) continue;
		var tmpCell = cells[field];
		if(reg.test(tmpCell.textContent)) {
			rows[rowIndex].style.display = "table-row";
			rowMatch.push(rowIndex);
		}
			else rows[rowIndex].style.display = "none";
	}

	return rowMatch;
}


function makeResponsive(tableBody) {
	var tableHeadItems = tableBody.parentElement.rows[0].cells;
	var bodyRows = tableBody.rows;

	for(var i = 0; i < tableHeadItems.length; ++i) {

		var label = tableHeadItems[i].firstChild.nodeValue;

		for(var j = 0; j < bodyRows.length; ++j) {
			var row =  bodyRows[j];
			row.cells[i].setAttribute("data-heading",label);
		}
	}
}





function handler(data,dataQuery,onDataAction,moreDataAction) {
	this.lastGet = 0;
	this.dataQuery = dataQuery;
	this.onData = onDataAction.bind(this);
	this.moreDataAction = moreDataAction;
}


handler.prototype.moreData = function(event,boot,loaderCaller) {
	var curr = this;
	this.moreDataAction(curr.dataQuery,curr.lastGet,5,function(data) {
		curr.onData(data);
		var dataSize = JSON.parse(data).length;
		if(dataSize < 1) {
			if(event)
				event.target.style.display = "none";
			if(!boot)
				new Modal("Attenzione","Nient'altro da caricare");
			else {
				loaderCaller.style.display = "none";
			}
		}
	});
}