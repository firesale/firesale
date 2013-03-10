$(function() {

	$('#mod_form').live('submit', function(e) {
		e.preventDefault();
		var action = $(this).find('button:focus').val();
		$.post($(this).attr('action'), $(this).serialize()+'&btnAction='+action, function(response) {
			$('#modifiers').html($(response).find('#modifiers').html());
			build_alert(response);
			$('a.modifier.modal').colorbox.close("Modifier added successfully");
		});
	});

	$('#var_form').live('submit', function(e) {
		e.preventDefault();
		var action = $(this).find('button:focus').val();
		$.post($(this).attr('action'), $(this).serialize()+'&btnAction='+action, function(response) {
			$('#modifiers').html($(response).find('#modifiers').html());
			build_alert(response);
			$('a.variation.modal').colorbox.close("Modifier added successfully");
		});
	});

});

function build_alert(response) {
	if ( $(response).find('.alert').size() > 0 ) {
		$(response).find('.alert').each(function() {
			var c = $(this).attr('class');
			$('#content-body').prepend('<div class="'+c+'">'+$(this).html()+'</div>');
		});
	}
}