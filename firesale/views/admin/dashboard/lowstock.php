
    <ul class="width-half">
      <li><strong><?php echo sprintf(lang('firesale:dashboard:stock_low'), $low_count); ?></strong></li>
<?php if( $low_count == 0 ): ?>
      <li><div class="no_data"><?php echo lang('firesale:dashboard:no_stock_low'); ?></div></li>
<?php else: ?>
<?php foreach( $low_prods AS $product ): ?>
      <li><a href="/admin/firesale/products/edit/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a><span><?php echo $product['stock']; ?></span></li>
<?php endforeach; ?>
     <br />
     <a href="/admin/firesale/products/stock_status/2" class="btn blue right"><span><?php echo lang('firesale:dashboard:view_more'); ?></span></a>
<?php endif; ?>
    </ul>  
    <ul class="width-half">
      <li><strong><?php echo sprintf(lang('firesale:dashboard:stock_out'), $out_count); ?></strong></li>
<?php if( $out_count == 0 ): ?>
      <li><div class="no_data"><?php echo lang('firesale:dashboard:no_stock_out'); ?></div></li>
<?php else: ?>
<?php foreach( $out_prods AS $product ): ?>
      <li><a href="/admin/firesale/products/edit/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a><span><?php echo $product['stock']; ?></span></li>
<?php endforeach; ?>
      <br />
      <a href="/admin/firesale/products/stock_status/3" class="btn blue right"><span><?php echo lang('firesale:dashboard:view_more'); ?></span></a>
<?php endif; ?>
    </ul>
    <br class="clear" />