
<?php if( $low_count == 0 && $out_count == 0 ): ?>
  <div class="no_data">No low or out of stock products</div>
<?php else: ?>
  <ul class="width-half">
    <li><strong><?php echo $low_count . ' Product' . ( $low_count != 1 ? 's' : '' ) . ' with low stock'; ?></strong></li>
<?php foreach( $low_prods AS $product ): ?>
    <li><a href="/admin/firesale/products/edit/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a><span><?php echo $product['stock']; ?></span></li>
<?php endforeach; ?>
<?php if( $low_count == 0 ): ?>
	<li><div class="no_data">No low stock products</div></li>
<?php endif; ?>
  </ul>
  <ul class="width-half">
    <li><strong><?php echo $out_count . ' Product' . ( $out_count != 1 ? 's' : '' ) . ' with no stock'; ?></strong></li>
<?php foreach( $out_prods AS $product ): ?>
    <li><a href="/admin/firesale/products/edit/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a><span><?php echo $product['stock']; ?></span></li>
<?php endforeach; ?>
<?php if( $out_count == 0 ): ?>
	<li><div class="no_data">No out of stock products</div></li>
<?php endif; ?>
  </ul>
  <br class="clear" />
  <a href="#" class="btn blue right"><span>View More</span></a>
  <br class="clear" />
<?php endif; ?>
