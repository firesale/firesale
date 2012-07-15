$(function(){

	function sameHeight() {

		$('.full_width .one_half:even').each(function() {
			var i1 = $(this), i2 = $(this).next();
			i1.height('auto').find('.item').height('auto');
			i2.height('auto').find('.item').height('auto');
			var h1 = i1.outerHeight(), h2 = i2.outerHeight();
			if( h1 > h2 ) { i2.height(h1).find('.item').height(h1 - 85); }
			else if( h2 > h1 ) { i1.height(h2).find('.item').height(h2 - 85); }
		});

	}
	
	$('.full_width').sortable({
		connectWith: '.full_width',
		handle: '.title',
		cursor: 'move',
		start: function(event, ui) {
			/*var h = ui.item.outerHeight();
			ui.item.next('.ui-sortable-placeholder').height(h - 22);*/
		},
		update: function(event, ui) {
			sameHeight();
		},
		stop: function(event, ui) {
			var o = $('.full_width').sortable('toArray'), s = '';
			for( var i in o ) { if( o[i].length > 0 ) { s += ( s == '' ? '' : '|' ) + o[i]; } }
			$.cookie('dashboard_order', s);
			sameHeight();
		}
	});
	
	$('.full_width, .section_add').disableSelection();
	
	$('section.title a.close').click(function(){ 
	
		var c = $.cookie('dashboard_order'), id = $(this).parent().parent().attr('id').replace('#', '');
		$.cookie('dashboard_order', c.replace(id, '').replace('||', '|'));
		$('#' + id).fadeOut(250, function() { $(this).remove(); });
		return false;
	
	});
	
	sameHeight();
	
});
