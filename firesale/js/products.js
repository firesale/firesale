$(function(){

	// Dashboard
	$('.filter').change(function() { if( $(this).val() > 0 ) { window.location = '/admin/firesale/products/' + $(this).attr('id').replace('filter-', '') + '/' + $(this).val(); } });
	
	$('.quickedit').click(function() {
	
		var obj   = $(this).parent().parent();
		var id    = obj.find('.item-id');
		var title = obj.find('.item-title');
		var cat   = obj.find('.item-category');
		var stock = obj.find('.item-stock');
		var price = obj.find('.item-price');
		
		id.html('<input type="hidden" name="old_id" value="' + id.text() + '" /><input type="text" id="id" name="id" value="' + id.text() + '" />');
		title.html('<input type="text" id="title" name="title" value="' + title.text() + '" />');
		stock.html('<input type="text" id="stock" name="stock" value="' + stock.text() + '" />');
		price.parent().html('<input type="text" id="price" name="price" value="' + price.text() + '" pattern="^\d+(?:,\d{3})*\.\d{2}$" />');
		var category = $('#filter-category').clone().removeClass('chzn').removeClass('chzn-done').removeAttr('style').removeAttr('id').attr({name: 'parent[]'});
		category.find(':selected').removeAttr('selected');
		var s = cat.find('span').clone();
		cat.find('span').remove();
		s.each(function() {
			var val = $(this).attr('data-id');
			category.val(val).find('option[value="' + val + '"]').attr('selected', 'selected');
			cat.append(category);
		});

		$(this).addClass('add').text('Update');
		$(this).unbind('click').click(function() {
		
			var data = {};
			obj.find('input, select').each(function() {
				if( typeof $(this).attr('name') != 'undefined' ) {
					var name = $(this).attr('name');
					if( $(this).is('select') ) { var val = $(this).find(':selected').attr('value'); } else { var val = $(this).val(); }
		            if( name.substr(-2) == '[]' ) { name = name.replace('[]', ''); if( typeof data[name] == 'undefined' ) { data[name] = []; } data[name].push(val); } else { data[name] = val; }
	           	}
			});
	
			$.post(SITE_URL + 'admin/firesale/products/ajax_quick_edit', data, function(ret) {
				if( ret == 'ok' ) { window.location.reload(); }
				else { alert(ret); }
			});
			
			return false;
		});

		return false;
	});

	// Create
	$('#tabs').tabs();
	if( !window.location.hash ) {
		$('#tabs').tabs("select", '#generaloptions');
	}
	
	$('section #description').parent().find('.input').removeClass('input').parent().find('label[for=description]').remove();

	// Tax link
	tax_link($('#rrp'), $('#rrp_tax'));
	tax_link($('#price'), $('#price_tax'));
	$('#rrp, #rrp_tax, #price, #price_tax');

	// Image reordering
	$('#dropbox').sortable({
		cursor: 'move',
		cancel: 'span.message',
		stop: function(event, ui) {
			var o = '';
			$('#dropbox .preview').each(function(){ o += ',' + $(this).attr('id').replace('image-', ''); });
			$.post('/admin/firesale/products/ajax_order_images', { order: o.substr(1), csrf_hash_name: $.cookie(pyro.csrf_cookie_name) }, function(data) {
				if( data != 'ok' ) { alert(data); }
			});
		}
	});

	// Stock status switch
	$('#stock').bind('keyup update blur paste delete', function() {
		var val = $(this).val(), status = 1;
		if( val == 0 ) { status = 3; } else if( val <= 5 ) { status = 2; }
		$('#stock_status').val(status).trigger('liszt:updated');
	});

	// Categories "fix"
	$('#category_list_2 li').each(function() { if( $('#category').val().indexOf($(this).attr('id')) == -1 ) { $(this).remove(); }});
	
});
	
	function tax_link(price, before)
	{
		var tmp = before.clone();before.parent().parent().remove();
		tmp.prependTo(price.parent()).after('&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="link linked">Link</button>&nbsp;&nbsp;&nbsp;<span>' + currency + '&nbsp;</span>').before('<span>' + currency + '&nbsp;</span>');
		price.parent().find('button').click(function() { if( $(this).hasClass('linked') ) { $(this).removeClass('linked').addClass('unlinked'); } else { $(this).removeClass('unlinked').addClass('linked'); } });
		price.change(function() {
			var linked = ( $(this).parent().find('button').hasClass('linked') ? true : false );
			if( linked ) { $(this).parent().find('input:first').val(decimal( $(this).val() * ( 1 - ( tax_rate / 100 ) ) )); }
		}).blur(function() { $(this).val(( $(this).val().length > 0 ? decimal($(this).val()) : '0.00' )); });
		$('#' + tmp.attr('id')).change(function() {
			var linked = ( $(this).parent().find('button').hasClass('linked') ? true : false );
			if( linked ) { $(this).parent().find('input:last').val(decimal( $(this).val() * ( 1 + ( tax_rate / 100 ) ) )); }
		}).blur(function() { $(this).val(( $(this).val().length > 0 ? decimal($(this).val()) : '0.00' )); });
	}

	function decimal(no) { return new Number(parseFloat(no)).toFixed(2); }
	
	function slugify_field(val, space)
	{
		val = val.replace(/ /g, space).toLowerCase();
		return val;
	}
