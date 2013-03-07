<?php echo form_open(); ?>
    <label>Name on Card: </label> <?php echo form_input('name'); ?>
    <label>Card Type: </label> <?php echo form_dropdown('card_type', $default_cards); ?>
    <label>Card No: </label> <?php echo form_input('card_no', '4111111111111111'); ?>
    <label>Expiry date: </label> <?php echo form_dropdown('exp_month', $months); ?>
    <?php echo form_dropdown('exp_year', $years); ?>

    <label>CSC: </label> <?php echo form_input('csc'); ?>
    <button type="submit" class="btn"><span>Process Dummy Payment</span></button>
<?php echo form_close();
