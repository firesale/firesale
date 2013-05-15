
            <table id="attr_form">
                <thead>
                    <th class="center">&nbsp;</th>
                    <th class="center">&nbsp;</th>
                    <th><?php echo lang('firesale:attributes:labels:option'); ?></th>
                    <th><?php echo lang('firesale:attributes:labels:value'); ?></th>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <a href="#" class="add btn green"><span><?php echo lang('firesale:attributes:labels:add'); ?></span></a>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <?php if ( isset($attributes) && ! empty($attributes) ): ?>
                <?php foreach( $attributes AS $attr ): ?>
                    <tr id="attribute_<?php echo $attr['key']; ?>" class="<?php echo alternator('even', ''); ?>">
                        <td class="center"><span class="mover"></span></td>
                        <td class="center"><input class="remove" type="checkbox" name="attribute[<?php echo $attr['key']; ?>][remove]" value="1" /></td>
                        <td class="option"><?php echo form_dropdown('attribute['.$attr['key'].'][key]', $options, $attr['key']); ?></td>
                        <td class="value"><textarea class="attribute" rows="1" name="attribute[<?php echo $attr['key']; ?>][value]"><?php echo $attr['value']; ?></textarea></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr class="new <?php echo alternator('even', ''); ?>">
                        <td class="center">&nbsp;</td>
                        <td class="center">&nbsp;</td>
                        <td class="option"><?php echo form_dropdown('attribute[new_1][key]', $options); ?></td>
                        <td class="value"><textarea class="attribute" rows="1" name="attribute[new_1][value]"></textarea></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
