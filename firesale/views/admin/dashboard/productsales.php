
<?php if( isset($total_count) && $total_count > 0 ): ?>

  	<div id="sales" style="width: 595px; height: 260px"></div>

	<script type="text/javascript">
		var currency = '<?php echo $currency; ?>';
		var sales    = <?php echo $sales; ?>;
		var count    = <?php echo $count; ?>;
		buildGraph(sales, count, '#sales');
	</script>

<?php else: ?>
  <div class="no_data">No sales found</div>
<?php endif; ?>
