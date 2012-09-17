
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>
	
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />

		<section class="title">
			<h4><?php echo ( isset($title) ? str_replace('%t', $title, lang('firesale:prod_header')) : lang('firesale:prod_title_create') ); ?></h4>
		</section>

		<section class="item">

			<div class="tabs">

				<ul class="tab-menu">
					<?php foreach( $tabs AS $tab ): ?>
					<?php if( ( substr($tab, 0, 1) == '_' && isset($id) && $id > 0 ) || substr($tab, 0, 1) != '_' ): ?>
					<li><a href="#<?php echo strtolower(str_replace(array(' ', '_'), '', $tab)); ?>"><span><?php echo lang('firesale:tabs:' . str_replace('_', '', $tab)); ?></span></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
		
				<?php foreach( $fields AS $slug => $field ): ?>
				<?php if( $slug == '_images' && isset($id) && $id > 0 ): ?>
				<div id="images" class="form_inputs">
					<fieldset>
						<div id="dropbox">
						<?php echo ( count($images) > 0 ? '' : '	<span class="message">' . lang('firesale:label_drop_images') . '</span>' ); ?>
						<?php foreach($images as $image): ?>
							<div class="preview" id="image-<?php echo $image->id; ?>">
								<span class="imageHolder">
									<a href="{{ site:url }}admin/firesale/products/delete_image/<?php echo $image->id; ?>" class="delete">x</a>
									<img src="/files/thumb/<?php echo $image->id; ?>/480/360" />
								</span>
								<span class="imageTitle"><?php echo $image->name; ?></span>
							</div>
						<?php endforeach; ?>
							<br class="clear" />
						</div>
					</fieldset>
				</div>

				<?php elseif( substr($slug, 0, 1) == '_' && isset($id) && $id > 0 ): ?>
				<div id="<?php echo strtolower(str_replace(array(' ', '_'), '', $slug)); ?>" class="form_inputs">
					<fieldset>
						<?php echo $field; ?>
					</fieldset>
				</div>

				<?php elseif( substr($slug, 0, 1) != '_' ): ?>
				<div id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>" class="form_inputs">
					<fieldset>
						<ul>
						<?php foreach( $field AS $input ): ?>
							<li class="<?php echo alternator('even', ''); ?>">
								<label for="<?php echo $input['input_slug']; ?>">
									<?php echo lang(substr($input['input_title'], 5)); ?> <?php echo $input['required']; ?>
									<small><?php echo lang(substr($input['instructions'], 5)); ?></small>
								</label>
								<div class="input"><?php echo $input['input']; ?></div>
							</li>
						<?php endforeach; ?>
						</ul>
					</fieldset>
				</div>

				<?php endif; ?>
				<?php endforeach; ?>

			</div>

			<div class="buttons">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
			</div>

		</section>
		
	<?php echo form_close(); ?>
