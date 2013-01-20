<ol>
    <li class="even">
        <label>Category</label>
        <?php echo form_dropdown('category', $categories, $options['category']); ?>
    </li>
    <li class="odd">
        <label>Show Sale Items</label>
        <?php echo form_dropdown('sale_only', $sale, $options['sale_only']); ?>
    </li>
    <li class="even">
        <label>Limit</label>
        <?php echo form_input('limit', ( $options['limit'] != '' ? $options['limit'] : '5' )); ?>
    </li>
</ol>
