$(function(){

	
	$('#sortable').bind('sortstop', function(event, ui) {
		var o = $('#sortable').sortable('toArray'), s = '';
		for( var i in o ) { if( o[i].length > 0 ) { s += ( s == '' ? '' : '|' ) + o[i]; } }
		$.cookie('firesale_dashboard_order', s);
	});

	var _t;
	$('.one_half .tooltip-s.toggle').click(function() {
		clearTimeout(_t);
		_t = setTimeout(function() {
			var h = '';
			$('.one_half .item').each(function() { 
				if( $(this).is(':hidden') ) { h += ( h == '' ? '' : '|' ) + $(this).parents('.one_half').attr('id'); }
			});
			$.cookie('firesale_dashboard_hidden', h);
		}, 1000);
	});

});
