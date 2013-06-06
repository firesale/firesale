$(function() {
	
	// Index
	$('#filters select, #filters input').change(function() {
		update_orders();
	});

	$('#price_sub, #price_ship, #price_total').before('<span>' + currency + '&nbsp;</span>');
	$('#order_table').tablesorter({headers:{0:{sorter:false},8:{sorter:false}}, widgets:["saveSort"]});
	$('a.show-filter').click(function() { $('#filters').slideToggle(500); });
	$(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
	bind_pagination();

	$('#price-slider').slider({
		range: true,
		min: parseFloat($('.ui-slider-cont .left span').text()),
		max: parseFloat($('.ui-slider-cont .right span').text()),
		step: 0.5,
		values: [parseFloat($('.ui-slider-cont .left span').text()), parseFloat($('.ui-slider-cont .right span').text())],
		slide: function(event, ui) {
			$('.ui-slider-cont .left span').html(ui.values[0].toFixed(2));
			$('.ui-slider-cont .right span').html(ui.values[1].toFixed(2));
			$('input[name=price_total]').val(ui.values[0].toFixed(2)+'-'+ui.values[1].toFixed(2));
		},
		stop: function(event, ui) {
			$('#filters select:first, #filters input:first').change();
		}
	});

	if ( parseInt(window.location.hash.replace('#', '')) > 0 ) {
		update_orders(window.location.hash.replace('#', ''));
	}

	bind_keys($('#order_table'));

	// Change address
	$('#ship_to, #bill_to').change(function() {
		var pre = $(this).attr('id').replace('_to', '');
		$.getJSON('/admin/firesale/orders/ajax_address/' + $('select[name=created_by]').val() + '/' + $(this).val(), function(data) {
			if( data != 'false' ) {
				for( var k in data ) { $('#' + pre + '_' + k).val(data[k]); }
			} else { notif('error', 'Error retrieving address'); }
		});
	});

	// Link addresses
	var linked = false;
	$('#ship fieldset ul:last').append('<li class="wide"><label for="bill_details_same">My Billing and Shipping addresses are the same.</label><input type="checkbox" name="bill_details_same" id="bill_details_same" value="yes" /></li>');
	$('#bill_details_same').change(function() {
		if( $(this).attr('checked') == 'checked' ) { checked = true; } else { checked = false; }
		if( checked == true ) {
			$(this).parents('fieldset').find('li input').each(function() {
				if( typeof $(this).attr('name') != 'undefined' )
				{
					$('input[name=' + $(this).attr('name').replace('ship_', 'bill_') + ']').val($(this).val());
				}
			});
		}
	});

	// Add product
	$('.items button').click(function(e) {
		e.preventDefault();
		var _t = $(this), p = $('#add_product').val();
		_t.attr('disabled', '');
		$.getJSON(SITE_URL+'admin/firesale/products/ajax_product/' + p, function(d) {
			if( d != 'false' )
			{
				var id = _t.parents('form').attr('action').split('/').slice(-1)[0];
				$.getJSON(SITE_URL+'admin/firesale/orders/ajax_add_product/' + id + '/' + p + '/' + $('#add_qty').val(), function(r) {
					if( r != 'false' )
					{
						notif('success', 'Product added to order successfully - Make sure to save and update pricing');
						var tr = $('table.cart tbody tr.prod-' + d.id)
						if( tr.size() > 0 )
						{
							tr.find('input[type=text]').val(r.qty);
							tr.find('.price span').text(r.price);
							tr.find('.total span').text(r.total);
						}
						else
						{
							$('.no_data').remove();
							$('table.cart').removeAttr('style').find('tbody').append(
								'<tr>' +
									'<td class="remove"><input type="checkbox" name="item[' + d.id + '][remove]" value="1" /></td>' +
             						'<td class="image"><img src="/files/thumb/' + d.image + '/64/64" alt="Product Image" class="image" /></td>' +
              						'<td class="name"><a href="/product/' + d.slug + '">' + d.title + '</a></td>' +
              						'<td class="model">' + d.code + '</td>' +
              						'<td class="options"></td>' +
              						'<td><input type="text" name="item[' + d.id + '][qty]" value="' + r.qty + '" /></td>' + 
             						'<td class="price">' + currency + '<span>' + parseFloat(r.price).toFixed(2) + '</span></td>' +
              						'<td class="total">' + currency + '<span>' + parseFloat(r.total).toFixed(2) + '</span></td>' +
								'</tr>'
							);
						}
						calculatePrice();
					}
					else
					{
						notif('error', 'Error, there was a problem adding that item');
					}
				});
			}
			else
			{
				notif('error', 'Error, invalid product selected');
			}
			_t.removeAttr('disabled');
		});
	});

	// Mark for deletion or change qty?
	$('table.cart tbody input').change(function() {
		if( $(this).is('[type=text]') )
		{
			var p = parseFloat($(this).parents('tr').find('td.price span').text());
			$(this).parents('tr').find('td.total span').text(( parseInt($(this).val()) * p ).toFixed(2));
		}
		calculatePrice();
	});

});

function notif(level, msg)
{
	pyro.add_notification($('<div class="alert ' + level + '">'+msg+'</div>'));
}

function calculatePrice()
{
	var t = 0;
	$('table.cart tbody tr').each(function() {
		if( !$(this).find('td input[type=checkbox]').is(':checked') )
		{
			t += parseFloat($(this).find('td.total span').text());
		}
	});
	$('input[name=price_total]').val(( t + parseFloat($('input[name=price_ship]').val()) ).toFixed(2));
	$('input[name=price_sub]').val((t / ( 1 + ( 1 - (( 100 - tax_rate ) / 100 ).toFixed(2)))).toFixed(2));
}

var req;
function update_orders(extra) {
	if( req != null ) { req.abort(); }
	create_overlay($('#order_table'));
	req = $.ajax({type: "POST", url: $('#filters_form').attr('action')+'/'+extra, global: false, data: $('#filters_form').serialize(), success: function(data) {
		$('.overlay').remove();
		$('.no_data').remove();
		if( $(data).find('#order_table').size() > 0 ) {
			$('#order_table tbody').html($(data).find('#order_table tbody').html());
			$('#order_table tfoot').html($(data).find('#order_table tfoot').html());
			$('#order_table').show();
			$('#order_table').trigger("update");
			bind_pagination();
		} else if( $(data).find('.no_data').size() > 0 ) {
			$('#order_table').hide();
			$('<div class="no_data">'+$(data).find('.no_data').html()+'</div>').insertBefore($('#order_table'));
		} else {
			alert(data);
		}
	}});
}

function bind_pagination() {
	$('#order_table tfoot td div a').click(function(e) {
		e.preventDefault();
		var page = $(this).attr('href').split('/');
			page = page[page.length-1];
		if( $('#filters_form input[name=start]').size() > 0 ) { $('#filters_form input[name=start]').val(page); }
		else { $('#filters_form').append('<input type="hidden" name="start" value="'+page+'" />'); }
		window.location.hash = page;
		update_orders(page);
	});
}

function create_overlay(obj) {
	var w = obj.outerWidth(), h = obj.outerHeight(), o = obj.position();
	$('<div class="overlay" style="position: absolute; z-index: 1000; width: '+w+'px; height: '+h+'px; left: '+o.left+'; top: '+o.top+'px"><div>').insertAfter(obj);
}

function bind_keys(o) {
	$("body").keydown(function(e) {
	    
	    var c = 'selected', s = o.find('.selected');
	    
	    // Pagination - previous
	    if ( (e.keyCode || e.which) == 37 ) {   
	        $('.pagination .prev').click();

	    // Pagination - next
	    } else if ( (e.keyCode || e.which) == 39 ) {
	        $('.pagination .next').click();
	    
	    // Traverse - up
	    } else if ( (e.keyCode || e.which) == 40 ) {
	    	if ( s.next().size() > 0 ) { s.removeClass(c).next().addClass(c); }
	    	else { s.removeClass(c); o.find('tbody tr:first').addClass(c); }
	    
	   	// Traverse - down
	    } else if ( (e.keyCode || e.which) == 38 ) {
	    	if ( s.prev().size() > 0 ) { s.removeClass(c).prev().addClass(c); }
	    	else { s.removeClass(c); o.find('tbody tr:last').addClass(c); }

	    // Edit
	    } else if ( (e.keyCode || e.which) == 13 ) {		    	
	    	if ( s.size() > 0 ) {
	    		if ( e.ctrlKey ) { s.find('.quickedit').click(); } else { window.location = s.find('.edit').attr('href'); }
	    	}

	    // Mark for delete
		} else if ( (e.keyCode || e.which) == 46 ) {
			if ( s.size() > 0 ) { s.find('td:first input').click();
			$(".table_action_buttons .btn").prop('disabled', ( s.find('td:first input').is(':checked') ? false : true )); }
		}
	});
}
