
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
					<input type="radio" name="option_{{ mod_id }}" id="option_{{ mod_id }}" value="{{ id }}" {{ selected }}/>
					<label for="option_{{ mod_id }}">{{ title }} ({{ price }})</label><br />
				{{ /variations }}
				{{ else }}
					<textarea name="option_{{ mod_id }}"></textarea>
				{{ endif }}
				</div>
			</li>
		{{ /modifiers }}
		</ul>

		<div class="buttons">
			<button type="submit" name="btnAction" value="cart">Add to Cart</button>
		</div>

	</fieldset>
