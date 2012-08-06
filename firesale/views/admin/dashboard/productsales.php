
<?php if( isset($total_count) && $total_count > 0 ): ?>

  	<div id="sales" style="width: 100%; height: 260px"></div>

	<script type="text/javascript">
		var currency = '<?php echo $currency; ?>';
		var sales    = <?php echo $sales; ?>;
		var count    = <?php echo $count; ?>;
		buildGraph(sales, count, '#sales');
	</script>

<?php else: ?>
  <div class="no_data"><?php echo lang('firesale:dashboard:no_sales'); ?></div>
<?php endif; ?>
