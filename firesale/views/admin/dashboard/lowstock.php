
    <div class="tabs">

      <ul class="tab-menu">
        <li><a href="#stock-low">Low Stock</a></li>
        <li><a href="#stock-out">Out of Stock</a></li>
      </ul>

      <div id="stock-low" class="form_inputs">
        <fieldset>
<?php if( $low_count > 0 ): ?>
          <table>
            <thead>
              <th><?php echo lang('firesale:label_id'); ?></th>
              <th><?php echo lang('firesale:label_title'); ?></th>
              <th><?php echo lang('firesale:label_stock_short'); ?></th>
              <th>&nbsp;</th>
            </thead>
            <tbody>
<?php foreach( $low_prods AS $product ): ?>
              <tr>
                <td><?php echo $product['code']; ?></td>
                <td><a href="{{ url:base }}product/<?php echo $product['slug']; ?>"><?php echo $product['title']; ?></a></td>
                <td><?php echo $product['stock']; ?></td>
                <td><a href="/admin/firesale/products/edit/<?php echo $product['id']; ?>" class="btn green"><span>Edit</span></td>
              </tr>
<?php endforeach; ?>
            </tbody>
          </table>
          <br />
          <a href="{{ url:base }}admin/firesale/products/stock_status/2" class="btn blue"><span>View More</span></a>
<?php else: ?>
          <div class="no_data"><?php echo lang('firesale:dashboard:no_stock_low'); ?></div>
<?php endif; ?>
        </fieldset>
      </div>

      <div id="stock-out" class="form_inputs">
        <fieldset>
<?php if( $out_count > 0 ): ?>
          <table>
            <thead>
              <th><?php echo lang('firesale:label_id'); ?></th>
              <th><?php echo lang('firesale:label_title'); ?></th>
              <th><?php echo lang('firesale:label_stock_short'); ?></th>
              <th>&nbsp;</th>
            </thead>
            <tbody>
<?php foreach( $out_prods AS $product ): ?>
             <tr>
                <td><?php echo $product['code']; ?></td>
                <td><a href="{{ url:base }}product/<?php echo $product['slug']; ?>"><?php echo $product['title']; ?></a></td>
                <td><?php echo $product['stock']; ?></td>
                <td><a href="/admin/firesale/products/edit/<?php echo $product['id']; ?>" class="btn green"><span>Edit</span></td>
             </tr>
<?php endforeach; ?>
            </tbody>
          </table>
          <br />
          <a href="{{ url:base }}admin/firesale/products/stock_status/3" class="btn blue"><span>View More</span></a>
<?php else: ?>
          <div class="no_data"><?php echo lang('firesale:dashboard:no_stock_out'); ?></div>
<?php endif; ?>
        </fieldset>
      </div>

    </div>
