
	<section class="title">
		<h4><?php echo lang('firesale:shipping:title'); ?></h4>
	</section>
	
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
	
		<section class="item">
<?php if( empty($options) ): ?>
			<div class="no_data"><?php echo lang('firesale:shipping:none'); ?></div>
		</section>
<?php else: ?>

			<table>		    
				<thead>
					<tr>
						<th><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
						<th><?php echo lang('firesale:label_title'); ?></th>
						<th><?php echo lang('firesale:label_company'); ?></th>
						<th><?php echo lang('firesale:label_price'); ?></th>
						<th><?php echo lang('firesale:label_price_min_max'); ?></th>
						<th><?php echo lang('firesale:label_weight_min_max'); ?></th>
						<th style="width: 120px"></th>
					</tr>
				</thead>
				<tbody>
<?php foreach( $options AS $option ): ?>
					<tr>
						<td><input type="checkbox" name="action_to[]" value="<?php echo $option['id']; ?>"  /></td>
						<td><?php echo $option['title']; ?></td>
						<td><?php echo $option['company']; ?></td>
						<td><?php echo $this->settings->get('currency') . $option['price']; ?></td>
						<td>
							<?php echo $this->settings->get('currency') . ( strlen($option['price_min']) > 0 ? $option['price_min'] : '0.00' ); ?>
							<?php echo lang('firesale:label_up_to'); ?>
							<?php echo ( strlen($option['price_max']) > 0 ? $this->settings->get('currency') . $option['price_max'] : 'Unlimited' ); ?></td>
						<td>
							<?php echo ( strlen($option['weight_min']) > 0 ? $option['weight_min']: '0.00' ); ?>kg
							<?php echo lang('firesale:label_up_to'); ?>
							<?php echo ( strlen($option['weight_max']) > 0 ? $option['weight_max'] :  'Unlimited' ); ?>kg
						</td>
						<td>
							<a class="button small" href="<?php echo site_url('admin/firesale_shipping/edit/'.$option['id']); ?>"><?php echo lang('global:edit'); ?></a>
							<a class="button small confirm" href="<?php echo site_url('admin/firesale_shipping/delete/'.$option['id']); ?>"><?php echo lang('global:delete'); ?></a>
						</td>
					</tr>
<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="9"><div style="float:right;"></div></td>
					</tr>
				</tfoot>
			</table>

			<div class="buttons">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
			</div>
		</section>
<?php endif; ?>
		
	<?php echo form_close(); ?>

<?php if( isset($pagination) ): ?>
	<?php echo $pagination; ?>
<?php endif; ?>