
	<?php echo validation_errors(); ?>

    <?php echo form_open(''); ?>
	  
        <div id="checkout" class="firesale">

          <h3 id="shipping_details"><a href="#shipping"><?php echo lang('firesale:title:ship'); ?></a></h3>
          <fieldset>
<?php if( isset($addresses) && !empty($addresses) ): ?>
<?php foreach( $addresses AS $key => $address): ?>
            <label for="ship_to_<?php echo $address['id']; ?>" class="order small">
              <header>
                <h3><?php echo $address['title']; ?></h3>
				<span class="right"><input name="ship_to" id="ship_to_<?php echo $address['id']; ?>" type="radio" value="<?php echo $address['id']; ?>"<?php echo ( $key == 0 ? ' selected="selected"' : '' ); ?> /></span>
              </header>
              <ul>
                  <?php echo ( isset($address['firstname']) ? '<li>' . $address['firstname'] . ' ' . $address['lastname'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['address1']) ? '<li>' . $address['address1'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['address2']) ? '<li>' . $address['address2'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['city']) ? '<li>' . $address['city'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['county']) ? '<li>' . $address['county'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['postcode']) ? '<li>' . $address['postcode'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['country']['name']) ? '<li>' . $address['country']['name'] . '</li>' : '' ); ?>
              </ul>
            </label>

<?php endforeach; ?>
            <br class="clear" />
			<input name="ship_to" id="ship_to_new" type="radio" value="new" />
			<label for="ship_to_new">New Address</label>
			<br class="clear" />
<?php endif; ?>
<?php foreach( $fields AS $subtitle => $section ): ?>
            <ul class="width-half"<?php echo ( isset($addresses) && !empty($addresses) ? ' style="display: none"' : '' ); ?>>
              <li><h2><?php echo lang('firesale:title:' . $subtitle); ?></h2></li>
<?php foreach( $section AS $field ): ?>
              <li>
                <label for="<?php echo $field['input_slug']; ?>"><?php echo lang(substr($field['input_title'], 5)); ?> <?php echo $field['required']; ?>:</label>
                <?php echo str_replace(array('id="', 'name="'), array('id="ship_', 'name="ship_'), $field['input']); ?>
              </li>
<?php endforeach; ?>
            </ul>
<?php endforeach; ?>
            <br class="clear" />
            <a href="#billing_details" class="next btn"><span>Next</span></a>
            <br class="clear" />
          </fieldset>

          <h3 id="billing_details"><a href="#billing"><?php echo lang('firesale:title:bill'); ?></a></h3>
          <fieldset>
<?php if( isset($addresses) && !empty($addresses) ): ?>
<?php foreach( $addresses AS $key => $address): ?>
            <label for="bill_to_<?php echo $address['id']; ?>" class="order small">
              <header>
                <h3><?php echo $address['title']; ?></h3>
				<span class="right"><input name="bill_to" id="bill_to_<?php echo $address['id']; ?>" type="radio" value="<?php echo $address['id']; ?>"<?php echo ( $key == 0 ? ' selected="selected"' : '' ); ?> /></span>
              </header>
              <ul>
                  <?php echo ( isset($address['firstname']) ? '<li>' . $address['firstname'] . ' ' . $address['lastname'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['address1']) ? '<li>' . $address['address1'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['address2']) ? '<li>' . $address['address2'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['city']) ? '<li>' . $address['city'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['county']) ? '<li>' . $address['county'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['postcode']) ? '<li>' . $address['postcode'] . '</li>' : '' ); ?>
                  <?php echo ( isset($address['country']['name']) ? '<li>' . $address['country']['name'] . '</li>' : '' ); ?>
              </ul>
            </label>

<?php endforeach; ?>
            <br class="clear" />
			<input name="bill_to" id="bill_to_new" type="radio" value="new" />
			<label for="bill_to_new">New Address</label>
			<br class="clear" />
<?php endif; ?>
<?php foreach( $fields AS $subtitle => $section ): ?>
            <ul class="width-half"<?php echo ( isset($addresses) && !empty($addresses) ? ' style="display: none"' : '' ); ?>>
              <li><h2><?php echo lang('firesale:title:' . $subtitle); ?></h2></li>
<?php foreach( $section AS $field ): ?>
              <li>
                <label for="<?php echo $field['input_slug']; ?>"><?php echo lang(substr($field['input_title'], 5)); ?> <?php echo $field['required']; ?>:</label>
                <?php echo str_replace(array('id="', 'name="'), array('id="bill_', 'name="bill_'), $field['input']); ?>
              </li>
<?php endforeach; ?>
            </ul>
<?php endforeach; ?>
            <br class="clear" />
            <a href="#shipping_details" class="prev btn"><span>Previous</span></a>
            <a href="#shipping" class="next btn"><span>Next</span></a>
            <br class="clear" />
          </fieldset>

<?php if( isset($shipping) && is_array($shipping) ): ?>
          <h3 id="shipping"><a href="#shipping"><?php echo lang('firesale:checkout:title:ship_method'); ?></a></h3>
          <fieldset>
            <p>Please select your preferred shipping method below before continuing</p>
            <br />
            <ul class="shipping">
<?php foreach( $shipping AS $key => $option ): ?>
              <li>
                <input type="radio" name="shipping" id="shipping" value="<?php echo $option['id']; ?>" <?php echo ( $key == 0 ? 'checked="checked" ' : '' ); ?>/>
                <label for="shipping"><strong><?php echo $option['title']; ?></strong> - {{ settings:currency }} <?php echo $option['price']; ?><br /><?php echo $option['description']; ?></label>
              </li>
<?php endforeach; ?>
            </ul>
            <br class="clear" />
            <a href="#billing_details" class="prev btn"><span>Previous</span></a>
            <a href="#payment" class="next btn"><span>Next</span></a>
            <br class="clear" />
          </fieldset>

<?php elseif( isset($shipping) && (0 + $shipping ) > 0 ): ?>
          <input type="hidden" name="shipping" value="<?php echo $shipping; ?>" />

<?php endif; ?>
          <h3 id="payment"><a href="#payment"><?php echo lang('firesale:checkout:title:payment_method'); ?></a></h3>
          <fieldset>
            <p>Please select your preferred payment method below before continuing</p>
            <br />
            <ul>
<?php foreach( $this->gateways->get_enabled() as $gateway_id => $gateway ): ?>
              <li>
                <label for="gateway_<?php echo $gateway_id; ?>"><strong><?php echo $gateway['name']; ?></strong></label>
                <input type="radio" name="gateway" id="gateway_<?php echo $gateway_id; ?>" value="<?php echo $gateway_id; ?>" <?php echo set_radio('gateway', $gateway_id); ?> />
              </li>
<?php endforeach; ?>
            </ul>
            <br class="clear" />
            <a href="#shipping" class="prev btn"><span>Previous</span></a>
            <button type="submit" name="btnAction" value="pay" class="next btn"><span>Submit &amp; Pay</span></button>
            <br class="clear" />
          </fieldset>

        </div>          
	  
      <?php echo form_close(); ?>
