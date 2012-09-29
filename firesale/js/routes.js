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

	// Category and product
	if( id == '1' || id == '2' )
	{
		html += '<button class="btn blue route-action" data-route="{{ id }}" data-translation="([0-9]+)"><span>Add ID</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ slug }}" data-translation="([a-z0-9-]+)"><span>Add Slug</span></button>';
		html += '<button class="btn blue route-action" data-route="{{ title }}" data-translation=".+?"><span>Add Title</span></button>';
	}

	// Product specific
	if( id == '2' )
	{
		html += '<button class="btn blue route-action" data-route="{{ category_slug }}" data-translation=".+?"><span>Add Category Slug</span></button>';
	}

	// Add to document
	$(html).insertAfter($('#map'));

	// Bind events
	$('button.route-action').click(function(e) {
		e.preventDefault();
		$('#map').atCaret('insert', $(this).data('route'));
		$('#map').change().focus();
	});

});

$.fn.extend({insertAtCaret:function(a){if(document.selection){this.focus();sel=document.selection.createRange();sel.text=a;this.focus()}else if(this.selectionStart||this.selectionStart=="0"){var b=this.selectionStart;var c=this.selectionEnd;var d=this.scrollTop;this.value=this.value.substring(0,b)+a+this.value.substring(c,this.value.length);this.focus();this.selectionStart=b+a.length;this.selectionEnd=b+a.length;this.scrollTop=d}else{this.value+=a;this.focus()}}})