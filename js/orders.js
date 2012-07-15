$(function() {
	
	// Create
	$('#tabs').tabs();
	if( !window.location.hash ) {
		$('#tabs').tabs("select", '#general');
	}

});
