
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud form_inputs"'); ?>

		<fieldset>
			<ul>
			<?php foreach( $fields as $input ): ?>
				<li class="<?php echo alternator('even', ''); ?>">
					<label for="<?php echo $input['input_slug']; ?>">
						<?php echo lang(substr($input['input_title'], 5)) ? lang(substr($input['input_title'], 5)) : $input['input_title']; ?> <?php echo $input['required']; ?>
						<small><?php echo lang(substr($input['instructions'], 5)) ? lang(substr($input['instructions'], 5)) : $input['instructions']; ?></small>
					</label>
					<div class="input"><?php echo $input['input']; ?></div>
				</li>
			<?php endforeach; ?>
			</ul>
		</fieldset>

		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>

	<?php echo form_close(); ?>