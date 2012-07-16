
<?php if( isset($id) AND $id > 0 ): ?>
	<h1><?php echo sprintf(lang('firesale:shipping:edit'), $title); ?></h1>
<?php else: ?>
	<h1><?php echo lang('firesale:shipping:create'); ?></h1>
<?php endif; ?>

	<section class="title">
		<h4><?php echo lang('firesale:sections:shipping'); ?></h4>
	</section>

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
	
		<section class="item form_inputs">
			<fieldset>
				<ul>

<?php foreach( $fields AS $input ): ?>
					<li class="<?php echo alternator('even', ''); ?>">
						<label for="<?php echo $input['input_slug']; ?>"><?php echo lang($input['input_title']); ?> <?php echo $input['required']; ?></label>
						<div class="input"><?php echo $input['input']; ?></div>
					</li>

<?php endforeach; ?>
				</ul>
			</fieldset>
		</section>
	
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>
