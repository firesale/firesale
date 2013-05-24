
    <section class="title">
        <?php if( isset($id) AND $id > 0 ): ?>
            <h4><?php echo sprintf(lang('firesale:shipping:edit'), $title); ?></h4>
        <?php else: ?>
            <h4><?php echo lang('firesale:shipping:create'); ?></h4>
        <?php endif; ?>
    </section>

    <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>

        <section class="item form_inputs">
            <div class="content">
                <fieldset>
                    <ul>
                    <?php foreach( $fields AS $input ): ?>
                        <li class="<?php echo alternator('even', ''); ?>">
                            <label for="<?php echo $input['input_slug']; ?>"><?php echo lang(substr($input['input_title'], 5)) ? lang(substr($input['input_title'], 5)) : $input['input_title']; ?> <?php echo $input['required']; ?></label>
                            <div class="input"><?php echo $input['input']; ?></div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </fieldset>
                <div class="buttons">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
                </div>
            </div>
        </section>

    <?php echo form_close(); ?>
