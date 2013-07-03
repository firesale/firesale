    <?php echo form_open("{{ firesale:url route='cart' base='no' }}/insert", 'id="modifier_form"'); ?>
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
                        <select name="options[0][<?php echo $modifier['id']; ?>]" data-id="<?php echo $modifier['id']; ?>">
                    <?php endif; ?>
                    <?php foreach( $modifier['variations'] as $variation ): ?>
                    <?php if( $type == 'radio' ): ?>
                        <input type="radio" name="options[0][<?php echo $modifier['id']; ?>]" id="options_<?php echo $variation['id']; ?>" value="<?php echo $variation['id']; ?>" <?php echo $variation['selected']; ?>/>
                        <label for="options_<?php echo $variation['id']; ?>"><?php echo $variation['title']; ?> (<?php echo ( $difference == 'difference' ? $variation['difference'] : $variation['product']['price_formatted'] ); ?>)</label>
                    <?php else: ?>
                    >
                            <option <?php echo $variation['selected']; ?>value="<?php echo $variation['id']; ?>"><?php echo $variation['title']; ?> (<?php echo ( $difference == 'difference' ? $variation['difference'] : $variation['product']['price_formatted'] ); ?>)</option>
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

    <script type="text/javascript">
    var modifier_vars = <?php echo $jsdata; ?>;
    $(function() {
        var obj = $('#modifier_form select'), img = $('.product-images .main a').html();
        obj.change(function() {
            var t = $(this), size = obj.length, i = 1, key = '', keys = {};
            obj.each(function() {
                if ( i == size ) { $(this).children().each(function() { var data = modifier_vars[key+$(this).val()]; if ( data[5] != '6' && parseInt(data[4]) <= 0 ) { $(this).addClass('disabled'); } else { $(this).removeClass('disabled'); } }); }
                key += $(this).val(); i++;
            });
            var data = modifier_vars[key];
            $('.price-round .price').html(data[1]);
            $('.availability span').html(data[6]+' ('+data[4]+')');
            $('.prodid span').html(data[2]);
            $('.price-round .rrp').html(( parseInt(data[0].replace(/[^\d.-]/g, '')) > parseInt(data[1].replace(/[^\d.-]/g, '')) ? data[0] : '' ));
            if ( data[5] != '6' && parseInt(data[4]) <= 0 ) { $('#modifier_form button').addClass('disabled').attr('disabled', 'disabled'); } else { $('#modifier_form button').removeClass('disabled').removeAttr('disabled'); }
            if ( data[7] != false ) { $('.product-images .main a').html('<img src="/files/thumb/'+data[7]+'/332/332" alt="image" />'); } else { $('.product-images .main a').html(img); }
        }).first().change();
    });
    </script>
