<ul>
<?php foreach($cats as $cat): ?>
    <li>
        <a href="{{ firesale:url route='category' id='<?php echo $cat['id']; ?>' }}"><?php echo $cat['title']; ?></a>
    <?php if( isset($cat['children']) ): ?>
        <ul>
            <?php $controller->categories_m->tree_builder($cat); ?>
        </ul>
    <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
