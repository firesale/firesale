
	<div class="one_half">
		<h1><?php echo lang('firesale:prod_title'); ?></h1>
	</div>

	<div class="one_half">
		<div id="product_search" class="form_inputs">
			<form method="post" action="">
				<fieldset>
					<ul>
						<li class="<?php echo alternator('even', ''); ?>">
							<label for="filter"><?php echo lang('firesale:label_filtercat'); ?></label>
							<div class="input">
								<?php echo form_dropdown('filter', $categories, ( isset($category) ? $category : 0 ), 'id="filter-category" class="filter"'); ?>
							</div>
						</li>
					</ul>
				</fieldset>
			</form>
		</div>
	</div>
	
<?php if( isset($pagination) ): ?>
	<div class="one_half">
		<div id="shortcuts">
			<?php echo $pagination['links']; ?>
		</div>
	</div>
<?php endif; ?>

	<section class="title">
		<h4><?php echo lang('firesale:sections:products'); ?></h4>
	</section>
	
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
	
		<section class="item">
<?php if( $count == 0 ): ?>
			<div class="no_data"><?php echo lang('firesale:prod_none'); ?></div>
		</section>
<?php else: ?>

			<table id="product_table">		    
				<thead>
					<tr>
						<th style="width: 15px"><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
						<th style="width: 110px"><?php echo lang('firesale:label_id'); ?></th>
						<th style="width: 40px"><?php echo lang('firesale:label_image'); ?></th>
						<th style="width: 340px"><?php echo lang('firesale:label_title'); ?></th>
						<th style="width: 160px"><?php echo lang('firesale:label_parent'); ?></th>
						<th style="width: 80px"><?php echo lang('firesale:label_stock_short'); ?></th>
						<th style="width: 90px"><?php echo lang('firesale:label_price'); ?></th>
						<th style="width: 180px"></th>
					</tr>
				</thead>
				<tbody>
<?php foreach($products as $product): ?>
					<tr class="cat_<?php echo $product['category']['id']; ?>">
						<td><input type="checkbox" name="action_to[]" value="<?php echo $product['id']; ?>"  /></td>
						<td class="item-id"><?php echo $product['code']; ?></td>
						<td class="item-img"><img src="<?php echo ( $product['image'] != FALSE ? '/files/thumb/' . $product['image'] . '/32/32' : '' ); ?>" alt="Product Image" /></td>
						<td class="item-title"><a href="/product/<?php echo $product['slug']; ?>"><?php echo $product['title']; ?></a></td>
						<td class="item-category">
							<?php $string = ''; foreach( $product['category'] AS $cat ) { $string .= ( strlen($string) == 0 ? '' : ', ' ) . '<span data-id="' . $cat['id'] . '">' . $cat['title'] . '</span>'; } echo $string; ?>
						</td>
						<td class="item-stock"><?php echo $product['stock']; ?></td>
						<td><?php echo $this->settings->get('currency'); ?><span class="item-price"><?php echo $product['price']; ?></span></td>
						<td class="actions">
							<a href="#" class="button quickedit">Quick Edit</a> 
							<a href="<?php echo site_url(); ?>admin/firesale/products/edit/<?php echo $product['id']; ?>" class="button edit">Edit</a> 
							<a href="<?php echo site_url(); ?>admin/firesale/products/delete/<?php echo $product['id']; ?>" class="button confirm">Delete</a>
						</td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>

		</section>
	
		<div class="buttons one_half">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
			<button class="btn green" name="btnAction" value="duplicate"><span><?php echo lang('firesale:label_duplicate'); ?></span></button>
		</div>
<?php if( isset($pagination) ): ?>
		<div class="one_half">
			<div id="shortcuts" class="bottom">
				<?php echo $pagination['links']; ?>
			</div>
		</div>
<?php endif; ?>
<?php endif; ?>
		
	<?php echo form_close(); ?>
