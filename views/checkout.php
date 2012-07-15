<?php echo form_open(); ?>

<?php echo validation_errors(); ?>

<h2><?php echo lang('firesale:checkout:title:bill_details'); ?></h2>

<ul>
	<li>
		<label for="bill_company"><?php echo lang('firesale:checkout:form:bill_company'); ?></label>
		<input name="bill_company" id="bill_company" value="<?php echo set_value('bill_company', isset($customer_info['bill_company']) ? $customer_info['bill_company'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_firstname"><?php echo lang('firesale:checkout:form:bill_firstname'); ?></label>
		<input name="bill_firstname" id="bill_firstname" value="<?php echo set_value('bill_firstname', isset($customer_info['bill_firstname']) ? $customer_info['bill_firstname'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_lastname"><?php echo lang('firesale:checkout:form:bill_lastname'); ?></label>
		<input name="bill_lastname" id="bill_lastname" value="<?php echo set_value('bill_lastname', isset($customer_info['bill_lastname']) ? $customer_info['bill_lastname'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_phone"><?php echo lang('firesale:checkout:form:bill_phone'); ?></label>
		<input name="bill_phone" id="bill_phone" value="<?php echo set_value('bill_phone', isset($customer_info['bill_phone']) ? $customer_info['bill_phone'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_email"><?php echo lang('firesale:checkout:form:bill_email'); ?></label>
		<input name="bill_email" id="bill_email" value="<?php echo set_value('bill_email', isset($customer_info['bill_email']) ? $customer_info['bill_email'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_address1"><?php echo lang('firesale:checkout:form:bill_address1'); ?></label>
		<input name="bill_address1" id="bill_address1" value="<?php echo set_value('bill_address1', isset($customer_info['bill_address1']) ? $customer_info['bill_address1'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_address2"><?php echo lang('firesale:checkout:form:bill_address2'); ?></label>
		<input name="bill_address2" id="bill_address2" value="<?php echo set_value('bill_address2', isset($customer_info['bill_address2']) ? $customer_info['bill_address2'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_city"><?php echo lang('firesale:checkout:form:bill_city'); ?></label>
		<input name="bill_city" id="bill_city" value="<?php echo set_value('bill_city', isset($customer_info['bill_city']) ? $customer_info['bill_city'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_postcode"><?php echo lang('firesale:checkout:form:bill_postcode'); ?></label>
		<input name="bill_postcode" id="bill_postcode" value="<?php echo set_value('bill_postcode', isset($customer_info['bill_postcode']) ? $customer_info['bill_postcode'] : NULL); ?>">
	</li>
	<li>
		<label for="bill_country"><?php echo lang('firesale:checkout:form:bill_country'); ?></label>
		<input name="bill_country" id="bill_country" value="<?php echo set_value('bill_country', isset($customer_info['bill_country']) ? $customer_info['bill_country'] : NULL); ?>">
	</li>
</ul>

<h2><?php echo lang('firesale:checkout:title:ship_details'); ?></h2>

<ul>
	<li>
		<label for="ship_company"><?php echo lang('firesale:checkout:form:ship_company'); ?></label>
		<input name="ship_company" id="ship_company" value="<?php echo set_value('ship_company', isset($customer_info['ship_company']) ? $customer_info['ship_company'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_firstname"><?php echo lang('firesale:checkout:form:ship_firstname'); ?></label>
		<input name="ship_firstname" id="ship_firstname" value="<?php echo set_value('ship_firstname', isset($customer_info['ship_firstname']) ? $customer_info['ship_firstname'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_lastname"><?php echo lang('firesale:checkout:form:ship_lastname'); ?></label>
		<input name="ship_lastname" id="ship_lastname" value="<?php echo set_value('ship_lastname', isset($customer_info['ship_lastname']) ? $customer_info['ship_lastname'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_phone"><?php echo lang('firesale:checkout:form:ship_phone'); ?></label>
		<input name="ship_phone" id="ship_phone" value="<?php echo set_value('ship_phone', isset($customer_info['ship_phone']) ? $customer_info['ship_phone'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_email"><?php echo lang('firesale:checkout:form:ship_email'); ?></label>
		<input name="ship_email" id="ship_email" value="<?php echo set_value('ship_email', isset($customer_info['ship_email']) ? $customer_info['ship_email'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_address1"><?php echo lang('firesale:checkout:form:ship_address1'); ?></label>
		<input name="ship_address1" id="ship_address1" value="<?php echo set_value('ship_address1', isset($customer_info['ship_address1']) ? $customer_info['ship_address1'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_address2"><?php echo lang('firesale:checkout:form:ship_address2'); ?></label>
		<input name="ship_address2" id="ship_address2" value="<?php echo set_value('ship_address2', isset($customer_info['ship_address2']) ? $customer_info['ship_address2'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_city"><?php echo lang('firesale:checkout:form:ship_city'); ?></label>
		<input name="ship_city" id="ship_city" value="<?php echo set_value('ship_city', isset($customer_info['ship_city']) ? $customer_info['ship_city'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_postcode"><?php echo lang('firesale:checkout:form:ship_postcode'); ?></label>
		<input name="ship_postcode" id="ship_postcode" value="<?php echo set_value('ship_postcode', isset($customer_info['ship_postcode']) ? $customer_info['ship_postcode'] : NULL); ?>">
	</li>
	<li>
		<label for="ship_country"><?php echo lang('firesale:checkout:form:ship_country'); ?></label>
		<input name="ship_country" id="ship_country" value="<?php echo set_value('ship_country', isset($customer_info['ship_country']) ? $customer_info['ship_country'] : NULL); ?>">
	</li>
</ul>

<h2><?php echo lang('firesale:checkout:title:payment_method'); ?></h2>

<ul>
	<li>
		<?php foreach ($this->gateways->get_enabled() as $gateway_id => $gateway): ?>
			<input type="radio" name="gateway" id="gateway" value="<?php echo $gateway_id; ?>" <?php echo set_radio('gateway', $gateway_id); ?>> <label for="gateway"><?php echo $gateway['name']; ?></label>
		<?php endforeach; ?>
	</li>
</ul>

<?php echo form_submit(NULL, 'Submit & Pay'); ?>

<?php echo form_close(); ?>
