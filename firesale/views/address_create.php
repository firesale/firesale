<?php echo form_open_multipart(uri_string(), 'class="streams_form"'); ?>

    <?php if ($mode == 'edit') { ?><input type="hidden" value="<?php echo $entry->id;?>" name="row_edit_id" /><?php } ?>

    <div class="form_inputs">

        <ul>

        <?php foreach ($fields as $field) { ?>

            <li>
                <label for="<?php echo $field['input_slug'];?>"><?php echo $this->fields->translate_label($field['input_title']); ?> <?php echo $field['required'];?>

                <?php if( $field['instructions'] != '' ): ?>
                    <br /><small><?php echo $field['instructions']; ?></small>
                <?php endif; ?>
                </label>

                <div class="input"><?php echo $field['input']; ?></div>
            </li>

        <?php } ?>

        </ul>

    </div>

    <button type="submit" name="btnAction" value="save" class="btn blue"><span><?php echo lang('firesale:addresses:save'); ?></span></button>
    <a href="{{ firesale:url route="addresses" }}" class="btn"><span><?php echo lang('firesale:addresses:cancel'); ?></span></a>

<?php echo form_close();
