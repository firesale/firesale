
    <section class="title">
        <h4><?php echo sprintf(lang('firesale:routes:edit'), ( substr($row->title, 0, 5) == 'lang:' ? lang(substr($row->title, 5)) : $row->title )); ?></h4>
    </section>

    <section class="item form_inputs">
        <div class="content">

            <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>

                <fieldset>
                    <ul>
                    <?php foreach( $fields AS $input ): ?>
                        <li class="<?php echo alternator('even', ''); ?>">
                            <label for="<?php echo $input['input_slug']; ?>">
                                <?php echo lang(substr($input['input_title'], 5)); ?>  <?php echo $input['required']; ?>
                                <small><?php echo lang(substr($input['instructions'], 5)); ?></small>
                            </label>
                            <div class="input"><?php echo $input['input']; ?></div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </fieldset>

                <div class="buttons">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
                </div>

            <?php echo form_close(); ?>

        </div>
    </section>
