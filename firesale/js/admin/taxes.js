$(function()
{
	$('#tax_assignments thead th:not(.spacer)').hover(function()
	{
		var tax_id = $(this).attr('id'),
			tar    = $(this).find('.actions');

		// Add edit
		tar.html('<a href="' + SITE_URL + '/admin/firesale/taxes/edit/' + tax_id + '">Edit</a>');

		// Add delete?
		if ($(this).data('delete') == '1')
		{
			tar.append(' | <a class="confirm" href="' + SITE_URL + '/admin/firesale/taxes/delete/' + tax_id + '">Delete</a>');
		}
		
	}, function()
	{
		$(this).find('.actions').html('');
	});
});