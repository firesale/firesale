$(function()
{
	$('#tax_assignments thead tr td').not('.spacer').mouseover(function()
	{
		var tax_id = $(this).attr('id');

		$(this).html('<a href="' + SITE_URL + 'admin/firesale/taxes/edit/' + tax_id + '">Edit</a>' + 
			' | <a href="' + SITE_URL + 'admin/firesale/taxes/delete/' + tax_id + '">Delete</a>');
	}).not('.spacer').mouseout(function()
	{
		$(this).html($(this).attr('title'));
	})
});