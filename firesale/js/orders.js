$(function() {
	
	// Index
	$('#filters select[name=created_by]').change(function() { window.location = '/admin/firesale/orders/created_by/' + $(this).val(); });

	// Create
	$('#tabs').tabs();
	if( !window.location.hash ) {
		$('#tabs').tabs("select", '#general');
	}

	$('#price_sub, #price_ship, #price_total').before('<span>' + currency + '&nbsp;</span>');

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
							$('table.cart tbody').append(
								'<tr>' +
									'<td class="remove"><input type="checkbox" name="item[' + d.id + '][remove]" value="1" /></td>' +
             						'<td class="image">n/a</td>' +
              						'<td class="name"><a href="/product/' + d.slug + '">' + d.title + '</a></td>' +
              						'<td class="model">' + d.code + '</td>' +
              						'<td><input type="text" name="item[' + d.id + '][qty]" value="' + r.qty + '" /></td>' + 
             						'<td class="price">' + currency + '<span>' + r.price + '</span></td>' +
              						'<td class="total">' + currency + '<span>' + r.total + '</td>' +
								'</tr>'
							);
						}
						var t = 0;
						$('table.cart tbody tr').each(function() { t += parseFloat($(this).find('td.total span').text()); });
						$('input[name=price_total]').val(( t + parseFloat($('input[name=price_ship]').val()) ).toFixed(2));
						$('input[name=price_sub]').val(( t * (( 100 - tax_rate ) / 100 )).toFixed(2));

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

});

function notif(level, msg)
{
	pyro.add_notification($('<div class="alert ' + level + '">'+msg+'</div>'));
}