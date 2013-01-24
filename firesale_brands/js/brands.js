$(function(){

	// Add upload
	bind_upload('admin/firesale_brands/upload/'+$('#id').val());

	// Image reordering
	$('#dropbox').sortable({
		cursor: 'move',
		cancel: 'span.message',
		stop: function(event, ui) {
			var o = '';
			$('#dropbox .preview').each(function(){ o += ',' + $(this).attr('id').replace('image-', ''); });
			$.post(SITE_URL+'admin/firesale/products/ajax_order_images', { order: o.substr(1), csrf_hash_name: $.cookie(pyro.csrf_cookie_name) }, function(data) {
				if( data != 'ok' ) { alert(data); }
			});
		}
	});

});