<h1><?php echo lang('firesale:cats_title'); ?></h1>

<div class="one_half">
	<section class="title">
		<h4><?php echo lang('firesale:cats_order'); ?></h4>
	</section>
	<section class="item">
		<div id="category-sort">
		<ul class="sortable">

			<?php foreach($cats as $cat): ?>
	
					<li id="cat_<?php echo $cat['id']; ?>">
						<div>
							<a href="#" rel="<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></a>
						</div>
				
					<?php if(isset($cat['children'])): ?>
						<ul>
							<?php $controller->categories_m->tree_builder($cat); ?>
						</ul>
					</li>
				
					<?php else: ?>
					
					</li>
				
				<?php endif; ?>
			<?php endforeach; ?>

		</ul>
		</div>
	</section>
</div>

<div class="one_half last" id="tabs">	
	<section class="title">
		<h4><?php echo lang('firesale:cats_new'); ?></h4>
<?php if( !empty($tabs) ): ?>
		<ul>
<?php foreach( $tabs AS $tab ): ?>
			<li><a href="#<?php echo strtolower(str_replace(' ', '', $tab)); ?>"><?php echo ucwords($tab); ?></a></li>
<?php endforeach; ?>
		</ul>
<?php endif; ?>
	</section>
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>
<?php foreach( $fields AS $slug => $field ): ?>
		<section class="item form_inputs" id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>">
			<input type="hidden" name="id" value="<?php echo ( isset($input->id) ? $input->id : '' ); ?>" />
			<fieldset>
				<ul>
	
<?php foreach( $field AS $i ): ?>
					<li class="<?php echo alternator('even', ''); ?>">
						<label for="<?php echo $i['input_slug']; ?>"><?php echo lang(substr($i['input_title'], 5)); ?> <?php echo $i['required']; ?></label>
						<div class="input"><?php echo $i['input']; ?></div>
					</li>

<?php endforeach; ?>
				</ul>
			</fieldset>
	
		</section>

<?php endforeach; ?>

        <div class="buttons">
<?php if( isset($input->id) ): ?>
			<button type="submit" class="btn blue" value="save" name="btnAction"><span><?php echo lang('firesale:cats_edit'); ?></span></button>
	<?php if( $input->id > 1 ): ?>
			<button type="submit" class="btn red confirm" value="save" name="btnAction"><span><?php echo lang('firesale:cats_delete'); ?></span></button>
	<?php endif; ?>
<?php else: ?>
			<button type="submit" class="btn blue" value="save" name="btnAction"><span><?php echo lang('firesale:cats_new'); ?></span></button>
<?php endif; ?>
		</div>

	<?php echo form_close(); ?>
</div>
