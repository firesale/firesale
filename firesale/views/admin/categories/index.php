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
							<?php $controller->tree_builder($cat); ?>
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
			<li><a href="#images">Images</a></li>
<?php foreach( $tabs AS $tab ): ?>
			<li><a href="#<?php echo strtolower(str_replace(' ', '', $tab)); ?>"><?php echo ucwords($tab); ?></a></li>
<?php endforeach; ?>
		</ul>
<?php endif; ?>
	</section>
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>
<?php foreach( $fields AS $slug => $field ): ?>
		<section class="item form_inputs" id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>">
			<input type="hidden" name="id" value="" />
			<fieldset>
				<ul>
	
<?php foreach( $field AS $input ): ?>
					<li class="<?php echo alternator('even', ''); ?>">
						<label for="<?php echo $input['input_slug']; ?>"><?php echo lang($input['input_title']); ?> <?php echo $input['required']; ?></label>
						<div class="input"><?php echo $input['input']; ?></div>
					</li>

<?php endforeach; ?>
				</ul>
			</fieldset>
	
		</section>

<?php endforeach; ?>
		<section class="item form_inputs" id="images">
          Coming Soon&#0153;
        </section>

		<button type="submit" class="btn blue" value="save" name="btnAction"><span>Add category</span></button>
	<?php echo form_close(); ?>
</div>
