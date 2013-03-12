<?php

	if(!defined('PYROSTREAMS_MULT_JS_LOADED')):
		
		if (substr(CMS_VERSION, 0, 3) >= '2.1') {
			$streams = 'streams_core';
		}
		else {
			$streams = 'streams';
		}
		
		echo '<script type="text/javascript" src="'.site_url($streams . '/field_asset/js/multiple/multiple_drag.js').'"></script>';
		
		define('PYROSTREAMS_MULT_JS_LOADED', TRUE);

	endif;
	
?>

<script type="text/javascript" language="javascript">
 // <![CDATA[
	(function($){
		$(function(){
		    <?php echo $slug; ?>_change = function ( $list ){
		    	$('input#<?php echo $slug; ?>').val($.dds.serialize( '<?php echo $slug; ?>_list_2' ));    
		    }
		    var $list = $('ul.<?php echo $slug; ?>_ml').drag_drop_selectable({
		   	    onListChange: <?php echo $slug; ?>_change
		    });
		    // get all the items, and save them for future use
		    $list.data('items', 
		    	// and bind the double click event
			    $list.find('li').bind('dblclick.dds_select',function(e){
		          var $el = $(this);
		          var $old_list = $el.parent();
		          var new_list_id = ($old_list[0].id.slice(-1) == '1') ? '2' : '1';
		          var $new_list = $('#' + $old_list[0].id.slice(0, $old_list[0].id.length - 1) + new_list_id);
		          $.fn.drag_drop_selectable.moveBetweenLists($el.attr('dds'), $old_list.attr('dds'), $new_list.attr('dds'));
		          <?php echo $slug; ?>_change($list);
		      })
		    );
		});
	})(jQuery);
// ]]>
</script>

<table class="mult_lists" cellpadding="0" cellspacing="0">

<tr>
	<th width="50%">Available Options</th>
	<th>Selected Options</th>
</tr>

<tr>

	<td>

		<ul id="<?php echo $slug; ?>_list_1" class="multiple_list <?php echo $slug; ?>_ml">
		
		<?php if(isset($choices) and $choices): ?>
				
		<?php foreach($choices as $id => $choice): ?>
				
			<li id="<?php echo $slug; ?>_<?php echo $id; ?>"><span><?php echo $choice; ?></span></li>
				
		<?php endforeach; ?>
		
		<?php endif; ?>
				
		</ul>

	</td>
	<td class="drag_to_area">
	
		<ul id="<?php echo $slug; ?>_list_2" class="multiple_list <?php echo $slug; ?>_ml">
		
		<?php if(isset($current) and $current): ?>

		<?php foreach($current as $id => $current_name): ?>
				
			<li id="<?php echo $slug; ?>_<?php echo $id; ?>"><span><?php echo $current_name; ?></span></li>
				
		<?php endforeach; ?>
		
		<?php endif; ?>
		
		</ul>
	
	</td>

</tr>

</table>

<input type="hidden" name="<?php echo $slug; ?>" id="<?php echo $slug; ?>" value="<?php echo $current_string; ?>" /> 