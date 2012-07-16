
<?php if( isset($id) && $id > 0 ): ?>
	<h1><?php echo sprintf(lang('firesale:orders:title_edit'), $id); ?></h1>
<?php else: ?>
	<h1><?php echo lang('firesale:orders:title_create'); ?></h1>
<?php endif; ?>

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>

		<section class="title">
			<h4>&nbsp;</h4>
			<ul>
              <li><a href="#products">Products</a></li>
<?php foreach( $tabs AS $tab ): ?>
              <li><a href="#<?php echo $tab; ?>"><?php echo lang('firesale:title:' . $tab); ?></a></li>
<?php endforeach; ?>
			</ul>
		</section>

<?php foreach( $fields AS $title => $sections ): ?>
		<section class="item form_inputs" id="<?php echo $title; ?>">
		  <fieldset>
<?php foreach( $sections AS $subtitle => $section ): ?>
            <ul<?php echo ( $title != 'general' ? ' class="width-half"' : '' ); ?>>
<?php foreach( $section AS $field ): ?>
              <li>
                <label for="<?php echo $field['input_slug']; ?>"><?php echo $field['input_title']; ?> <?php echo $field['required']; ?>:</label>
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
              <th class="remove">Remove</th>
              <th class="image">Image</th>
              <th class="name">Name</th>
              <th class="model">Model</th>
              <th>Quanity</th>
              <th>Unit Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
<?php foreach( $products AS $product ): ?>
	  	    <tr>
              <td class="remove"><input type="checkbox" name="item[<?php echo $product['id']; ?>][remove]" value="1" /></td>
              <td class="image"><?php if( $product['image'] != FALSE ): ?><img src="/files/thumb/<?php echo $product['image']; ?>/100/100" alt="image" /><?php else: ?>n/a<?php endif; ?></td>
              <td class="name"><a href="/product/<?php echo $product['slug']; ?>"><?php echo $product['title']; ?></a></td>
              <td class="model"><?php echo $product['code']; ?></td>
              <td><input type="text" name="item[<?php echo $product['id']; ?>][qty]" value="<?php echo $product['qty']; ?>" /></td>
              <td><?php echo $this->settings->get('currency') . number_format($product['price'], 2); ?></td>
              <td><?php echo $this->settings->get('currency') . number_format(( $product['price'] * $product['qty'] ), 2); ?></td>
            </tr>
<?php endforeach; ?>
          </tbody>
        </table>
<?php else: ?>
			<div class="no_data"><?php echo lang('firesale:prod_none'); ?></div>
<?php endif; ?>
            <br class="clear" />
		  </fieldset>
		</section>

		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>

	<?php echo form_close(); ?>
