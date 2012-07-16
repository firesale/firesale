$(function() {

	move_field($('#price_max'), $('#price_min'), currency, '&nbsp;&nbsp;&nbsp;&nbsp;');
	move_field($('#weight_max'), $('#weight_min'), '&nbsp;&nbsp;', 'kg');
	$('#price, #price_min, #price_max, #weight_min, #weight_max').attr('placeholder', '0.00').attr('pattern', '^\\d+\\.\\d{2}$');
	$('<span>' + currency + '&nbsp;</span>').insertBefore($('#price'));

});

function move_field(source, target, before, after) {
	source.clone().remove().insertAfter(target).prepend(' to ');
	var t = target.parent().parent().find('label');
	var e = t.text().split(' ('); t.text(e[0]);
	source.parent().parent().remove();
	$('<span>From: ' + before + ' </span>').insertBefore(target);
	$('<span> ' + after + ' To: ' + before + ' </span>').insertAfter(target);
	$('<span> ' + after + '</span>').insertAfter($('#' + source.attr('id')));
}