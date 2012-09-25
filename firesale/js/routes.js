$(function() {
	
	// Variables
	var section = $('input#slug').val();
	var html    = '';

	// Temp
	$('#translation').val($('#route').val());

	// Bind to route
	$('#route').bind('keyup keydown change delete paste update', function() {
		var val = $('#route').val();
		$('.route-action').each(function() {
			var regex = new RegExp($(this).data('route'),"g");
			val = val.replace(regex, $(this).data('translation'));
		});
		$('#translation').val(val);
	});

	// Section specific
	if( section == 'category' || section == 'product' )
	{
		html += '<button class="btn blue route-action" data-route="{{ id }}" data-translation="[0-9]+"><span>Add ID</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ slug }}" data-translation="([a-z-]+)"><span>Add Slug</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ title }}" data-translation="([a-z-]+)"><span>Add Title</span></button>';
	}

	// Add to document
	$(html).insertAfter($('#route'));

	// Bind events
	$('button.route-action').click(function(e) {
		e.preventDefault();
		$('#route').val($('#route').val()+$(this).data('route')).focus();
		$('#translation').val($('#translation').val()+$(this).data('translation'));
	});


});