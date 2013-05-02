
    <section class="title">
        <h4><?php echo lang('firesale:sections:brands'); ?></h4>
    </section>

    <section class="item">
        <div class="content">
        <?php if ($brands['total'] > 0 ): ?>

            <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 25px"><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
                            <th style="width: 40px">&nbsp;</th>
                            <th><?php echo lang('firesale:label_title'); ?></th>
                            <th><?php echo lang('firesale:label_slug'); ?></th>
                            <th><?php echo lang('firesale:label_status'); ?></th>
                            <th><?php echo lang('firesale:label_description'); ?></th>
                            <th style="width: 130px"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($brands['entries'] as $brand ): ?>
                        <tr>
                            <td><input type="checkbox" name="action_to[]" value="<?php echo $brand['id']; ?>"  /></td>
                            <td class="img"><img src="<?php echo ( $brand['image'] ? site_url('files/thumb/' . $brand['image']->id . '/32/32') : '' ); ?>" alt="Brand Image" /></td>
                            <td><?php echo $brand['title']; ?></td>
                            <td><?php echo $brand['slug']; ?></td>
                            <td><?php echo $brand['status']['value']; ?></td>
                            <td><?php echo $brand['description']; ?></td>
                            <td>
                                <?php echo anchor('admin/firesale_brands/edit/' . $brand['id'], lang('global:edit'), 'class="btn orange edit"'); ?>
                                <?php echo anchor('admin/firesale_brands/delete/' . $brand['id'], lang('global:delete'), array('class' => 'confirm btn red delete')); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="table_action_buttons">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
                </div>

            <?php echo form_close(); ?>

        <?php else: ?>
            <div class="no_data"><?php echo lang('firesale:brands:none'); ?></div>
        <?php endif;?>
        </div>
    </section>
