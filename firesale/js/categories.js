$(function(){

	$("#tabs").tabs().tabs("select", '#generaloptions');
	
	$item_list	= $('ul.sortable');
	$url		= 'admin/firesale/categories/order';
	$cookie		= 'open_cats';
	
	$details 	= $('div#category-sort');
	$details.append('<input type="hidden" name="cat-id" id="cat-id" value="" />');
	$details_id	= $('div#category-sort #cat-id');
		
	$item_list.find('li a').live('click', function(e) {

		e.preventDefault();
		$a = $(this);
			
		cat_id		= $a.attr('rel');
		cat_title 	= $a.text();
		$('#category-sort a').removeClass('selected');
		$a.addClass('selected');
		$details_id.val(cat_id);
		
		$.getJSON(SITE_URL + 'admin/firesale/categories/ajax_cat_details/' + $details_id.val(), function(data) {
			
			data = data[0];

			$('button.delete').remove();
			$('.form_inputs').parent().parent().find('h4').text('Edit ' + data.title);
			$('.form_inputs input[name=id]').val(data.id);
			$('.form_inputs input[name=title]').val(data.title);
			$('.form_inputs input[name=slug]').val(data.slug);
			$('.form_inputs select[name=parent]').val(data.parent).trigger('liszt:updated');
			$('.form_inputs select[name=status]').val(data.status).trigger('liszt:updated');
			$('.form_inputs textarea[name=description]').val(data.description);
			$('button[type=submit]').text('Edit category').after(( data.id != 1 ? ' <button name="btnAction" value="delete" class="btn red delete"><span>Delete</span></button>' : '' ));

			$('button.delete').click(function() {
		
				var c = confirm('WARNING! You are about to delete ' + cat_title.toUpperCase() +"\n\n" +
								'This cannot be reversed and all sub-categories will be moved to ' + $('#cat_1 div a').html().toUpperCase());
		
				if( c == true ) {
					window.location = SITE_URL + 'admin/firesale/categories/delete/' + cat_id;
				}
	
				return false;
			});
			
		});
		
		return false;
	});
	
	data_callback = function(even, ui) {

		root_cats = [];
	
		$('ul.sortable').children('li').each(function(){
			root_cats.push($(this).attr('id').replace('cat_', ''));
		});
	
		return { 'root_cats' : root_cats };
	}
	
	post_sort_callback = function() {		
		$details 	= $('div#category-sort');
		$details_id	= $('div#category-sort #cat-id');
	}

	pyro.sort_tree($item_list, $url, $cookie, data_callback, post_sort_callback);
	
});
