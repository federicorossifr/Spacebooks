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





function handler(onDataAction,moreDataAction) {
	this.lastGet = 0;
	this.onData = onDataAction.bind(this);
	this.moreDataAction = moreDataAction;
}


handler.prototype.moreData = function(event,firstCall) {
	var curr = this;
	this.moreDataAction(curr.lastGet,5,function(data) {
		data = JSON.parse(data);
		var responseData = data.data;
		var dataLenght = data.size;
		var error = data.error;
		if(!error && dataLenght > 0) {
			curr.lastGet = responseData[data.size -1].id;
		}
		curr.onData(responseData,firstCall);
	});
}


function command(event) {
	event.preventDefault();
	var command = event.target.id;
	document.execCommand(command);
}

function countLeft(input,goal,output) {
		output.textContent = input.textContent.length;
		input.oninput = function() {
			var counter = output;
			var value = this.textContent;
			console.log(value);
			var valueLength = value.length;
			console.log(valueLength);
			var valueGoal = goal
			console.log(valueGoal);
			if(valueGoal - valueLength >= 0) {
				counter.className = "error";
			} else {
				counter.className = "success";
			}
			counter.textContent = valueLength;
		}
	}