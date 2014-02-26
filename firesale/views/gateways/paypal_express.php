<?php echo form_open(); ?>

    <p>{{ helper:lang line="firesale:checkout:paypal:before_checkout" }} !</p>

    <input type="hidden" name="return_url" value="<?php echo site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/success/paypal_express'); ?>" />

    <button type="submit" class="btn"><span>{{ helper:lang line="firelase:checkout:paypal_expr:checkout" }}</span></button>

<?php echo form_close();
