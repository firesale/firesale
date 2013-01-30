    <section class="title">
        <h4><?php echo lang('firesale:prod_title'); ?></h4>
        <a class="tooltip-s show-filter" original-title="<?php echo lang('firesale:label_showfilter'); ?>"></a>
    </section>

    <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>

        <section class="item">
            <div class="content">
        <?php if( $count == 0 ): ?>
                <div class="no_data"><?php echo lang('firesale:prod_none'); ?></div>
            </div>
        </section>
        <?php else: ?>

            <fieldset id="filters" style="display: none">
                <legend><?php echo lang('global:filters'); ?></legend>
                <ul>
                    <li>
                        <center><?php echo form_dropdown('category', $categories, ( isset($category) ? $category : 0 )); ?></center>
                    </li>
                    <li>
                        <center><?php echo $status; ?></center>
                    </li>
                    <li>
                        <center><?php echo $stock_status; ?></center>
                    </li>
                    <li>
                        <center><input type="text" name="search" placeholder="Keyword Search..." /></center>
                    </li>
                    <li class="wide">
                        <center>
                            <div class="ui-slider-cont">
                                <label class="left"><?php echo $this->settings->get('currency'); ?><span><?php echo $min_max['min']; ?></span></label>
                                <label class="right"><?php echo $this->settings->get('currency'); ?><span><?php echo $min_max['max']; ?></span></label>
                                <div id="price-slider"></div>
                            </div>
                        </center>
                    </li>
                </ul>
            </fieldset>

            <table id="product_table">
                <thead>
                    <tr>
                        <th style="width: 15px"><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
                        <th style="width: 110px"><?php echo lang('firesale:label_id'); ?></th>
                        <th style="width: 40px"><?php echo lang('firesale:label_image'); ?></th>
                        <th style="width: 340px"><?php echo lang('firesale:label_title'); ?></th>
                        <th style="width: 160px"><?php echo lang('firesale:label_parent'); ?></th>
                        <th style="width: 80px"><?php echo lang('firesale:label_stock_short'); ?></th>
                        <th style="width: 90px"><?php echo lang('firesale:label_price'); ?></th>
                        <th></th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <td colspan="9"><div style="float:right;"><?php echo $pagination['links']; ?></div></td>
                    </tr>
                </tfoot>

                <tbody>
                <?php foreach($products as $product): ?>
                    <tr class="cat_<?php echo $product['category']['id']; ?>">
                        <td><input type="checkbox" name="action_to[]" value="<?php echo $product['id']; ?>"  /></td>
                        <td class="item-id"><?php echo $product['code']; ?></td>
                        <td class="item-img"><img src="<?php echo ( $product['image'] != FALSE ? site_url('files/thumb/' . $product['image'] . '/32/32') : '' ); ?>" alt="Product Image" /></td>
                        <td class="item-title"><a href="<?php echo $this->routes_m->build_url('product', $product['id']); ?>" target="_blank"><?php echo $product['title']; ?></a></td>
                        <td class="item-category">
                            <?php $string = ''; foreach ($product['category'] AS $cat) { $string .= ( strlen($string) == 0 ? '' : ', ' ) . '<span data-id="' . $cat['id'] . '">' . $cat['title'] . '</span>'; } echo $string; ?>
                        </td>
                        <td class="item-stock"><?php echo ( $product['stock_status']['key'] == 6 ? lang('firesale:label_stock_unlimited') . ' (&infin;)' : $product['stock'] ); ?></td>
                        <td class="item-price"><?php echo $product['price_formatted']; ?></td>
                        <td class="actions">
                            <center><ul class="split-button">
                                <li><strong>Action</strong></li>
                                <li><a href="#" class="quickedit"><?php echo lang('firesale:prod_button_quick_edit'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/firesale/products/edit/'.$product['id']); ?>" class="edit"><?php echo lang('global:edit'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/firesale/products/delete/'.$product['id']); ?>" class="confirm"><?php echo lang('global:delete'); ?></a></li>
                            </ul></center>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <br />
            <div class="table_action_buttons">
                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
                <button class="btn green" name="btnAction" value="duplicate"><span><?php echo lang('firesale:label_duplicate'); ?></span></button>
            </div>

            </div>
        </section>
        <?php endif; ?>

    <?php echo form_close(); ?>
