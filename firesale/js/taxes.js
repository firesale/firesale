$(function()
{
	$('#tax_assignments thead tr td, #tax_assignments thead tr td a').not('.spacer').hover(function()
	{
		var tax_id = $(this).attr('id');

		if (tax_id == 1)
		{
			$(this).html('<a href="' + SITE_URL + 'admin/firesale/taxes/edit/' + tax_id + '">Edit</a>');
		}
		else
		{
			$(this).html('<a href="' + SITE_URL + 'admin/firesale/taxes/edit/' + tax_id + '">Edit</a>' + 
			' | <a class="confirm" href="' + SITE_URL + 'admin/firesale/taxes/delete/' + tax_id + '">Delete</a>');
		}
		
	}, function()
	{
		$(this).html($(this).attr('data-title'));
	});
});