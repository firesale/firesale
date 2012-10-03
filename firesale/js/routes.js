$(function() {
	
	// Variables
	var section = $('input#slug').val();


	// Add target
	$('<div class="btntar"></div>').insertAfter($('#map'));

	// Fix map value
	$('#map').val($('#map').val().replace(/&#123;/g, '{').replace(/&#125;/g, '}'));

	// Initial load
	build_buttons();

	// Bind events
	$('#slug, #title').bind('keyup keydown change update blur focus', function() {
		build_buttons();
	});

	$('#map').bind('keyup keydown change delete paste update', function() {
		var val = $('#map').val();
		$('.route-action').each(function() {
			var regex = new RegExp($(this).data('route'),"g");
			val = val.replace(regex, $(this).data('translation'));
		});
		$('#route').val(val);
	});



});

function build_buttons()
{

	// Variables
	var html = '<button class="btn blue route-action" data-route="{{ any }}" data-translation="(:any)"><span>Add Any</span></button>';
	var slug = $('#slug').val();
	var id   = $('form.crud').attr('action').split('/');
	    id   = id[(id.length-1)];

	// Category and product
	if( id == '1' || slug == 'category' || id == '2' || slug == 'product' )
	{
		html += '<button class="btn blue route-action" data-route="{{ id }}" data-translation="([0-9]+)"><span>Add ID</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ slug }}" data-translation="([a-z0-9-]+)"><span>Add Slug</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ title }}" data-translation=".+?"><span>Add Title</span></button>';
	}

	// Product specific
	if( id == '2' || slug == 'product' )
	{
		html += '<button class="btn blue route-action" data-route="{{ category_id }}" data-translation="[0-9]+"><span>Add Category ID</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ category_slug }}" data-translation="[a-z0-9-]+"><span>Add Category Slug</span></button>';
	}

	// Insert
	$('.btntar').html(html);

	// Bind action
	$('button.route-action').click(function(e) {
		e.preventDefault();
		$('#map').atCaret('insert', $(this).data('route'));
		$('#map').change().focus();
	});

}