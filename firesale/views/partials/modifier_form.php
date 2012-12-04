
	<form method="post" action="{{ firesale:url route='cart' }}/insert">
		<input type="hidden" name="prd_code[]" value="{{ product.id }}" />
		<fieldset>

			<ul>
			{{ modifiers }}
				<li>
					<label>
						<strong>{{ title }}</strong>
						<small>{{ instructions }}</small>
					</label>
					<div class="input">
					{{ if variations }}
					{{ variations }}
						<input type="radio" name="options[{{ mod_id }}]" id="options_{{ id }}" value="{{ id }}" {{ selected }}/>
						<label for="options_{{ id }}">{{ title }} ({{ price }})</label>
					{{ /variations }}
					{{ else }}
						<textarea name="options[{{ mod_id }}]"></textarea>
					{{ endif }}
					</div>
				</li>
			{{ /modifiers }}
				<li>
					<label for="product_quantity"><?php echo lang('firesale:product:label_qty'); ?></label>
					<div class="input">
						<input id="product_quantity" name="qty[]" size="3" value="1" type="text" />
					</div>
				</li>
			</ul>

			<div class="buttons">
				<button type="submit" name="btnAction" value="cart"><?php echo lang('firesale:product:label_add_to_cart'); ?></button>
			</div>

		</fieldset>
	</form>
