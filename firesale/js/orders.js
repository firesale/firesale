$(function() {
	
	// Index
	$('select[name=created_by]').change(function() { window.location = '/admin/firesale/orders/created_by/' + $(this).val(); });

	// Create
	$('#tabs').tabs();
	if( !window.location.hash ) {
		$('#tabs').tabs("select", '#general');
	}

	$('#price_sub, #price_ship, #price_total').before('<span>' + currency + '&nbsp;</span>');

});
