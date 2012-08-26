<p>Please wait while we redirect you to the payment page...</p>
<form id="redirect_form" name="payment" action="<?php echo htmlspecialchars($post_url); ?>" method="post">
	<p>
		<?php if (is_array($data)): ?>
			<?php foreach ($data as $key => $value): ?>
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>" />
			<?php endforeach ?>
		<?php else: ?>
			<?php echo $data; ?>
		<?php endif; ?>
		<input type="submit" value="Continue" />
	</p>
</form>