
<section class="title">
    <h4><?php echo lang('firesale:gateways:admin_title'); ?></h4>
</section>

<section class="item">
    <dv class="content">
    <?php if ( ! empty($gateways)): ?>
        <table id="product_table">
            <thead>
                <tr>
                    <th><?php echo lang('firesale:gateways:labels:name'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                    <?php foreach ($gateways as $gateway): ?>
                        <tr>
                            <td><?php echo $gateway['name']; ?></td>
                            <td class="actions">
                                <a class="btn green" href="<?php echo site_url('admin/firesale/gateways/install/'.$gateway['slug']); ?>"><?php echo lang('global:install'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no_data"><?php echo lang('firesale:gateways:no_uninstalled_gateways'); ?></div>
    <?php endif; ?>
    </div>
</section>
