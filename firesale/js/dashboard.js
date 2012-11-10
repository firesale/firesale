$(function(){

	function sameHeight() {

		$('#sortable .one_half:even').each(function() {
			var i1 = $(this), i2 = $(this).next();
			i1.height('auto').find('.item').height('auto');
			i2.height('auto').find('.item').height('auto');
			var h1 = i1.outerHeight(), h2 = i2.outerHeight();
			if( h1 > h2 ) { i2.height(h1).find('.item').height(h1 - 85); }
			else if( h2 > h1 ) { i1.height(h2).find('.item').height(h2 - 85); }
		});

	}
	
	$('#sortable').bind('sortstop', function(event, ui) {
		var o = $('#sortable').sortable('toArray'), cookie = '';
		for( var i in o ) { if( o[i].length > 0 ) { s += ( s == '' ? '' : '|' ) + o[i]; } }
		$.cookie('dashboard_order', s);
		sameHeight();
	});
	
	setTimeout(sameHeight, 50);

	$('.tab-menu li a').click(function() { setTimeout(sameHeight, 10); });
	
});
