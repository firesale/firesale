<?php echo form_open(); ?>
	<?php echo form_hidden('return_url', site_url('firesale/cart/payment')); ?>
	<?php echo form_hidden('cancel_url', site_url('firesale/cart/cancel')); ?>
	<?php echo form_hidden('reference', 'Test Order'); ?>
	<?php echo form_hidden('currency_code', $this->settings->get('firesale_currency')); ?>
	<?php echo form_hidden('transaction_id', $this->session->userdata('order_id')); ?>
	
	<p>Payment processing is done on the eWAY website, so if you're happy with everything please click below to finalise your order!</p>
	<button type="submit" class="btn"><span>Pay with eWAY</span></button>
<?php echo form_close(); ?>
