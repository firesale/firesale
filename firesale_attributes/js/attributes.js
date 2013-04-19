$(function() {

	$('#attr_form textarea').autogrow();
	$('#attr_form a.add').live('click', function(e) {
		e.preventDefault();
		var obj = $('#attr_form tbody tr:last-child').clone(), no = ( $('#attr_form tr.new').size() + 1 );
		obj.removeAttr('id').addClass('new');
		obj.find('.center').html('&nbsp;');
		obj.find('.chzn-container').remove();
		obj.find('textarea').attr('name', 'attribute[new_'+no+'][value]').val('').autogrow();
		obj.find('select').attr('name', 'attribute[new_'+no+'][key]').attr('class', '');
		$('#attr_form tbody').append(obj);
		$('#attr_form tbody tr:last-child select').removeAttr('id').removeAttr('class').chosen().trigger('liszt:updated');
      	style_rows();
      	$('#attr_form .chzn-container').each(function() {
      		$(this).css({'min-width': '100%', 'max-width': '100%'});
      		$(this).find('.chzn-drop').css('width', $(this).outerWidth()-2);
      		$(this).find('input').css('width', $(this).outerWidth()-36);
      	});
	});

	$('#attributes .chzn-search input').live('keyup keydown change paste delete', function() {
		var obj = $(this).parents('.chzn-drop').find('.chzn-results');
		if( obj.find('li.no-results span').length > 0 && obj.find('.add').length <= 0 ) {
			obj.append('<li class="add no-results"><center>Click here to add it</center></li>');
			obj.find('.add center').click(function(e) {
				var val = $(this).parents('td.option').find('.chzn-search input').val(), sel = $(this).parents('td.option').find('select'), t = $(this);
				var d = '.'; var timer = setInterval(function() { t.text('Adding' + d); if( d.length >= 3 ) { d = '.'; } else { d += '.'; } }, 250);
				$.get(SITE_URL + 'admin/firesale_attributes/ajax_create/' + val, function(data) {
					if( data.substr(0, 2) == 'ok' ) {
						clearInterval(timer);
						t.parent().remove();
						var s = data.split('|');
						$('#attr_form select').append('<option value="' + s[1] + '">' + s[2] + '</option>').trigger('liszt:updated');
						sel.val(s[1]).trigger('liszt:updated');
					}
				});
			});
		}
	});

	setTimeout(function() { $('#attributes .chzn-search input').attr('placeholder', 'Search or type to add a new attribute'); }, 250);

	$('#attr_form tbody').sortable({
		handle: 'span.mover',
		update: function() {
			var order = [];
			style_rows() ;
			$('#attr_form tbody > tr').each(function() { order.push(this.id); });
			order = order.join(',');
			$.post(SITE_URL + 'admin/firesale_attributes/ajax_order', { order: order, row: $('input[name=id]').val() });
		}
	});

});

function style_rows() { $('#attr_form tbody > tr').removeClass('alt'); $('#attr_form tbody > tr:nth-child(even)').addClass('alt'); }
