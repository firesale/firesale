
	<div class="one_half">
		<section class="title">
			<h4><?php echo lang('firesale:cats_title'); ?></h4>
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

	<div class="one_half last">

		<section class="title">
			<h4><?php if( isset($input->id) && $input->id > 0 )
						echo sprintf(lang('firesale:cats_edit_title'), $input->title);
					  else
					   	echo lang('firesale:cats_new');
			?></h4>
		</section>

		<section class="item">

			<div class="tabs">

				<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>

					<?php if( !empty($tabs) ): ?>
					<ul class="tab-menu">
					<?php foreach( $tabs AS $tab ): ?>
						<?php if( ( substr($tab, 0, 1) == '_' && isset($id) && $id > 0 ) || substr($tab, 0, 1) != '_' ): ?>
						<li><a href="#<?php echo strtolower(str_replace(array(' ', '_'), '', $tab)); ?>"><span><?php echo lang('firesale:tabs:' . str_replace('_', '', $tab)); ?></span></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
					</ul>
					<?php endif; ?>				

					<input type="hidden" name="id" id="id" value="<?php echo ( isset($input->id) ? $input->id : '' ); ?>" />

					<?php foreach( $fields AS $slug => $field ): ?>
					<?php if( ( ! isset($input->id) && substr($slug, 0, 1) != '_' ) || isset($input->id) ): ?>
					<div class="form_inputs" id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>">
						<fieldset>
							<ul>
							<?php foreach( $field AS $i ): ?>
								<li class="<?php echo alternator('even', ''); ?>">
									<label for="<?php echo $i['input_slug']; ?>"><?php echo ( lang(substr($i['input_title'], 5)) ? lang(substr($i['input_title'], 5)) : $i['input_title'] ); ?> <?php echo $i['required']; ?></label>
									<div class="input"><?php echo $i['input']; ?></div>
								</li>

							<?php endforeach; ?>
							</ul>
						</fieldset>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>

					<br class="clear" />
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

		</section>

	</div>
