
	<section class="title">
		<h4><?php echo lang('firesale:sections:routes'); ?></h4>
	</section>

	<section class="item">
	<?php if ($routes['total'] > 0 ): ?>
	
		<table>
			<thead>
				<tr>
					<th><?php echo lang('firesale:label_title'); ?></th>
					<th><?php echo lang('firesale:label_slug'); ?></th>
					<th><?php echo lang('firesale:label_route'); ?></th>
					<th><?php echo lang('firesale:label_translation'); ?></th>
					<th style="width: 130px"></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach($routes['entries'] as $route ): ?>
				<tr>
					<td><?php echo $route['name']; ?></td>
					<td><?php echo $route['slug']; ?></td>
					<td><?php echo $route['route']; ?></td>
					<td><?php echo $route['translation']; ?></td>
					<td><?php echo anchor('admin/firesale/routes/edit/' . $route['id'], lang('global:edit'), 'class="btn orange edit"'); ?>
                                            <?php echo anchor('admin/firesale/routes/delete/' . $route['id'], lang('global:delete'), array('class' => 'confirm btn red delete')); ?>
                                        </td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('firesale:routes:none'); ?></div>
	<?php endif;?>
	</section>