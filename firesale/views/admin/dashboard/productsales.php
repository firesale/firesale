
<?php if( isset($year['total_count']) && $year['total_count'] > 0 ): ?>

    <ul class="sales">
        <li><a href="#">
            <span><?php echo lang('firesale:dashboard:month'); ?></span>
            <em><?php echo $month['total_sales']; ?></em>
            <span><?php echo sprintf(lang('firesale:dashboard:sales_in'), $month['total_count']); ?></span>
        </a></li>
        <li><a href="#">
            <span><?php echo lang('firesale:dashboard:week'); ?></span>
            <em><?php echo $week['total_sales']; ?></em>
            <span><?php echo sprintf(lang('firesale:dashboard:sales_in'), $week['total_count']); ?></span>
        </a></li>
        <li><a href="#">
            <span><?php echo lang('firesale:dashboard:today'); ?></span>
            <em><?php echo $day['total_sales']; ?></em>
            <span><?php echo sprintf(lang('firesale:dashboard:sales_in'), $day['total_count']); ?></span>
        </a></li>
    </ul>

    <br class="clear" />

    <div id="sales_graph"></div>

    <br class="clear" />
    <br />

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
