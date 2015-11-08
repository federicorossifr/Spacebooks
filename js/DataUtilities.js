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
	for(var rowIndex in rows) {
		var cells = rows[rowIndex].cells;

		var tmpCell = cells[field];
		if(reg.test(tmpCell.textContent)) rows[rowIndex].style.display = "table-row";
			else rows[rowIndex].style.display = "none";
		}
}