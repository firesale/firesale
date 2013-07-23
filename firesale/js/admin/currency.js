$(function() {

	// Create/Edit
	$('<span>&nbsp;%</span>').insertAfter($('input[name=cur_tax]').css('cssText', 'min-width: 60px !important; width: 60px !important'));
	$('<input type="hidden" name="cur_mod_type" value="+" /><button name="cur_mod_type_btn" value="+" class="btn gray mod">+</button> ').insertBefore($('input[name=cur_mod]').css('cssText', 'min-width: 60px !important; width: 60px !important'));
	$('button[name=cur_mod_type_btn]').click(function(e) { 
		e.preventDefault();
		var h = $('input[name=cur_mod_type]'), b = $('button[name=cur_mod_type_btn]');
		if( h.val() == '+' ) { h.val('-'); b.val('-').text('-'); }
		else if( h.val() == '-' ) { h.val('*'); b.val('-').text('x'); }
		else if( h.val() == '*' ) { h.val('+'); b.val('+').text('+'); }
	});

	// Create/Edit Page Load
	if( $('#exch_rate').size() > 0 )
	{
		if( $('#exch_rate').val().length > 0 )
		{
			var s = $('input[name=cur_mod]').val().split('|');
			$('input[name=cur_mod_type]').val(s[0]);
			$('button[name=cur_mod_type_btn]').val(s[0]).text(( s[0] == '*' ? 'x' : s[0] ));
			$('input[name=cur_mod]').val(s[1]);
		}
		else
		{
			$('#exch_rate').val('0');
		}
	}

});