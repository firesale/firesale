
$.fn.eqHeights=function(e){var t={child:false};var e=$.extend(t,e);var n=$(this);if(n.length>0&&!n.data("eqHeights")){n.data("eqHeights",true)}if(e.child&&e.child.length>0){var r=$(e.child,this)}else{var r=$(this).children()}var i=0;var s=0;var o=[];r.height("auto").each(function(){var e=this.offsetTop;if(i>0&&i!=e){$(o).height(s);s=$(this).height();o=[]}s=Math.max(s,$(this).height());i=this.offsetTop;o.push(this)});$(o).height(s)}

$(function(){

	$('#sortable > div').eqHeights({child:'.content'});
	$('#sortable .tab-menu li').click(function() { $('#sortable > div').eqHeights({child:'.content'}); });
	$('#sortable').bind('sortstop', function(event, ui) {
		var o = $('#sortable').sortable('toArray'), s = '';
		for( var i in o ) { if( o[i].length > 0 ) { s += ( s == '' ? '' : '|' ) + o[i]; } }
		$.cookie('firesale_dashboard_order', s);
		$('#sortable > div').eqHeights({child:'.content'});
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

	setTimeout(function() { $('#sortable').trigger('sortstop'); }, 150);

});
