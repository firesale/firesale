
	<h1><?php echo lang('firesale:sections:orders'); ?></h1>

	<fieldset id="filters">
	    <legend><?php echo lang('global:filters'); ?></legend>
	    <ul>  
	        <li>
	            <label><?php echo lang('firesale:filters:user'); ?></label>
	            <?php echo $filter_users; ?>
	        </li>
	    </ul>
	</fieldset>
		
	<section class="title">
		<h4><?php echo lang('firesale:orders:title'); ?></h4>
	</section>

	<?php echo form_open_multipart($this->uri->uri_string() . '/status', 'class="crud" id="tabs"'); ?>

		<section class="item">
<?php if( !empty($orders)): ?>
			<table id="order_table">		    
				<thead>
					<tr>
						<th><input type="checkbox" name="action_to_all" value="" class="check-all" /></th>
						<th><?php echo lang('firesale:label_date'); ?></th>
						<th><?php echo lang('firesale:label_ship_to'); ?></th>
						<th><?php echo lang('firesale:label_status'); ?></th>
						<th><?php echo lang('firesale:label_products'); ?></th>
						<th><?php echo lang('firesale:label_country'); ?></th>
						<th><?php echo lang('firesale:label_price_total'); ?></th>
						<th><?php echo lang('firesale:label_price_ship'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
<?php foreach( $orders AS $order ): ?>
					<tr>
						<td><input type="checkbox" name="action_to[]" value="<?php echo $order['id']; ?>"  /></td>
						<td><?php echo date('H:i:s d-m-Y', $order['created']); ?></td>
						<td><?php echo $order['ship_firstname'] . ' ' . $order['ship_lastname']; ?></td>
						<td><?php echo $order['status']['value']; ?></td>
						<td><?php echo $order['products']; ?></td>
						<td><?php echo $order['ship_country']; ?></td>
						<td><?php echo $this->settings->get('currency') . $order['price_total']; ?></td>
						<td><?php echo $this->settings->get('currency') . $order['price_ship']; ?></td>
						<td class="actions">
							<a class="button small" href="<?php echo site_url('admin/firesale/orders/edit/' . $order['id']); ?>">Edit</a>
						</td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
<?php else: ?>
			<div class="no_data"><?php echo lang('firesale:orders:no_orders'); ?></div>
<?php endif; ?>
		</section>

		<div class="table_action_buttons">
			<button class="btn green" value="paid" name="btnAction" type="submit" disabled="">
				<span>Mark as Paid</span>
			</button>
		
			<button class="btn red" value="unpaid" name="btnAction" type="submit" disabled="">
				<span>Mark as Unpaid</span>
			</button>
		
			<button class="btn orange" value="dispatched" name="btnAction" type="submit" disabled="">
				<span>Mark as Dispatched</span>
			</button>
		</div>

	<?php echo form_close(); ?>
