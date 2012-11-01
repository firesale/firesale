<section class="title">
	<h4><?php echo lang('firesale:sections:taxes'); ?></h4>
</section>

<section class="item">
	<?php if ($taxes['total'] > 0): ?>
	
		<?php echo form_open('admin/firesale/taxes/delete', 'class="crud"'); ?>

			<table>
				<thead>
					<tr>
						<th style="width: 15px"><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
						<th><?php echo lang('firesale:label_title'); ?></th>
						<th style="width: 130px"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($taxes['entries'] as $tax ): ?>
						<tr>
							<td>
								<?php if ($tax['id'] != 1): ?>
									<input type="checkbox" name="action_to[]" value="<?php echo $tax['id']; ?>" /></td>
								<?php endif; ?>
							<td><?php echo $tax['title']; ?></td>
							<td>
								<a href="<?php echo site_url('admin/firesale/taxes/edit/' . $tax['id']); ?>" class="btn blue"><?php echo lang('global:edit'); ?></a>
								
								<?php if ($tax['id'] != 1): ?>
									<a href="<?php echo site_url('admin/firesale/taxes/delete/' . $tax['id']); ?>" class="btn red confirm"><?php echo lang('global:delete'); ?></a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5">
							<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
						</td>
					</tr>
				</tfoot>
			</table>

			<div class="table_action_buttons">
				<button class="btn red confirm" name="btnAction" value="delete"><span><?php echo lang('global:delete'); ?></span></button>
			</div>

		<?php echo form_close(); ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('firesale:taxes:none'); ?></div>
	<?php endif;?>
</section>