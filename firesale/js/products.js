$(function() {

	/**************
	** DASHBOARD **
	**************/

	if( $('#product_table').size() > 0 ) {

		$('#price-slider').slider({
			range: true,
			min: parseFloat($('.ui-slider-cont .left span').text()),
			max: parseFloat($('.ui-slider-cont .right span').text()),
			step: 0.5,
			values: [parseFloat($('.ui-slider-cont .left span').text()), parseFloat($('.ui-slider-cont .right span').text())],
			slide: function(event, ui) {
				$('.ui-slider-cont .left span').html(ui.values[0].toFixed(2));
				$('.ui-slider-cont .right span').html(ui.values[1].toFixed(2));
				$('input[name=price]').val(ui.values[0].toFixed(2)+'-'+ui.values[1].toFixed(2));
			},
			stop: function(event, ui) {
				update_products();
			}
		});

		var prices = $('#price-slider').slider('values');
		if( typeof prices == 'array' ) {
			$('.ui-slider-cont .left span').html(prices[0].toFixed(2));
			$('.ui-slider-cont .right span').html(prices[1].toFixed(2));
		}

		$('#filters select, #filters input').change(function() {
			update_products();
		});

	    $('a.show-filter').click(function() { $('#filters').slideToggle(500); });
		$('#product_table').tablesorter({widgets:["saveSort"]});
		build_quickedit();
		bind_pagination();

	}

	/*************
	** CREATION **
	*************/
	$('#tabs').tabs();
	if( !window.location.hash ) {
		$('#tabs').tabs("select", '#generaloptions');
	}

	pyro.generate_slug($('input[name=title]'), $('input[name=slug]'), '-');
	
	$('section #description').find('.input').removeClass('input').parent().find('label[for=description]').remove();

	// Tax link
	tax_link($('#rrp'), $('#rrp_tax'));
	tax_link($('#price'), $('#price_tax'));

	// Add upload
	if( $('#dropbox').length > 0 ) { bind_upload('admin/firesale/products/upload/'+$('#id').val()); }

	// Image reordering
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

	// Stock status switch
	$('#stock').bind('keyup update blur paste delete', function() {
		var val = $(this).val();
		if( parseInt(val) == 0 && $('#stock_status').val() != '6' ) { $('#stock_status').val('3').trigger('liszt:updated'); }
	});
	$('#stock_status').change(function() {
		if( $(this).val() == '6' ) { $('#stock').val('0'); }
	});

	// Categories "fix"
	$('#category_list_2 li').each(function() { if( $('#category').val().indexOf($(this).attr('id')) == -1 ) { $(this).remove(); }});

	/**************
	** MODIFIERS **
	**************/

	$('.modifiers tbody').sortable({
		handle: 'span.mod-mover',
		update: function() {
			$('.modifiers tbody > tr').removeClass('even');
			$('.modifiers tbody > tr:nth-child(even)').addClass('even');
			var order = [];
			$('.modifiers tbody > tr').each(function() { order.push(this.id); });
			order = order.join(',');
			$.post(SITE_URL + 'admin/firesale/products/ajax_order_modifiers', { order: order });
		}
	});

	$('.modifiers tbody table tbody').sortable({
		handle: 'span.var-mover',
		update: function() {
			$('.modifiers table tbody > tr').removeClass('even');
			$('.modifiers table tbody > tr:nth-child(even)').addClass('even');
			var order = [];
			$('.modifiers table tbody > tr').each(function() { order.push(this.id); });
			order = order.join(',');
			$.post(SITE_URL + 'admin/firesale/products/ajax_order_variations', { order: order });
		}
	});

	$('.modifiers th .mod-min').click(function(e) {
		e.preventDefault();
		$('.modifiers td .mod-min').click();
	});
	$('.modifiers td .mod-min').click(function(e) {
		e.preventDefault();
		$(this).parents('tr').find('table').slideToggle(250);
		$(this).toggleClass('show');
	});

	/*********************
	** DYNAMIC TAX LINK **
	*********************/

	$('#tax_band').change(function()
	{
		var selected_tax = $(this).find('option:selected').val();

		if (taxes[selected_tax] !== undefined)
		{
			tax_rate = taxes[selected_tax];

			$('#rrp, #price').change();
		}
	})
	
});
	
	var req = null;

	function tax_link(price, before)
	{
		var tmp = before.clone();before.parent().parent().remove();
		tmp.prependTo(price.parent()).after('&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="link linked">Link</button>&nbsp;&nbsp;&nbsp;<span>' + currency + '&nbsp;</span>').before('<span>' + currency + '&nbsp;</span>');
		price.parent().find('button').click(function() { if( $(this).hasClass('linked') ) { $(this).removeClass('linked').addClass('unlinked'); } else { $(this).removeClass('unlinked').addClass('linked'); } });
		price.change(function() {
			if( $(this).val() > 0 ) { var linked = ( $(this).parent().find('button').hasClass('linked') ? true : false ); if( linked ) { $(this).parent().find('input:first').val(decimal( $(this).val() / ( 1 + ( tax_rate / 100 ) ), 3 )); } }
			else { $(this).val('0.00'); }
		}).blur(function() { $(this).val(decimal($(this).val(), 2)); }).change().blur();
		$('#' + tmp.attr('id')).change(function() {
			if( $(this).val() > 0 ) { var linked = ( $(this).parent().find('button').hasClass('linked') ? true : false ); if( linked ) { $(this).parent().find('input:last').val(decimal( $(this).val() * ( 1 + ( tax_rate / 100 ) ), 2 )); } }
			else { $(this).val('0.00'); }
		}).blur(function() { $(this).val(decimal($(this).val(), 3)); });
	}

	function decimal(no, places) { return new Number(parseFloat(no)).toFixed(places); }

	function build_quickedit() {
		$('.quickedit').click(function() {

			$('<li><a href="#" class="reload">Cancel</a></li>').insertAfter($(this).parent());
			$('.reload').unbind('click').click(function(e) { e.preventDefault(); window.location = window.location; });
	
			var obj   = $(this).parents('tr');
			var id    = obj.find('.item-id');
			var title = obj.find('.item-title');
			var cat   = obj.find('.item-category');
			var stock = obj.find('.item-stock');
			var price = obj.find('.item-price');
			
			id.html('<input type="hidden" name="old_id" value="' + id.text() + '" /><input type="text" id="id" name="id" value="' + id.text() + '" />');
			title.html('<input type="text" id="title" name="title" value="' + title.text().replace(/"/g, '&quot;') + '" />');
			stock.html('<input type="text" id="stock" name="stock" value="' + ( stock.text() == 'Unlimited (∞)' ? '0' : stock.text() ) + '" />');
			price.html('<input type="text" id="price" name="price" value="' + price.text().replace(/[^0-9\.]/g, '') + '" />');
			
			var select = $('select[name=category]').clone().removeClass('chzn').removeClass('chzn-done').removeAttr('style').removeAttr('id').attr({name: 'parent[]'});
			select.find(':selected').removeAttr('selected');
			var c = [];	cat.find('span').each(function() { c.push($(this).attr('data-id')); });
			cat.html('');
			for( var k in c ) {
				var id = c[k], category = select.clone();
				category.val(id).find('option[value="' + id + '"]').attr('selected', 'selected');
				cat.append(category);
			}

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
	}

	function bind_pagination() {
		$('#product_table tfoot td div a').click(function(e) {
			e.preventDefault();
			var page = $(this).attr('href').split('/');
				page = page[page.length-1];
			if( $('#filters input[name=start]').size() > 0 ) { $('#filters input[name=start]').val(page); }
			else { $('#filters').append('<input type="hidden" name="start" value="'+page+'" />'); }
			update_products(page);
		});
	}

	function update_products(extra) {
		if( req != null ) { req.abort(); }
		req = $.ajax({type: "POST", url: SITE_URL+'firesale/admin_products/ajax_filter/'+extra, global: false, data: $('#filters').serialize(), success: function(data) {
			$('#product_table').parent().find('.no_data').remove();
			if( $(data).find('#product_table').size() > 0 ) {
				$('#product_table tbody').html($(data).find('#product_table tbody').html());
				$('#product_table tfoot').html($(data).find('#product_table tfoot').html());
				$('#product_table').show();
				$('#product_table').trigger("update"); 
				build_quickedit();
				bind_pagination();
			} else if( $(data).find('.no_data').size() > 0 ) {
				$('#product_table').hide();
				$('<div class="no_data">'+$(data).find('.no_data').html()+'</div>').insertBefore($('#product_table'));
			} else {
				alert(data);
			}
		}});
	}