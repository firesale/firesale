
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="tabs"'); ?>

        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />

        <section class="title">
            <h4><?php echo ( isset($title) ? str_replace('%t', $title, lang('firesale:prod_header')) : lang('firesale:prod_title_create') ); ?></h4>
        </section>

        <section class="item">

            <div class="content">

            <div class="tabs">

                <ul class="tab-menu">
                <?php foreach( $tabs AS $tab ): ?>
                    <?php if( ( substr($tab, 0, 1) == '_' && isset($id) && $id > 0 ) || substr($tab, 0, 1) != '_' ): ?>
                    <li><a href="#<?php echo strtolower(str_replace(array(' ', '_'), '', $tab)); ?>"><span><?php echo lang('firesale:tabs:' . str_replace('_', '', $tab)); ?></span></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>

                <?php foreach( $fields AS $slug => $field ): ?>
                <?php if( $slug == '_images' && isset($id) && $id > 0 ): ?>
                <div id="images" class="form_inputs">
                    <fieldset>
                        <div id="dropbox">
                        <?php echo ( count($images) > 0 ? '' : '	<span class="message">' . lang('firesale:label_drop_images') . '</span>' ); ?>
                        <?php foreach($images as $image): ?>
                            <div class="preview" id="image-<?php echo $image->id; ?>">
                                <span class="imageHolder">
                                    <a href="{{ site:url }}admin/firesale/products/delete_image/<?php echo $image->id; ?>" class="delete">x</a>
                                    <img src="{{ site:url }}files/thumb/<?php echo $image->id; ?>/480/360" />
                                </span>
                                <span class="imageTitle"><?php echo $image->name; ?></span>
                            </div>
                        <?php endforeach; ?>
                            <br class="clear" />
                        </div>
                    </fieldset>
                </div>

                <?php elseif( $slug == '_modifiers' && isset($id) && $id > 0 ): ?>
                <div id="modifiers" class="form_inputs">
                    <fieldset>
                    <?php if( ! $is_variation ): ?>
                        <table class="modifiers">
                            <thead>
                                <tr>
                                    <th style="width: 30px"></th>
                                    <th style="width: 15%"><?php echo lang('firesale:label_type'); ?></th>
                                    <th style="width: 18%"><?php echo lang('firesale:label_title'); ?></th>
                                    <th style="width: 32%"><?php echo lang('firesale:label_inst'); ?></th>
                                    <th style="width: 35%"><?php echo lang('firesale:prod_variations:title'); ?></th>
                                    <th style="width: 30px"><a href="#" title="Show/Hide all options" class="tooltip-s mod-min">Show/Hide All</a></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <a href="{{ url:site }}admin/firesale/products/modifier/<?php echo $id; ?>" class="modal modifier btn green"><?php echo lang('firesale:mods:create'); ?></a>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php if( ! empty($modifiers) ): ?>
                            <?php foreach( $modifiers as $modifier ): ?>
                                <tr id="mod_<?php echo $modifier['id']; ?>">
                                    <td><span class="mod-mover"></span></td>
                                    <td><?php echo $modifier['type']['val']; ?></td>
                                    <td><?php echo $modifier['title']; ?></td>
                                    <td><?php echo $modifier['instructions']; ?></td>
                                    <td>
                                    <?php if( $modifier['type']['key'] != 2 ): ?>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px"></th>
                                                    <th style="width: 50%"><?php echo lang('firesale:label_options'); ?></th>
                                                    <th style="width: 50%"><?php echo lang('firesale:label_mod_price'); ?></th>
                                                    <th style="width: 42px"></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        <a href="{{ url:site }}admin/firesale/products/variation/<?php echo $modifier['id']; ?>" class="modal btn green"><?php echo lang('firesale:vars:create'); ?></a>
                                                        <a href="{{ url:site }}admin/firesale/products/modifier/<?php echo $id; ?>/<?php echo $modifier['id']; ?>" class="right modal btn orange"><?php echo lang('firesale:mods:edit'); ?></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php if( ! empty($modifier['variations']) ): ?>
                                            <?php foreach( $modifier['variations'] as $variation ): ?>
                                                <tr id="var_<?php echo $variation['id']; ?>">
                                                    <td><span class="var-mover"></span></td>
                                                    <td><?php echo $variation['title']; ?></td>
                                                    <td><?php echo $variation['difference']; ?></td>
                                                    <td><a href="{{ url:site }}admin/firesale/products/variation/<?php echo $id; ?>/<?php echo $variation['id']; ?>" class="modal variation btn orange"><?php echo lang('global:edit'); ?></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="4"><div class="no_data" style="margin-top: 7px"><?php echo lang('firesale:vars:none'); ?></div></td></tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td><a href="#" title="Show/Hide this option" class="tooltip-s mod-min">Show/Hide</a></td>
                                <?php else: ?>
                                        <a href="{{ url:site }}admin/firesale/products/modifier/<?php echo $id; ?>/<?php echo $modifier['id']; ?>" class="right modal btn orange"><?php echo lang('firesale:mods:edit'); ?></a>
                                    </td>
                                    <td></td>
                                <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6"><div class="no_data" style="margin-top: 7px"><?php echo lang('firesale:mods:none'); ?></div></td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    <?php if( isset($variations) and !empty($variations) ): ?>
                        <br />

                        <table class="products">
                            <thead>
                                <tr>
                                <?php foreach( $modifiers as $modifier ): ?>
                                <?php if( $modifier['type']['key'] == '1' ): ?>
                                    <th><?php echo $modifier['title']; ?></th>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                    <th><?php echo lang('firesale:label_id'); ?></th>
                                    <th><?php echo lang('firesale:label_price'); ?></th>
                                    <th><?php echo lang('firesale:label_stock_short'); ?></th>
                                    <th><?php echo lang('firesale:label_status'); ?></th>
                                    <th style="width: 42px"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if( ! empty($variations) ): ?>
                            <?php foreach( $variations as $variation ): ?>
                                <tr>
                                <?php foreach( $variation['modifiers'] as $modifier ): ?>
                                    <td><?php echo $modifier['var_title']; ?></td>
                                <?php endforeach; ?>
                                    <td><?php echo $variation['code']; ?></td>
                                    <td><?php echo $variation['price_formatted']; ?></td>
                                    <td><?php echo $variation['stock']; ?></td>
                                    <td><?php echo $variation['stock_status']['val']; ?></td>
                                    <td><a href="{{ url:site }}admin/firesale/products/edit/<?php echo $variation['id']; ?>" class="btn orange"><?php echo lang('global:edit'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="<?php echo ( 5 + count($modifiers) ); ?>"><div class="no_data" style="margin-top: 7px"><?php echo lang('firesale:vars:none'); ?></div></td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    <?php endif; ?>
                    <?php else: ?>
                        <div class="no_data"><?php echo lang('firesale:mods:nothere'); ?></div>
                    <?php endif; ?>
                    </fieldset>
                </div>

                <?php elseif( substr($slug, 0, 1) == '_' && isset($id) && $id > 0 ): ?>
                <div id="<?php echo strtolower(str_replace(array(' ', '_'), '', $slug)); ?>" class="form_inputs">
                    <fieldset>
                        <ul>
                        <?php if (is_array($field)): ?>
                            <?php foreach( $field AS $input ): ?>
                                <li class="<?php echo alternator('even', ''); ?>">
                                    <label for="<?php echo $input['input_slug']; ?>">
                                        <?php echo lang(substr($input['input_title'], 5)) ? lang(substr($input['input_title'], 5)) : $input['input_title']; ?> <?php echo $input['required']; ?>
                                        <small><?php echo lang(substr($input['instructions'], 5)) ? lang(substr($input['instructions'], 5)) : $input['instructions']; ?></small>
                                    </label>
                                    <div class="input"><?php echo $input['input']; ?></div>
                                    <br class="clear" />
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php echo $field; ?>
                        <?php endif; ?>
                        </ul>
                    </fieldset>
                </div>

                <?php elseif( substr($slug, 0, 1) != '_' ): ?>
                <div id="<?php echo strtolower(str_replace(' ', '', $slug)); ?>" class="form_inputs">
                    <fieldset>
                        <ul>
                        <?php if (is_array($field)): ?>
                            <?php foreach( $field AS $input ): ?>
                                <li class="<?php echo alternator('even', ''); ?>">
                                    <label for="<?php echo $input['input_slug']; ?>">
                                        <?php echo lang(substr($input['input_title'], 5)) ? lang(substr($input['input_title'], 5)) : $input['input_title']; ?> <?php echo $input['required']; ?>
                                        <small><?php echo lang(substr($input['instructions'], 5)) ? lang(substr($input['instructions'], 5)) : $input['instructions']; ?></small>
                                    </label>
                                    <div class="input"><?php echo $input['input']; ?></div>
                                    <br class="clear" />
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php echo $field; ?>
                        <?php endif; ?>
                        </ul>
                    </fieldset>
                </div>

                <?php endif; ?>
                <?php endforeach; ?>

            </div>

            <div class="buttons">
                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
            </div>

            </div>

        </section>

    <?php echo form_close(); ?>
