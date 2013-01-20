
    <li class="<?php echo alternator('even', ''); ?>">
        <label for="design_layout">Layout <span>*</span></label>
        <div class="input">
            <?php echo form_dropdown('design_layout', $layouts, null, 'id="design_layout"'); ?>
        </div>
    </li>
