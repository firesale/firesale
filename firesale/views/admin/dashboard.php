    <div id="sortable">
    <?php if( isset($items) AND ! empty($items) ): ?>
    <?php foreach( $items as $item ): ?>

        <div class="one_half" id="<?php echo $item['id']; ?>">
            <section class="draggable title">
                <h4><?php echo $item['title']; ?></h4>
                <a class="tooltip-s toggle" title="Toggle this element"></a>
            </section>
            <section class="item"<?php echo ( isset($item['hidden']) && $item['hidden'] == true ? ' style="height: auto; display: none"' : '' ); ?>>
                <div class="content">
                    <?php echo $item['content']; ?>
                </div>
            </section>
        </div>

    <?php endforeach; ?>
    <?php endif; ?>
    </div>
