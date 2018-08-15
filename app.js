$(document).ready(function(){

	// LIST JS OPTIONS
	var options = {
		valueNames: [ 'name', 'modified' ]
	};

	var localhostList = new List('localhost-list', options);

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

	// MODIFY CMSs
	var tr = 'table#table_add_cms tbody tr';

	function reNumberRows(){
		$(tr).each(function(i){
			$(this).find('th').text(i+1);
		});
	}
	function convertInputs(){
		if ($(tr).find('td input').length){
			$(tr).find('td input').each(function(){
				val = $(this).val();
				$(this).parent().html(val);
			});
		}
	}

	// ADD CMSs
	$("#addNewCMS").click(function(){
		convertInputs();
		$('table#table_add_cms tbody').append('<tr><th scope="row"></th><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td></tr>');
		reNumberRows();
	});

	// REMOVE CMSs
	$('tbody tr th').click(function(){
		convertInputs();
		$(this).parent().remove();
		reNumberRows();
	});

	// Change color theme
	function changeTheme(color){
		$('html').attr('data-color', color);
		$('html').removeClass();
		$('html').addClass(color);
	}

	$('.color-scheme').click(function(){
		if ($(this).attr('id') === 'color-selector'){
			$('#color-selector-input').toggleClass('active');
		} else {
			changeTheme($(this).attr('id'));
		}
	});

	$('#color-selector-input').keyup(function(){
		if (this.value.match(/[^a-zA-Z0-9 ]/g)){
			this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
		}
	});

	// GENERATE NEW SAVE_OPTIONS.PHP
	$('#save').click(function(e){
		e.preventDefault();
		convertInputs();

		var classValues = [],
		nameValues = [],
		filePathValues = [],
		highlight_color;

		if (!$('#color-selector-input').val().empty){
			highlight_color = $('#color-selector-input').val();
		}

		$(tr).each(function(){
			$this = $(this);
			// Remove tr with three empty inputs
			$this.find('td').each(function(i, el){
				if (el.empty){}
			});
			// Convert table rows into inputs, cells into values/classes/data-attributes
			classValues.push($this.find('td:eq(1)').text());
			nameValues.push($this.find('td:eq(0)').text());
			filePathValues.push($this.find('td:eq(2)').text());
		});

		$('#save-cms-form').prepend(
			'<input type="hidden" name="highlight_color" value="' + highlight_color + '" /><input type="hidden" name="color_scheme" value="' + $('html').attr('data-color') + '" /><input type="hidden" name="class_values" value="' + classValues + '" /><input type="hidden" name="name_values" value="' + nameValues + '" /><input type="hidden" name="file_path_values" value="' + filePathValues + '" />'
		);

		var dlAnchorElem = document.getElementById('save-cms-form-submit');
		dlAnchorElem.click();
	});

});
