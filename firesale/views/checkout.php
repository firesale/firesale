
    <?php echo form_open(''); ?>

        <div id="checkout" class="firesale">

        <?php if( $ship_req ): ?>

            <h3 id="shipping_details"><a href="#shipping"><?php echo lang('firesale:title:ship'); ?></a></h3>
            <fieldset>

            <?php if( isset($addresses) && !empty($addresses) ): ?>

                <?php foreach( $addresses AS $key => $address): ?>
                <label for="ship_to_<?php echo $address['id']; ?>" class="order small">
                    <header>
                        <h3><?php echo $address['title']; ?></h3>
                        <span class="right"><input name="ship_to" id="ship_to_<?php echo $address['id']; ?>" type="radio" value="<?php echo $address['id']; ?>"<?php echo ( ( isset($_POST['ship_to']) && $_POST['ship_to'] == $address['id'] ) || $key == 0 ? ' checked="checked"' : '' ); ?> /></span>
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
                <input name="ship_to" id="ship_to_new" type="radio" value="new"<?php echo ( isset($_POST['ship_to']) && $_POST['ship_to'] == 'new' ? ' checked="checked"' : '' ); ?> />
                <label for="ship_to_new"><?php echo lang('firesale:addresses:new_address'); ?></label>
                <br class="clear" />

            <?php endif; ?>

                <div>
                <?php foreach( $ship_fields AS $subtitle => $section ): ?>
                    <ul class="width-half"<?php echo ( isset($addresses) && !empty($addresses) ? ' style="display: none"' : '' ); ?>>
                        <li><h2><?php echo lang('firesale:title:' . $subtitle); ?></h2></li>
                    <?php foreach( $section AS $field ): ?>
                        <li>
                            <label for="<?php echo $field['input_slug']; ?>"><?php echo lang(substr($field['input_title'], 5)); ?> <?php echo $field['required']; ?>:</label>
                            <?php echo $field['input']; ?>
                            <?php echo ( form_error($field['input_slug']) ? '<div class="error">'.form_error($field['input_slug']).'</div>' : '' ); ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
                </div>

                <br class="clear" />
                <a href="#" class="next btn"><span><?php echo lang('firesale:checkout:next'); ?></span></a>
                <br class="clear" />

            </fieldset>

        <?php endif; ?>

            <h3 id="billing_details"><a href="#billing"><?php echo lang('firesale:title:bill'); ?></a></h3>
            <fieldset>

            <?php if( isset($addresses) && !empty($addresses) ): ?>

                <?php foreach( $addresses AS $key => $address): ?>
                <label for="bill_to_<?php echo $address['id']; ?>" class="order small">
                    <header>
                        <h3><?php echo $address['title']; ?></h3>
                        <span class="right"><input name="bill_to" id="bill_to_<?php echo $address['id']; ?>" type="radio" value="<?php echo $address['id']; ?>"<?php echo ( ( isset($_POST['bill_to']) && $_POST['bill_to'] == $address['id'] ) || $key == 0  ? ' checked="checked"' : '' ); ?> /></span>
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
                <input name="bill_to" id="bill_to_new" type="radio" value="new"<?php echo ( isset($_POST['bill_to']) && $_POST['bill_to'] == 'new' ? ' checked="checked"' : '' ); ?> />
                <label for="bill_to_new"><?php echo lang('firesale:addresses:new_address'); ?></label>
                <br class="clear" />

            <?php endif; ?>

                <div>
                <?php foreach( $bill_fields AS $subtitle => $section ): ?>
                    <ul class="width-half"<?php echo ( isset($addresses) && !empty($addresses) ? ' style="display: none"' : '' ); ?>>
                        <li><h2><?php echo lang('firesale:title:' . $subtitle); ?></h2></li>
                    <?php foreach( $section AS $field ): ?>
                        <li>
                            <label for="<?php echo $field['input_slug']; ?>"><?php echo lang(substr($field['input_title'], 5)); ?> <?php echo $field['required']; ?>:</label>
                            <?php echo $field['input']; ?>
                            <?php echo ( form_error($field['input_slug']) ? '<div class="error">'.form_error($field['input_slug']).'</div>' : '' ); ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
                </div>

                <br class="clear" />
                <a href="#" class="prev btn"><span><?php echo lang('firesale:checkout:previous'); ?></span></a>
                <a href="#" class="next btn"><span><?php echo lang('firesale:checkout:next'); ?></span></a>
                <br class="clear" />

            </fieldset>

        <?php if( $ship_req && isset($shipping) && is_array($shipping) ): ?>

            <h3 id="shipping"<?php echo ( ! $valid_shipping ? ' class="error"' : '' ); ?>><a href="#shipping"><?php echo lang('firesale:checkout:title:ship_method'); ?></a></h3>
            <fieldset<?php echo ( ! $valid_shipping ? ' class="error"' : '' ); ?>>

                <p><?php echo lang('firesale:checkout:select_shipping_method'); ?></p>
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
                <a href="#" class="prev btn"><span><?php echo lang('firesale:checkout:previous'); ?></span></a>
                <a href="#" class="next btn"><span><?php echo lang('firesale:checkout:next'); ?></span></a>
                <br class="clear" />

            </fieldset>

        <?php elseif( $ship_req && isset($shipping) && (0 + $shipping ) > 0 ): ?>
            <input type="hidden" name="shipping" value="<?php echo $shipping; ?>" />

        <?php endif; ?>

            <h3 id="payment"<?php echo ( ! $valid_gateway ? ' class="error"' : '' ); ?>><a href="#payment"><?php echo lang('firesale:checkout:title:payment_method'); ?></a></h3>
            <fieldset<?php echo ( ! $valid_gateway ? ' class="error"' : '' ); ?>>

                <p><?php echo lang('firesale:checkout:select_payment_method'); ?></p>
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
                <a href="#" class="prev btn"><span><?php echo lang('firesale:checkout:previous'); ?></span></a>
                <button type="submit" name="btnAction" value="pay" class="next btn"><span><?php echo lang('firesale:checkout:submit_and_pay'); ?></span></button>
                <br class="clear" />

            </fieldset>

        </div>

    <?php echo form_close(); ?>
