
	<div class="buy_now">
		<?php echo form_open($this->uri->uri_string()); ?>
			<input type="hidden" name="product" value="<?php echo $product['id']; ?>" />
			<img src="<?php echo site_url('files/thumb/'.$product['image'].'/160/160'); ?>" alt="<?php echo $product['title']; ?>" />
			<p><?php echo truncate_words(strip_tags($product['description']), 400); ?></p>
			<button type="submit" name="btnAction" value="buy_now"><?php echo sprintf(lang('firesale:label_buy_now_for'), $product['price_formatted']); ?></button>
			<div class="clearfix"></div>
		<?php echo form_close(); ?>
	</div>
