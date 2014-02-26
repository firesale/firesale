
    <input type="hidden" name="design_type" value="<?=$type; ?>" />

    <li class="<?php echo alternator('even', ''); ?>">
        <label for="design_enabled"><?=lang('firesale:design:label_enable'); ?> <span>*</span></label>
        <div class="input">
            <input type="checkbox" name="design_enabled" id="design_enabled" value="1" <?=( $design && $design['enabled'] == '1' ? 'checked="checked" ' : '' ); ?>/>
        </div>
    </li>

    <li class="fs_design <?php echo alternator('even', ''); ?>">
        <label for="design_layout"><?=lang('firesale:design:label_layout'); ?> <span>*</span></label>
        <div class="input">
            <?php echo form_dropdown('design_layout', $layouts, ( $design ? $design['layout'] : 'default.html' ), 'id="design_layout"'); ?>
        </div>
    </li>

    <li class="fs_design <?php echo alternator('even', ''); ?>">
        <label for="design_view"><?=lang('firesale:design:label_view'); ?> <span>*</span></label>
        <div class="input">
            <?php echo form_dropdown('design_view', $views, ( $design ? $design['view'] : $type.'.php' ), 'id="design_view"'); ?>
        </div>
    </li>
