<?php echo form_open(uri_string(), 'class="crud"'); ?>

    <section class="title">
        <h4><?php echo lang('firesale:taxes:'.$type); ?></h4>
    </section>

    <section class="item form_inputs">
        <div class="content">

            <div class="tabs">

                <ul class="tab-menu">
                <?php foreach ($tabs as $tab): ?>
                    <li><a href="#<?php echo strtolower(str_replace(' ', '', $tab)); ?>"><span><?php echo lang('firesale:tabs:'.$tab); ?></span></a></li>
                <?php endforeach; ?>
                </ul>

            <?php foreach ($fields as $slug => $field): ?>
                <div id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>" class="form_inputs">
                    <fieldset>
                        <ul>
                        <?php foreach ($field as $input): ?>
                            <li class="<?php echo alternator('even', ''); ?>">
                                <label for="<?php echo $input['input_slug']; ?>">
                                    <?php echo lang(substr($input['input_title'], 5)) ? lang(substr($input['input_title'], 5)) : $input['input_title']; ?><?php echo $input['required']; ?>
                                    <small><?php echo lang(substr($input['instructions'], 5)) ? lang(substr($input['instructions'], 5)) : $input['instructions']; ?></small>
                                </label>
                                <div class="input"><?php echo $input['input']; ?></div>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </fieldset>
                </div>
            <?php endforeach; ?>

            </div>

            <div class="buttons">
                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
            </div>

        </div>
    </section>
<?php echo form_close();
