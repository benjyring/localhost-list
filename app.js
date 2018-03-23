// LIST JS OPTIONS
var options = {
valueNames: [ 'name', 'modified' ]
};

var hackerList = new List('localhost-list', options);

// SORT BY CMS
var lgi = $('.list-group-item');
$(".sort-by input:checkbox").on('change', function() {
	if ($(".sort-by input:checkbox:checked").length){
		lgi.hide();
	} else {
		lgi.show();
	}
	$(".sort-by input:checkbox:checked").each(function() {
		$("." + $(this).val()).parents(lgi).show();
	});
});

// ADD NEW CMSs
var $tr = $('table#table_add_cms tbody tr');

function makeNewInputRow(){
	var previousRowNumber = $tr.length + 1;
	$('table#table_add_cms tbody').append('<tr><th scope="row">' + previousRowNumber + '</th><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td></tr>');
}
function convertInputs(){
	$tr.find('td input').each(function(){
		val = $(this).val();
		$(this).parent().html(val);
	});
}
$("#addNewCMS").click(function(){
	if( $tr.find('td input').length ){
		convertInputs();
	}
	makeNewInputRow();
});

// REMOVE CMSs
$('#table_add_cms tbody tr').each(function(){
	$(this).append('<div class="removeRow">-</div>');
});
$('.removeRow').click(function(){
	console.log('Attempting to remove');
	$(this).parent().remove();
});

// GENERATE NEW CMS_ARRAY.JSON
$('#save').click(function(){
	convertInputs();
	var rows = [];
	$tr.each(function(i, n){
		var $row = $(n);
		rows.push({
			class: $row.find('td:eq(1)').text(),
			name: $row.find('td:eq(0)').text(),
			file_path: $row.find('td:eq(2)').text(),
		});
	});

	var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(rows));
	var dlAnchorElem = document.getElementById('save');
	dlAnchorElem.setAttribute("href", dataStr);
	dlAnchorElem.setAttribute("download", "cms_array.json");
	dlAnchorElem.click();
});