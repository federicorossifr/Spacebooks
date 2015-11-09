function DataLoad(url,params,callback) {
	var client = new AsyncReq(url,callback);
	client.GET(params);
}

function generateSelector(tableHead) {
	var headItems = tableHead.cells;
	var select = document.createElement("select");
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

