jQuery(document).ready(function($) {
	$('td.column-is_in_stock').each(function(){
		var search = $(this).html().search('×');
		if(search !== -1 && search != '-1'){
			console.log('passou?')
			var elem = $(this).parent('tr').children('td.column-name').children('.row-actions').children('span.id');
			var _id = elem.html().replace('ID:','').replace('|','').replace(/\s+/g, '').toString();
			var _value = $(this).html().replace(/[^0-9]/gi, '');
			var _html = '<div style="display:none;" id="edit_stock_id_'+_id+'" class="edit_stock_modal"><h1>Edit Stock</h1><label><h4>Value: </h4></label><input value="'+_value+'" type="text"><button class="modal_stock_click" data-id="'+_id+'">Save</button><div class="loader">Loading..</div></div>';
			console.log(_id)
			$('body').append(_html);
			$(this).append('<a href="#TB_inline?width=300&height=250&inlineId=edit_stock_id_'+_id+'" class="thickbox edit_stock">Edit</a>');
		}
		else{
			console.log('passou nada :(');
		}

	});
	$('body').on('click', '.modal_stock_click',function(e){
		var elem = $(this).parent('#TB_ajaxContent');
		var _value = elem.children('input').val();
		var _id = $(this).attr('data-id');
		//console.log(ajaxurl);
		elem.children('.loader').css('display','block');
		var data = {
			'action': 'woo_stock',
			'id': _id,
			'value': _value
		};

		$.post(ajaxurl, data, function(response) {
			elem.children('.loader').css('display','none');
			setTimeout(function(){
				location.reload();
			}, 2000)
		});
	});
});
