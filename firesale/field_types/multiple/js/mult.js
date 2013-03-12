(function($){
	$(function(){
	    mychange = function ( $list ){
	    	$('select.foo').val($.dds.serialize( 'list_2' ));    
	    }
	    $('ul').drag_drop_selectable({
	   	    onListChange:mychange
	    });
	});
})(jQuery);