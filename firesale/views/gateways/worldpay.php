<?php echo form_open(); ?>
	<?php echo form_hidden('return_url', site_url('firesale/cart/payment')); ?>
	<?php echo form_hidden('reference', 'Test Order'); ?>
	<?php echo form_hidden('currency_code', 'GBP'); ?>
	<?php echo form_hidden('amount', $this->cart->total); ?>
	<p>Payment processing is done on the WorldPay website, so if you're happy with everything please click below to finalise your order!</p>
	<button type="submit" class="btn"><span>Pay with WorldPay</span></button>
<?php echo form_close(); ?>
