
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud form_inputs" id="var_form"'); ?>

        <?php if( validation_errors() ): ?>
            <?php echo '<div class="alert error"><p>'.validation_errors().'</p></div>'; ?>
        <?php endif; ?>

        <fieldset>
            <ul>
            <?php foreach( $fields as $input ): ?>
                <li class="<?php echo alternator('even', ''); ?>">
                    <label for="<?php echo $input['input_slug']; ?>">
                        <?php echo lang(substr($input['input_title'], 5)) ? lang(substr($input['input_title'], 5)) : $input['input_title']; ?> <?php echo $input['required']; ?>
                        <small><?php echo lang(substr($input['instructions'], 5)) ? lang(substr($input['instructions'], 5)) : $input['instructions']; ?></small>
                    </label>
                    <div class="input"><?php echo $input['input']; ?></div>
                </li>
            <?php endforeach; ?>
            </ul>
        </fieldset>

        <div class="buttons">
            <button type="submit" name="btnAction" value="save" class="btn blue"><span><?php echo lang('save_label'); ?></span></button>
        <?php if( $id != null ): ?>
            <button type="submit" name="btnAction" value="delete" class="btn red confirm"><span><?php echo lang('global:delete'); ?></span></button>
        <?php endif; ?>
            <a href="#" class="btn gray cancel"><?php echo lang('cancel_label'); ?></a>
        </div>

    <?php echo form_close(); ?>

<?php if( $parent->type == '3' ): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#colorbox select[name=product]').change(function() {
                $('#colorbox input[name=title]').val($(this).find(':selected').html());
            });
        });
    </script>
<?php endif; ?>
