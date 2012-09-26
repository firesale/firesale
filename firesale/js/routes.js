$(function() {
	
	// Variables
	var section = $('input#slug').val();
	var html    = '<br />';
	var id      = $('form.crud').attr('action').split('/');
	    id      = id[(id.length-1)];

	// Bind to route
	$('#map').bind('keyup keydown change delete paste update', function() {
		var val = $('#map').val();
		$('.route-action').each(function() {
			var regex = new RegExp($(this).data('route'),"g");
			val = val.replace(regex, $(this).data('translation'));
		});
		$('#route').val(val);
	});

	// Fix map value
	$('#map').val($('#map').val().replace(/&#123;/g, '{').replace(/&#125;/g, '}'));

	// Section specific
	if( id == '1' || id == '2' )
	{
		html += '<button class="btn blue route-action" data-route="{{ id }}" data-translation="([0-9]+)"><span>Add ID</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ slug }}" data-translation="([a-z0-9-]+)"><span>Add Slug</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ title }}" data-translation=".+?"><span>Add Title</span></button>';
	}

	// Add to document
	$(html).insertAfter($('#map'));

	// Bind events
	$('button.route-action').click(function(e) {
		e.preventDefault();
		$('#map').val($('#map').val()+$(this).data('route')).focus();
		$('#route').val($('#route').val()+$(this).data('translation'));
	});


});