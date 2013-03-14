
<?php if( isset($year['total_count']) && $year['total_count'] > 0 ): ?>

    <div id="sales_graph"></div>

    <script type="text/javascript">
        var currency = '<?php echo $year['currency']; ?>';
        var sales    = <?php echo $year['sales']; ?>;
        var count    = <?php echo $year['count']; ?>;
        buildGraph(sales, count, '#sales_graph');
        $(window).resize(function() { buildGraph(sales, count, '#sales_graph'); });
    </script>

<?php else: ?>

  	<div class="no_data"><?php echo lang('firesale:dashboard:no_sales'); ?></div>

<?php endif; ?>
