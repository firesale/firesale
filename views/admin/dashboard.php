<div class="full_width">
<?php if( isset($items) AND !empty($items) ): ?>
<?php foreach( $items as $slug => $item ): ?>

	<div class="section-cont one_half<?php /*echo ( $no % 2 == 1 ? ' last' : '' );*/ ?>" id="<?php echo $slug; ?>">
		<section class="title">
			<h4><?php echo lang($item['title']); ?></h4>
			<a href="#" class="close">Close</a>
		</section>
		<section class="item">
			<?php echo $item['content']; ?>
		</section>
	</div>

<?php endforeach; ?>
<?php endif; ?>
<?php if( $count > $shown ): ?>
	<div class="section_add one_half">
		<section id="additem">Add item</section>
	</div>
<?php endif; ?>
</div>
