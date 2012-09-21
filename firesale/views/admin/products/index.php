	<section class="title">
		<h4><?php echo lang('firesale:prod_title'); ?></h4>
	</section>
	
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
	
		<section class="item">
<?php if( $count == 0 ): ?>
			<div class="no_data"><?php echo lang('firesale:prod_none'); ?></div>
		</section>
<?php else: ?>

			<fieldset id="filters">
			    <legend><?php echo lang('global:filters'); ?></legend>
			    <ul>  
			        <li class="<?php echo alternator('even', ''); ?>">
						<div class="input">
							<?php echo form_dropdown('filter', $categories, ( isset($category) ? $category : 0 ), 'id="filter-category" class="filter"'); ?>
						</div>
					</li>
			    </ul>
			</fieldset>

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

				<tfoot>
					<tr>
						<td colspan="9"><div style="float:right;"><?php echo $pagination['links']; ?></div></td>
					</tr>
				</tfoot>

				<tbody>
<?php foreach($products as $product): ?>
					<tr class="cat_<?php echo $product['category']['id']; ?>">
						<td><input type="checkbox" name="action_to[]" value="<?php echo $product['id']; ?>"  /></td>
						<td class="item-id"><?php echo $product['code']; ?></td>
						<td class="item-img"><img src="<?php echo ( $product['image'] != FALSE ? site_url('files/thumb/' . $product['image'] . '/32/32') : '' ); ?>" alt="Product Image" /></td>
						<td class="item-title"><a href="/product/<?php echo $product['slug']; ?>"><?php echo $product['title']; ?></a></td>
						<td class="item-category">
							<?php $string = ''; foreach( $product['category'] AS $cat ) { $string .= ( strlen($string) == 0 ? '' : ', ' ) . '<span data-id="' . $cat['id'] . '">' . $cat['title'] . '</span>'; } echo $string; ?>
						</td>
						<td class="item-stock"><?php echo ( $product['stock_status']['key'] == 6 ? lang('firesale:label_stock_unlimited') . ' (&infin;)' : $product['stock'] ); ?></td>
						<td><?php echo $this->settings->get('currency'); ?><span class="item-price"><?php echo $product['price']; ?></span></td>
						<td class="actions">
							<a href="#" class="button quickedit"><?php echo lang('firesale:prod_button_quick_edit'); ?></a> 
							<a href="<?php echo site_url(); ?>admin/firesale/products/edit/<?php echo $product['id']; ?>" class="button edit"><?php echo lang('global:edit'); ?></a> 
							<a href="<?php echo site_url(); ?>admin/firesale/products/delete/<?php echo $product['id']; ?>" class="button confirm"><?php echo lang('global:delete'); ?></a>
						</td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>

			<div class="table_action_buttons">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
				<button class="btn green" name="btnAction" value="duplicate"><span><?php echo lang('firesale:label_duplicate'); ?></span></button>
			</div>

		</section>
<?php endif; ?>
		
	<?php echo form_close(); ?>
