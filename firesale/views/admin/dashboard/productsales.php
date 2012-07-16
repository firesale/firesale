
<?php if( isset($products) && !empty($products) ): ?>
  	<div class="chart-pie" style="height: 300px">
		<table class="chart-pie" style="width: 100%;">
			<thead>
				<tr>
					<th></th>
<?php foreach( $products as $product ): ?>
					<th><?php echo $product['title']; ?></th>
<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
<?php foreach( $products as $product ): ?>
					<td><?php echo $product['count']; ?></td>
<?php endforeach; ?>
				</tr>
			</tbody>
		</table>
	</div>
<?php else: ?>
  <div class="no_data">No sales found</div>
<?php endif; ?>
