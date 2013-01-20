<?php echo form_open(); ?>
    <?php echo form_hidden('email', $this->current_user->email); ?>
    <p>Payment processing is done on the eWAY website, so if you're happy with everything please click below to finalise your order!</p>
    <button type="submit" class="btn"><span>Pay with eWAY</span></button>
<?php echo form_close();
