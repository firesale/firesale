
<?php if( isset($id) && $id > 0 ): ?>
	<h1><?php echo sprintf(lang('firesale:orders:title_edit'), $id); ?></h1>
<?php else: ?>
	<h1><?php echo lang('firesale:orders:title_create'); ?></h1>
<?php endif; ?>

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>

		<section class="title">
			<h4>&nbsp;</h4>
			<ul>
              <li><a href="#products"><?php echo lang('firesale:sections:products'); ?></a></li>
              <li><a href="#bill"><?php echo lang('firesale:title:bill'); ?></a></li>
              <li><a href="#ship"><?php echo lang('firesale:title:ship'); ?></a></li>
              <li><a href="#general"><?php echo lang('firesale:title:general'); ?></a></li>
			</ul>
		</section>

<?php foreach( $fields AS $title => $sections ): ?>
		<section class="item form_inputs" id="<?php echo $title; ?>">
		  <fieldset>
<?php foreach( $sections AS $subtitle => $section ): ?>
            <ul<?php echo ( $title != 'general' ? ' class="width-half"' : '' ); ?>>
<?php foreach( $section AS $field ): ?>
              <li>
                <label for="<?php echo $field['input_slug']; ?>"><?php echo lang(substr($field['input_title'], 5)); ?> <?php echo $field['required']; ?>:</label>
                <?php echo $field['input']; ?>
              </li>
<?php endforeach; ?>
            </ul>
<?php endforeach; ?>
            <br class="clear" />
		  </fieldset>
		</section>

<?php endforeach; ?>
		<section class="item form_inputs" id="products">
		  <fieldset>
<?php if( isset($products) && !empty($products) ): ?>
        <table class="cart">
          <thead>
            <tr>
              <th class="remove"><?php echo lang('firesale:label_remove'); ?></th>
              <th class="image"><?php echo lang('firesale:label_image'); ?></th>
              <th class="name"><?php echo lang('firesale:label_title'); ?></th>
              <th class="model"><?php echo lang('firesale:label_id'); ?></th>
              <th><?php echo lang('firesale:label_quantity'); ?></th>
              <th><?php echo lang('firesale:label_price_sub'); ?></th>
              <th><?php echo lang('firesale:label_price_total'); ?></th>
            </tr>
          </thead>
          <tbody>
<?php foreach( $products AS $product ): ?>
	  	    <tr class="prod-<?php echo $product['id']; ?>">
              <td class="remove"><input type="checkbox" name="item[<?php echo $product['id']; ?>][remove]" value="1" /></td>
              <td class="image"><?php if( $product['image'] != FALSE ): ?><img src="/files/thumb/<?php echo $product['image']; ?>/100/100" alt="image" /><?php else: ?>n/a<?php endif; ?></td>
              <td class="name"><a href="/product/<?php echo $product['slug']; ?>"><?php echo $product['title']; ?></a></td>
              <td class="model"><?php echo $product['code']; ?></td>
              <td><input type="text" name="item[<?php echo $product['id']; ?>][qty]" value="<?php echo $product['qty']; ?>" /></td>
              <td class="price"><?php echo $this->settings->get('currency') . '<span>' . number_format($product['price'], 2) . '</span>'; ?></td>
              <td class="total"><?php echo $this->settings->get('currency') . '<span>' . number_format(( $product['price'] * $product['qty'] ), 2) . '</span>'; ?></td>
            </tr>
<?php endforeach; ?>
          </tbody>
        </table>
<?php elseif( isset($id) ): ?>
        <div class="no_data"><?php echo lang('firesale:prod_none'); ?></div>
<?php else: ?>
			 <div class="no_data"><?php echo lang('firesale:orders:save_first'); ?></div>
<?php endif; ?>
<?php if( isset($id) ): ?>
        <div class="items">
          <?php echo form_dropdown('add_product', $prod_drop, 0, 'id="add_product"'); ?>
          <input type="text" name="add_qty" id="add_qty" value="1" />
          <button type="submit" class="btn blue"><span>Add Product</span></button>
        </div>
<?php endif; ?>
            <br class="clear" />
		  </fieldset>
		</section>

		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>

	<?php echo form_close(); ?>
