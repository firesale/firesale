$(function() {
	
	// Index
	$('#filters select, #filters input').change(function() {
		$.post($('#filters_form').attr('action'), $('#filters_form').serialize(), function(data) {
			if( $(data).find('#order_table').size() > 0 ) {
				$('#order_table tbody').html($(data).find('#order_table tbody').html());
				$('#order_table tfoot').html($(data).find('#order_table tfoot').html());
			} else if( $(data).find('.no_data').size() > 0 ) {
				$('#order_table tbody').html('<tr><td colspan="10"><div class="no_data">'+$(data).find('.no_data').html()+'</div></td></tr>');
				$('#order_table tfoot').html('');
			} else {
				alert(data);
			}
		});
	});

	$('#price_sub, #price_ship, #price_total').before('<span>' + currency + '&nbsp;</span>');
	$('#order_table').tablesorter({headers:{0:{sorter:false},8:{sorter:false}}, widgets:["saveSort"]});
	$('a.show-filter').click(function() { $('#filters').slideToggle(500); });
	$(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});

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
		$.getJSON('/admin/firesale/products/ajax_product/' + p, function(d) {
			if( d != 'false' )
			{
				var id = _t.parents('form').attr('action').split('/').slice(-1)[0];
				$.getJSON('/admin/firesale/orders/ajax_add_product/' + id + '/' + p + '/' + $('#add_qty').val(), function(r) {
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
              						'<td><input type="text" name="item[' + d.id + '][qty]" value="' + r.qty + '" /></td>' + 
             						'<td class="price">' + currency + '<span>' + r.price + '</span></td>' +
              						'<td class="total">' + currency + '<span>' + r.total + '</td>' +
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