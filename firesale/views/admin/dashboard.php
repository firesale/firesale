
    <div id="sortable">
    <?php if( isset($items) AND ! empty($items) ): ?>
    <?php foreach( $items as $item ): ?>

        <div class="one_half" id="<?=$item['id']; ?>">
            <section class="draggable title">
                <h4><?=$item['title']; ?></h4>
                <a class="tooltip-s toggle" title="Toggle this element"></a>
            </section>
            <section class="item"<?=( isset($item['hidden']) && $item['hidden'] == true ? ' style="height: auto; display: none"' : '' ); ?>>
                <div class="content">
                    <?=$item['content']; ?>
                </div>
            </section>
        </div>

    <?php endforeach; ?>
    <?php endif; ?>
    </div>
