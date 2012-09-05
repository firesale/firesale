	
	<section class="title">
		<h4><?php echo lang('firesale:gateways:admin_title'); ?></h4>
	</section>

	<section class="item">

		<?php if ( ! empty($gateways)): ?>
			<?php echo form_open(); ?>
			<table id="product_table">		    
				<thead>
					<tr>
						<th><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
						<th><?php echo lang('firesale:gateways:labels:name'); ?></th>
						<th><?php echo lang('firesale:gateways:labels:desc'); ?></th>
						<th style="width: 200px;"></th>
					</tr>
				</thead>
				<tbody>
					
						<?php foreach ($gateways as $gateway): ?>
							<tr>
								<td><input type="checkbox" name="action_to[]" value="<?php echo $gateway['id']; ?>"  /></td>
								<td><?php echo $gateway['name']; ?></td>
								<td><?php echo $gateway['desc']; ?></td>
								<td class="actions">
									<?php if ($gateway['enabled'] AND group_has_role('firesale', 'enable_disable_gateways')): ?>
										<a class="confirm button small" href="<?php echo site_url('admin/firesale/gateways/disable/'.$gateway['id']); ?>" title="<?php echo lang('firesale:gateways:warning'); ?>"><?php echo lang('buttons.disable'); ?></a>
									<?php elseif (group_has_role('firesale', 'enable_disable_gateways')): ?>
										<a class="button small" href="<?php echo site_url('admin/firesale/gateways/enable/'.$gateway['id']); ?>"><?php echo lang('buttons.enable'); ?></a>
									<?php endif; ?>
									<?php if (group_has_role('firesale', 'edit_gateways')): ?>
										<a class="button small" href="<?php echo site_url('admin/firesale/gateways/edit/'.$gateway['slug']); ?>"><?php echo lang('buttons.edit'); ?></a>
									<?php endif; ?>
									<?php if (group_has_role('firesale', 'install_uninstall_gateways')): ?>
										<a class="confirm button small" href="<?php echo site_url('admin/firesale/gateways/uninstall/'.$gateway['id']); ?>" title="<?php echo lang('firesale:gateways:warning'); ?>"><?php echo lang('buttons.uninstall'); ?></a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
			<br />

			<div class="table_action_buttons">
				<?php if (group_has_role('firesale', 'enable_disable_gateways')): ?>
					<button class="btn red green" value="enable" name="btnAction" type="submit" disabled="">
						<span><?php echo lang('buttons.enable'); ?></span>
					</button>
				
					<button class="btn red orange" value="disable" name="btnAction" type="submit" disabled="">
						<span><?php echo lang('buttons.disable'); ?></span>
					</button>
				<?php endif; ?>
				
				<?php if (group_has_role('firesale', 'install_uninstall_gateways')): ?>
					<button class="btn red confirm" title="<?php echo lang('firesale:gateways:multiple_warning'); ?>" value="uninstall" name="btnAction" type="submit" disabled="">
						<span><?php echo lang('buttons.uninstall'); ?></span>
					</button>
				<?php endif; ?>
			</div>
			
			<?php echo form_close(); ?>
		<?php else: ?>
			<div class="no_data"><?php echo lang('firesale:gateways:no_gateways'); ?></div>
		<?php endif; ?>

	</section>
