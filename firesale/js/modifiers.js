$(function() {

	$('#mod_form').live('submit', function(e) {
		e.preventDefault();
		var action = $(this).find('button:focus').val();
		$.post($(this).attr('action'), $(this).serialize()+'&btnAction='+action, function(response) {
			build_alert(response);
			if( $(response).find('#modifiers').size() > 0 ) {
				$('#modifiers').html($(response).find('#modifiers').html());
				$('a.modifier.modal').colorbox.close("Modifier added successfully");
			} else {
				$('#mod_form').html(response);
			}
		});
	});

	$('#var_form').live('submit', function(e) {
		e.preventDefault();
		var action = $(this).find('button:focus').val();
		$.post($(this).attr('action'), $(this).serialize()+'&btnAction='+action, function(response) {
			build_alert(response);
			if( $(response).find('#modifiers').size() > 0 ) {
				$('#modifiers').html($(response).find('#modifiers').html());
				$('a.modifier.modal').colorbox.close("Variation added successfully");
			} else {
				$('#var_form').html(response);
			}
		});
	});

});

function build_alert(response) {
	if( $(response).find('.alert').size() > 0 ) {
		$(response).find('.alert').each(function() {
			var c = $(this).attr('class');
			$('#content-body').prepend('<div class="'+c+'">'+$(this).html()+'</div>');
		});
	}
}