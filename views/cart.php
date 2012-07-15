<?php if ( ! $this->cart->contents()): ?>
	<?php echo lang('firesale:cart:empty'); ?>
<?php else: ?>
	<?php echo form_open('firesale/cart/update'); ?>
	
	<table cellpadding="6" cellspacing="1" style="width:100%" border="0">
	
	<tr>
	  <th>Remove</th>
	  <th>QTY</th>
	  <th>Item Description</th>
	  <th style="text-align:right">Item Price</th>
	</tr>
	
	<?php $i = 1; ?>
	
	<?php foreach ($this->cart->contents() as $items): ?>
	
		<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
	
		<tr>
		  <td style="text-align: left"><a href="<?php echo site_url('firesale/cart/remove/'.$items['rowid']); ?>">Remove</a></td>
		  <td style="text-align: left"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
		  <td style="text-align: left">
			<?php echo $items['name']; ?>
	
				<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
	
					<p>
						<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
	
							<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
	
						<?php endforeach; ?>
					</p>
	
				<?php endif; ?>
	
		  </td>
		  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
		</tr>
	
	<?php $i++; ?>
	
	<?php endforeach; ?>
	
	<tr>
	  <td colspan="2">&nbsp;</td>
	  <td style="text-align: right"><strong>Total</strong></td>
	  <td style="text-align: right">&pound;<?php echo $this->cart->format_number($this->cart->total()); ?></td>
	</tr>
	
	</table>
	
	<p><?php echo form_submit('', 'Update your Cart'); ?><?php echo form_submit('checkout', 'Checkout'); ?></p>
<?php endif; ?>
