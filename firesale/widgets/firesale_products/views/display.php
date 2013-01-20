<ul>
<?php if( !empty($products) ): ?>
<?php foreach($products as $product): ?>
    <li>
        <a href="{{ firesale:url route='product' id='<?php echo $product['id']; ?>' }}"><?php echo $product['title']; ?></a>
        <br /><strong><?php echo $product['price_formatted']; ?></strong>
    </li>
<?php endforeach; ?>
<?php else: ?>
    <li class="no-products"><strong><?php echo lang('firesale:prod_none'); ?></strong></li>
<?php endif; ?>
</ul>
