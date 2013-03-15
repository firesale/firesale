$(function(){

	var tabi = $('.tab-menu li').length;
	var tabs = $('#tabs').tabs({add: function(event,ui) { $(ui.panel).insertAfter('#general'); $('#'+ui.panel.id).addClass('form_inputs'); }});
	if( !window.location.hash ) {
		tabs.tabs("select", '#general');
	}

	$('input[name=slug]').bind('keyup update change focus blur paste delete', function() {
		var s = $(this).val().split('/'); $(this).val(s[s.length-1]);
	}).change();
	
	$item_list	= $('ul.sortable');
	$url		= 'admin/firesale/categories/order';
	$cookie		= 'open_cats';
	
	$details 	= $('div#category-sort');
	$details.append('<input type="hidden" name="cat-id" id="cat-id" value="" />');
	$details_id	= $('div#category-sort #cat-id');

	if ( $('input[name=id]').val() > 0 ) {
		$('div.buttons').html('').append('<button type="submit" class="btn blue" value="save" name="btnAction"><span>Edit Category</span></button>')
			.append(( $('input[name=id]').val() > 2 ? ' <button name="btnAction" value="delete" class="btn red confirm"><span>Delete</span></button>' : '' ));
	}

	$item_list.find('li a').live('click', function(e) {

		$a          = $(this);
		cat_id		= $a.attr('rel');
		cat_title 	= $a.text();
		$('#category-sort a').removeClass('selected');
		$a.addClass('selected');
		$details_id.val(cat_id);

		tabs.tabs('remove', tabi, 0);
		
		$.getJSON(SITE_URL+'admin/firesale/categories/ajax_cat_details/' + $details_id.val(), function(data) {

			for( var k in data ) {
				if( k == 'meta_keywords' && $('#tabs input[name='+k+']').length > 0 && data[k] != null ) {
					$('#tabs input[name='+k+']').importTags(data[k]);
				} else if( $('#tabs select[name='+k+']').length > 0 ) {
					if( data[k] != null ) {
						if( typeof data[k].id != 'undefined' ) { data[k].key = data[k].id; }
					 	var obj = $('#tabs select[name='+k+']'); obj.val(data[k].key); obj.trigger('liszt:updated');
					}
				} else if( $('#tabs input[name='+k+']').length > 0 ) {
					var obj = $('#tabs input[name='+k+']');
					if( obj.attr('type') == 'checkbox' ) {
						if( data[k] ) { obj.attr('checked', 'checked'); } else { obj.removeAttr('checked'); }
					} else { obj.val(data[k]).change(); }
				} else if( $('#tabs textarea[name='+k+']').length > 0 ) {
					$('#tabs textarea[name='+k+']').val(data[k]);
				}
			}

			$('button.delete').remove();
			$('.one_half.last .title h4').text('Edit "' + data.title + '"');
			$('div.buttons').html('').append('<button type="submit" class="btn blue" value="save" name="btnAction"><span>Edit Category</span></button>')
			.append(( data.id > 2 ? ' <button name="btnAction" value="delete" class="btn red confirm"><span>Delete</span></button>' : '' ));

			tabs.tabs('add', '#images', 'Images');
			$("#images").load(SITE_URL+'admin/firesale/categories/ajax_cat_images/' + $details_id.val(), function() {
				bind_upload('admin/firesale/categories/upload/'+data.id);
				$('#dropbox').sortable({
					cursor: 'move',
					cancel: 'span.message',
					stop: function(event, ui) {
						var o = '';
						$('#dropbox .preview').each(function(){ o += ',' + $(this).attr('id').replace('image-', ''); });
						$.post(SITE_URL+'admin/firesale/products/ajax_order_images', { order: o.substr(1), csrf_hash_name: $.cookie(pyro.csrf_cookie_name) }, function(data) {
							if( data != 'ok' ) { alert(data); }
						});
					}
				});
			});

		});
		
		return false;
	});
	
	pyro.sort_tree($item_list, $url, $cookie, function(even, ui) {
		root_cats = [];
		$('ul.sortable').children('li').each(function(){root_cats.push($(this).attr('id').replace('cat_', '')); });
		return { 'root_cats' : root_cats };
	}, function() {		
		$details 	= $('div#category-sort');
		$details_id	= $('div#category-sort #cat-id');
	});

	$(window).bind('hashchange', function() {
		if ( parseInt(window.location.hash.replace('#', '')) > 0 ) {
			$item_list.find('li a[href=#'+window.location.hash.replace('#', '')+']').click();
		}
	}).trigger('hashchange');
	
	pyro.generate_slug($('input[name=title]'), $('input[name=slug]'), '-');
	
});
