
    <section class="title">
        <h4><?php echo lang('firesale:orders:title'); ?></h4>
        <a class="tooltip-s show-filter" original-title="<?php echo lang('firesale:label_showfilter'); ?>"></a>
    </section>

    <section class="item">
    <div class="content">
<?php if( !empty($orders)): ?>

       <?php echo form_open(site_url('admin/firesale/orders/ajax_filter'), 'class="crud" id="filters_form"'); ?>
            <fieldset id="filters" style="display: none">
                <legend><?php echo lang('global:filters'); ?></legend>
                <ul>
                    <li>
                        <center><?php echo $filter_users; ?></center>
                    </li>
                    <li>
                        <center><?php echo $filter_status; ?></center>
                    </li>
                    <li>
                        <center><?php echo $filter_prods; ?></center>
                    </li>
                    <li>
                        <center>
                            <input type="text" name="date[from]" placeholder="From..." class="datepicker" id="date_from" />
                            <input type="text" name="date[to]" placeholder="To..." class="datepicker" id="date_to" />
                        </center>
                    </li>
                    <li class="wide">
                        <center>
                            <div class="ui-slider-cont">
                                <label class="left"><?php echo $this->settings->get('currency'); ?><span><?php echo $min_max['min']; ?></span></label>
                                <label class="right"><?php echo $this->settings->get('currency'); ?><span><?php echo $min_max['max']; ?></span></label>
                                <div id="price-slider"></div>
                            </div>
                            <input type="hidden" name="price_total" value="<?php echo $min_max['min']; ?>-<?php echo $min_max['max']; ?>" />
                        </center>
                    </li>
                </ul>
            </fieldset>
        <?php echo form_close(); ?>

        <?php echo form_open(site_url('admin/firesale/orders/status'), 'class="crud"'); ?>
            <table id="order_table">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
                        <th><?php echo lang('firesale:orders:label_order_id'); ?></th>
                        <th class="{sorter: 'date'}"><?php echo lang('firesale:label_date'); ?></th>
                        <th><?php echo lang('firesale:label_ship_to'); ?></th>
                        <th><?php echo lang('firesale:label_status'); ?></th>
                        <th><?php echo lang('firesale:label_products'); ?></th>
                        <th><?php echo lang('firesale:label_country'); ?></th>
                        <th class="{sorter: 'currency'}"><?php echo lang('firesale:label_price_total'); ?></th>
                        <th class="{sorter: 'currency'}"><?php echo lang('firesale:label_price_ship'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="10"><?php echo $pagination['links']; ?></td>
                    </tr>
                </tfoot>
                <tbody>
<?php foreach( $orders AS $order ): ?>
                    <tr class="status-<?php echo $order['order_status']['key']; ?>">
                        <td><input type="checkbox" name="action_to[]" value="<?php echo $order['id']; ?>"  /></td>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo date('G:ia D jS M Y', $order['created']); ?></td>
                    <?php if( is_array($order['ship_to']) ): ?>
                        <td><?php echo $order['ship_to']['firstname'] . ' ' . $order['ship_to']['lastname']; ?></td>
                    <?php else: ?>
                        <td><?php echo $order['created_by']['display_name']; ?></td>
                    <?php endif; ?>
                        <td><?php echo $order['order_status']['value']; ?></td>
                        <td><?php echo $order['products']; ?></td>
                        <td><?php echo $order['ship_to']['country']['name']; ?></td>
                        <td><?php echo $order['price_total']; ?></td>
                        <td><?php echo $order['price_ship']; ?></td>
                        <td class="actions">
                            <?php if (group_has_role('firesale', 'edit_orders')): ?>
                                <a class="btn edit blue" href="<?php echo site_url('admin/firesale/orders/edit/' . $order['id']); ?>"><?php echo lang('global:edit'); ?></a>
                            <?php endif; ?>
                            <a class="btn red confirm" href="<?php echo site_url('admin/firesale/orders/delete/' . $order['id']); ?>"><?php echo lang('global:delete'); ?></a>
                        </td>
                    </tr>
<?php endforeach; ?>
                </tbody>
            </table>

            <br />
            <div class="table_action_buttons">
                <button class="btn green" value="paid" name="btnAction" type="submit" disabled="">
                    <span><?php echo lang('firesale:orders:mark_as') . lang('firesale:orders:status_paid'); ?></span>
                </button>

                <button class="btn red" value="unpaid" name="btnAction" type="submit" disabled="">
                    <span><?php echo lang('firesale:orders:mark_as') . lang('firesale:orders:status_unpaid'); ?></span>
                </button>

                <button class="btn orange" value="dispatched" name="btnAction" type="submit" disabled="">
                    <span><?php echo lang('firesale:orders:mark_as') . lang('firesale:orders:status_dispatched'); ?></span>
                </button>

                <button class="btn red confirm" value="delete" name="btnAction" type="submit" disabled="">
                    <span><?php echo lang('firesale:orders:delete'); ?></span>
                </button>
                <?php echo $buttons; ?>
            </div>

        <?php echo form_close(); ?>

<?php else: ?>
            <div class="no_data"><?php echo lang('firesale:orders:no_orders'); ?></div>
<?php endif; ?>

    </div>
    </section>
