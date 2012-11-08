<?php echo form_open(uri_string(), 'class="crud"'); ?>

	<section class="title">
		<h4><?php echo lang('firesale:shortcuts:assign_taxes'); ?></h4>
	</section>

	<section class="item form_inputs">

		<div class="form_inputs">
			<table id="tax_assignments">
				<thead>
					<tr>
						<td class="spacer" style="width:100px"></td>
						<?php foreach ($taxes as $tax): ?>
							<td id="<?php echo $tax['id']; ?>" data-title="<?php echo $tax['title']; ?>"><?php echo $tax['title']; ?></td>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($currencies as $currency): ?>
						<tr>
							<td><strong><?php echo $currency['title']; ?> (<?php echo $currency['cur_code']; ?>)</strong></td>
							<?php foreach ($currency['taxes'] as $tax): ?>
								<td><?php echo form_input('assignment[' . $currency['id'] . '][' . $tax['id'] . ']', $tax['value'] ? $tax['value'] : number_format($currency['cur_tax'], 2)); ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="actions">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save') )); ?>
		</div>

	</section>
<?php echo form_close(); ?>