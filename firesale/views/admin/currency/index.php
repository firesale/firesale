
    <section class="title">
        <h4><?php echo lang('firesale:sections:currency'); ?></h4>
    </section>

    <section class="item">
        <div class="content">
        <?php if ($currencies['total'] > 0 ): ?>

            <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>

            <table>
                <thead>
                    <tr>
                        <th style="width: 15px"><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
                        <th><?php echo lang('firesale:label_title'); ?></th>
                        <th><?php echo lang('firesale:label_slug'); ?></th>
                        <th><?php echo lang('firesale:label_cur_code'); ?></th>
                        <th><?php echo lang('firesale:label_cur_mod'); ?></th>
                        <th><?php echo lang('firesale:label_exch_rate'); ?></th>
                        <th><?php echo lang('firesale:label_cur_tax'); ?></th>
                        <th style="width: 140px"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($currencies['entries'] as $currency ): ?>
                    <tr>
                        <td><?php if( $currency['id'] != $default ): ?><input type="checkbox" name="action_to[]" value="<?php echo $currency['id']; ?>"  /><?php endif; ?></td>
                        <td><?php echo $currency['title']; ?></td>
                        <td><?php echo $currency['slug']; ?></td>
                        <td><?php echo $currency['cur_code']; ?></td>
                        <td><?php echo str_replace('|', ' ', $currency['cur_mod']); ?></td>
                        <td><?php echo $currency['exch_rate']; ?></td>
                        <td><?php echo number_format($currency['cur_tax'], 2).'%'; ?></td>
                        <td><center>
                            <a href="<?php echo site_url('admin/firesale/currency/edit/'.$currency['id']); ?>" class="btn blue"><?php echo lang('global:edit'); ?></a>
                        <?php if( $currency['id'] != $default ): ?>
                        <?php if( $currency['enabled']['key'] == '1' ): ?>
                            <a href="<?php echo site_url('admin/firesale/currency/disable/'.$currency['id']); ?>" class="btn orange"><?php echo lang('firesale:currency:disable'); ?></a>
                        <?php else: ?>
                            <a href="<?php echo site_url('admin/firesale/currency/enable/'.$currency['id']); ?>" class="btn green"><?php echo lang('firesale:currency:enable'); ?></a>
                        <?php endif; ?>
                            <a href="<?php echo site_url('admin/firesale/currency/delete/'.$currency['id']); ?>" class="btn red confirm" title="<?php echo lang('firesale:currency:delete_warn'); ?>"><?php echo lang('global:delete'); ?></a>
                        <?php endif; ?>
                        </center></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <br />
            <div class="table_action_buttons">
                <button class="btn green" name="btnAction" value="enable"><span><?php echo lang('firesale:currency:enable'); ?></span></button>
                <button class="btn orange confirm" name="btnAction" value="disable" title="<?php echo lang('firesale:currency:disable_warn'); ?>"><span><?php echo lang('firesale:currency:disable'); ?></span></button>
                <button class="btn red confirm" name="btnAction" value="delete" title="<?php echo lang('firesale:currency:delete_warn'); ?>"><span><?php echo lang('firesale:currency:delete'); ?></span></button>
            </div>

            <?php echo form_close(); ?>

        <?php else: ?>
            <div class="no_data"><?php echo lang('firesale:currency:none'); ?></div>
        <?php endif;?>
        </div>
    </section>
