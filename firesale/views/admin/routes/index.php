
    <section class="title">
        <h4><?php echo lang('firesale:sections:routes'); ?></h4>
    </section>

    <section class="item">
        <div class="content">
        <?php if ($routes['total'] > 0 ): ?>

            <table id="routes">
                <thead>
                    <tr>
                        <th style="width: 26px"></th>
                        <th><?php echo lang('firesale:label_title'); ?></th>
                        <th><?php echo lang('firesale:label_https'); ?></th>
                        <th><?php echo lang('firesale:label_slug'); ?></th>
                        <th><?php echo lang('firesale:label_route'); ?></th>
                        <th><?php echo lang('firesale:label_translation'); ?></th>
                        <th style="width: 125px">&nbsp;</th>
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
                    <?php foreach($routes['entries'] as $route ): ?>
                    <tr id="route_<?php echo $route['id']; ?>">
                        <td><span class="mover"></span></td>
                        <td><?php echo ( substr($route['title'], 0, 5) == 'lang:' ? lang(substr($route['title'], 5)) : $route['title'] ); ?></td>
                        <td><?php echo $route['https']['value']; ?></td>
                        <td><?php echo $route['slug']; ?></td>
                        <td><?php echo $route['route']; ?></td>
                        <td><?php echo $route['translation']; ?></td>
                        <td><center>
                            <?php echo anchor('admin/firesale/routes/edit/' . $route['id'], lang('global:edit'), 'class="btn blue edit"'); ?>
                            <?php echo ( $route['is_core'] != '1' ? anchor('admin/firesale/routes/delete/' . $route['id'], lang('global:delete'), array('class' => 'confirm btn red delete')) : '' ); ?>
                        </center></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <div class="no_data"><?php echo lang('firesale:routes:none'); ?></div>
        <?php endif;?>
        </div>
    </section>
