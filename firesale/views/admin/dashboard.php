<div id="sortable">
<?php if( isset($items) AND !empty($items) ): ?>
<?php foreach( $items as $slug => $item ): ?>

	<div class="one_half" id="<?php echo $slug; ?>">
		<section class="draggable title">
			<h4><?php echo lang($item['title']); ?></h4>
			<a class="tooltip-s toggle" title="Toggle this element"></a>
		</section>
		<section class="item">
			<?php echo $item['content']; ?>
		</section>
	</div>

<?php endforeach; ?>
<?php endif; ?>
</div>
