<?php echo form_open(); ?>
	<label>Name on Card: </label> <?php echo form_input('card_name'); ?>
	<label>Card Type: </label> <?php echo form_dropdown('card_type', array('visa' => 'Visa')); ?>
	<label>Card No: </label> <?php echo form_input('card_no'); ?>
	<label>Expiry date: </label> <?php echo form_dropdown('exp_month', $months); ?>
	<?php echo form_dropdown('exp_year', array('2012' => '2012', '2013' => '2013', '2014' => '2014', '2015' => '2015')); ?>
	
	<label>CSC: </label> <?php echo form_input('csc'); ?>
	<?php echo form_hidden('transaction_id', $this->session->userdata('order_id')); ?>
	<?php echo form_hidden('reference', 'Test Order'); ?>
	<?php echo form_hidden('currency_code', $this->settings->get('firesale_currency')); ?>
	<?php echo form_hidden('amount', $this->fs_cart->total); ?>
	
	<button type="submit" class="btn"><span>Pay by Card</span></button>
<?php echo form_close(); ?>
