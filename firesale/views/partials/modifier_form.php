    <?php echo form_open("{{ firesale:url route='cart' base='no' }}/insert"); ?>
        <input type="hidden" name="prd_code[0]" value="<?php echo $product['id']; ?>" />
        <fieldset>
            <ul>
            <?php if( ! empty($modifiers) ): ?>
            <?php foreach( $modifiers as $modifier ): ?>
                <li>
                    <label>
                        <?php echo $modifier['title']; ?>
                        <small><?php echo $modifier['instructions']; ?></small>
                    </label>
                    <div class="input">
                    <?php if( $modifier['type']['key'] != '2' ): ?>
                    <?php if( $type == 'select' ): ?>
                        <select name="options[0][<?php echo $modifier['id']; ?>]">
                    <?php endif; ?>
                    <?php foreach( $modifier['variations'] as $variation ): ?>
                    <?php if( $type == 'radio' ): ?>
                        <input type="radio" name="options[0][<?php echo $modifier['id']; ?>]" id="options_<?php echo $variation['id']; ?>" value="<?php echo $variation['id']; ?>" <?php echo $variation['selected']; ?>/>
                        <label for="options_<?php echo $variation['id']; ?>"><?php echo $variation['title']; ?> (<?php echo $variation['difference']; ?>)</label>
                    <?php else: ?>
                            <option <?php echo $variation['selected']; ?>value="<?php echo $variation['id']; ?>"><?php echo $variation['title']; ?> (<?php echo $variation['difference']; ?>)</option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if( $type == 'select' ): ?>
                        </select>
                    <?php endif; ?>
                    <?php else: ?>
                        <textarea name="options[0][<?php echo $modifier['id']; ?>]"></textarea>
                    <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>
                <li>
                    <label for="product_quantity"><?php echo lang('firesale:product:label_qty'); ?></label>
                    <div class="input">
                        <input id="product_quantity" name="qty[0]" size="3" value="1" type="text" />
                    </div>
                </li>
            </ul>

            <div class="buttons">
                <button type="submit" name="btnAction" value="cart"><?php echo lang('firesale:product:label_add_to_cart'); ?></button>
            </div>

        </fieldset>
    <?php echo form_close(); ?>
