<?php echo form_open(); ?>
	<?php echo form_hidden('return_url', site_url('firesale/cart/success').'?action=success'); ?>
	<?php echo form_hidden('cancel_url', site_url('firesale/cart/cancel')); ?>
	<?php echo form_hidden('notify_url', site_url('firesale/cart/callback/paypal/'.$this->session->userdata('order_id')).'?action=ipn'); ?>
	<?php echo form_hidden('reference', 'Order #'.$this->session->userdata('order_id')); ?>
	<?php echo form_hidden('currency_code', $this->settings->get('firesale_currency')); ?>
	<?php echo form_hidden('amount', $this->fs_cart->total); ?>
	<p>Payment processing is done on the PayPal website, so if you're happy with everything please click below to finalise your order!</p>
	<button type="submit" class="btn"><span>Pay with PayPal</span></button>
<?php echo form_close(); ?>
