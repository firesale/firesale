
	<h1><?php echo ( isset($title) ? str_replace('%t', $title, lang('firesale:prod_header')) : lang('firesale:prod_title_create') ); ?></h1>

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>
	
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />

		<section class="title">
			<h4>&nbsp;</h4>
			<ul>
<?php if( isset($id) && $id > 0 ): ?>
				<li><a href="#images">Images</a></li>
<?php endif; ?>
<?php foreach( $tabs AS $tab ): ?>
				<li><a href="#<?php echo strtolower(str_replace(' ', '', $tab)); ?>"><?php echo ucwords($tab); ?></a></li>
<?php endforeach; ?>
			</ul>
		</section>
		
<?php foreach( $fields AS $slug => $field ): ?>
		<section class="item form_inputs" id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>">

			<fieldset>
				<ul>
	
<?php foreach( $field AS $input ): ?>
					<li class="<?php echo alternator('even', ''); ?>">
						<label for="<?php echo $input['input_slug']; ?>"><?php echo lang(substr($input['input_title'], 5)); ?> <?php echo $input['required']; ?></label>
						<div class="input"><?php echo $input['input']; ?></div>
					</li>

<?php endforeach; ?>
				</ul>
			</fieldset>
	
		</section>

<?php endforeach; ?>
<?php if( isset($id) && $id > 0 ): ?>

		<section class="item" id="images">
		
			<div id="dropbox">
			<?php echo ( count($images) > 0 ? '' : '	<span class="message">Drop images here to upload</span>' ); ?>
			<?php foreach($images as $image): ?>
		
				<div class="preview" id="image-<?php echo $image->id; ?>">
					<span class="imageHolder">
						<img src="/files/thumb/<?php echo $image->id; ?>/480/360" />
					</span>
					<span class="imageTitle"><?php echo $image->name; ?></span>
				</div>

			<?php endforeach; ?>
				<br class="clear" />
			</div>
		
		</section>
<?php endif; ?>
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>
