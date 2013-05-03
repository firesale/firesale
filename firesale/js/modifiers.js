$(function() {

	sorting();

	$("button[type=submit]").live('click', function() {
	    $("button", $(this).parents("form")).removeAttr("clicked");
	    $(this).attr("clicked", "true");
	});

	$('.modifiers th .mod-min').live('click', function(e) {
		e.preventDefault();
		$('.modifiers td .mod-min').click();
	});
		
	$('.modifiers td .mod-min').live('click', function(e) {
		e.preventDefault();
		$(this).parents('tr').find('table').slideToggle(250);
		$(this).toggleClass('show');
	});

	$('#mod_form').live('submit', function(e) {
		e.preventDefault();
		var action = $(this).find('button[clicked=true]').val();
		$.post($(this).attr('action'), $(this).serialize()+'&btnAction='+action, function(response) {
			build_alert(response);
			if( $(response).find('#modifiers').size() > 0 ) {
				$('#modifiers').html($(response).find('#modifiers').html());
				$('a.modifier.modal').colorbox.close("Modifier added successfully");
				sorting();
			} else {
				$('#mod_form').html(response);
			}
		});
	});

	$('#var_form').live('submit', function(e) {
		e.preventDefault();
		var action = $(this).find('button[clicked=true]').val();
		$.post($(this).attr('action'), $(this).serialize()+'&btnAction='+action, function(response) {
			build_alert(response);
			if( $(response).find('#modifiers').size() > 0 ) {
				$('#modifiers').html($(response).find('#modifiers').html());
				$('a.modifier.modal').colorbox.close("Variation added successfully");
				sorting();
			} else {
				$('#var_form').html(response);
			}
		});
	});

});

function sorting() {

	$('.modifiers tbody').sortable({
		handle: 'span.mod-mover',
		update: function() {
			$('.modifiers tbody > tr').removeClass('alt');
			$('.modifiers tbody > tr:nth-child(even)').addClass('alt');
			var order = [];
			$('.modifiers tbody > tr').each(function() { order.push(this.id); });
			order = order.join(',');
			$.post(SITE_URL + 'admin/firesale/products/ajax_order_modifiers', { order: order });
		}
	});

	$('.modifiers tbody table tbody').sortable({
		handle: 'span.var-mover',
		update: function() {
			$('.modifiers table tbody > tr').removeClass('alt');
			$('.modifiers table tbody > tr:nth-child(even)').addClass('alt');
			var order = [];
			$('.modifiers table tbody > tr').each(function() { order.push(this.id); });
			order = order.join(',');
			$.post(SITE_URL + 'admin/firesale/products/ajax_order_variations', { order: order });
		}
	});

}