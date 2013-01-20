<?php echo form_open(uri_string(), 'class="crud"'); ?>

    <section class="title">
        <h4><?php echo lang('firesale:shortcuts:assign_taxes'); ?></h4>
    </section>

    <section class="item form_inputs">
        <div class="content">
            <div class="form_inputs">
                <table id="tax_assignments">
                    <thead>
                        <tr>
                            <th class="spacer" style="width:100px"></th>
                            <?php foreach ($taxes as $tax): ?>
                                <th style="width: <?php echo ( 90 / count($taxes) ); ?>%" id="<?php echo $tax['id']; ?>" data-delete="<?php echo ( $tax['can_delete'] ? '1' : '0' ); ?>" data-title="<?php echo $tax['title']; ?>">
                                    <?php echo $tax['title']; ?>
                                    <div class="actions"></div>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($currencies as $currency): ?>
                            <tr>
                                <td><strong><?php echo $currency['title']; ?> (<?php echo $currency['cur_code']; ?>)</strong></td>
                                <?php foreach ($currency['taxes'] as $tax): ?>
                                    <td><?php echo form_input('assignment[' . $currency['id'] . '][' . $tax['id'] . ']', $tax['value']); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br />
            <div class="buttons">
                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save') )); ?>
            </div>
        </div>
    </section>
<?php echo form_close();
