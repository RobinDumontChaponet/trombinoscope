function arrayToTable(tableData, headers) {
	var table = document.createElement('table'),
	tableHead = document.createElement('thead'),
	tableBody = document.createElement('tbody');
	if (typeof headers !== 'undefined' && headers.length > 0) {
		var row = document.createElement('tr');
		headers.forEach(function(cellData) {
			var cell = document.createElement('th');
			cell.innerHTML=cellData;
			row.appendChild(cell);
		});
		tableHead.appendChild(row);
		table.appendChild(tableHead);
	}
	tableData.forEach(function(rowData) {
		var row = document.createElement('tr');
		rowData.forEach(function(cellData) {
			var cell = document.createElement('td');
			cell.appendChild(document.createTextNode(cellData));
			row.appendChild(cell);
		});
		tableBody.appendChild(row);
	});
	table.appendChild(tableBody);
	return table;
}

function csvArrayToTable(array) {
	var headers=Array();
	for(var i=0, l=array[0].length; i<l; i++) {
		headers.push('<select name="col'+i+'"><option value="" disabled selected style="display:none;">Type</option><option> </option><option>Nom</option><option>Prénom</option><option>Date de naissance</option></select>');
	}
	return arrayToTable(array, headers);
}