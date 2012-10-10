$(function(){

	/**************
	** DASHBOARD **
	**************/
	$('.filter').change(function() {

		var data = {filter: $(this).attr('id').replace('filter-', ''), value: $(this).val()};
		$.post('/admin/firesale/products' + ( data.value > 0 ? '/'+data.filter+'/'+data.value : '' ), function(p) {
	
			// Variables
			var products = $.parseJSON(p), tar = $('#product_table tbody'), row = '';

			// Clear table
			tar.html('<tr class="loading"><td colspan="8">&nbsp;</td></tr>');

			// Loop new products
			for( var k in products )
			{

				// Variables
				var p   = products[k];
				var str = '';

				// Categories
				for( var c in p.category ) { var cat = p.category[c]; str += ( str.length == 0 ? '' : ', ' ) + '<span data-id="'+cat.id+'">'+cat.title+'</span>'; }

				// Build row
				row    += '<tr class="cat_'+p.category.id+'">'+
						  '	<td><input type="checkbox" name="action_to[]" value="'+p.id+'"  /></td>'+
						  '	<td class="item-id">'+p.code+'</td>'+
						  ' <td class="item-img"><img src="'+(p.image!=false?'/files/thumb/'+p.image+'/32/32':'')+'" alt="Product Image" /></td>'+
						  ' <td class="item-title"><a href="product/'+p.slug+'">'+p.title+'</a></td>'+
						  ' <td class="item-category">'+
						  '  '+str+
						  ' </td>'+
						  ' <td class="item-stock">'+(p.stock_status.key==6?'Unlimited (&infin;)':p.stock_status.value)+'</td>'+
						  ' <td>'+currency+'<span class="item-price">'+p.price+'</span></td>'+
						  ' <td class="actions">'+
						  '  <a href="#" class="button quickedit">Quick Edit</a>'+
						  '  <a href="/admin/firesale/products/edit/'+p.id+'" class="button edit">Edit</a>'+
						  '  <a href="/admin/firesale/products/delete/'+p.id+'" class="button confirm">Delete</a>'+
						  ' </td>'+
						  '</tr>';

			}

			// Remove loading
			tar.html(row);

			// Rebind values
			$('#product_table').trigger("update"); 
			build_quickedit();

		});

	});
	
	$('#product_table').tablesorter({headers:{0:{sorter:false},7:{sorter:false}}, widgets:["saveSort"]});


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
	tax_link($('#cost'), $('#cost_tax'));
	tax_link($('#rrp'), $('#rrp_tax'));
	tax_link($('#price'), $('#price_tax'));
	$('#cost, #cost_tax, #rrp, #rrp_tax, #price, #price_tax');

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

	function build_quickedit()
	{
		$('.quickedit').click(function() {
	
			var obj   = $(this).parent().parent();
			var id    = obj.find('.item-id');
			var title = obj.find('.item-title');
			var cat   = obj.find('.item-category');
			var stock = obj.find('.item-stock');
			var price = obj.find('.item-price');
			
			id.html('<input type="hidden" name="old_id" value="' + id.text() + '" /><input type="text" id="id" name="id" value="' + id.text() + '" />');
			title.html('<input type="text" id="title" name="title" value="' + title.text() + '" />');
			stock.html('<input type="text" id="stock" name="stock" value="' + ( stock.text() == 'Unlimited (∞)' ? '0' : stock.text() ) + '" />');
			price.parent().html('<input type="text" id="price" name="price" value="' + price.text() + '" pattern="^\d+(?:,\d{3})*\.\d{2}$" />');
			
			var select = $('#filter-category').clone().removeClass('chzn').removeClass('chzn-done').removeAttr('style').removeAttr('id').attr({name: 'parent[]'});
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
