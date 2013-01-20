
    <form id="search" method="post" action="">

        <input type="text" name="search" placeholder="Search term..." <?php echo ( isset($current) ? 'value="' . urldecode($current) . '" ' : '' ); ?>/>
        <?php echo form_dropdown('category', $categories, set_value('category', ( isset($cat) ? $cat : NULL )), 'id="category"'); ?>
        <button type="submit" class="btn" name="btnAction" value="search"><span><?php echo lang('firesale:search:label_search'); ?></span></button>
        <br class="clear" />

    </form>

<?php if( isset($pagination) ): ?>
    <?php echo $pagination['links']; ?>
<?php endif; ?>

    <div id="results">
<?php if( isset($current) && ( ! isset($total) || $total <= 0 ) ): ?>

        <h2><?php echo lang('firesale:search:label_nothing_found'); ?></h2>

<?php elseif( isset($current) && isset($total) && $total > 0 ): ?>
<?php foreach( $results as $product ): ?>

        <a href="<?php echo BASE_URI . "product/{$product['slug']}"; ?>"><?php echo $product['title']; ?></a>
        <br />
        <br />

<?php endforeach; ?>
<?php endif; ?>
    </div>

<?php if( isset($pagination) ): ?>
    <?php echo $pagination['links']; ?>
<?php endif; ?>
