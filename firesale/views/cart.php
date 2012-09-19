
      <form method="post" action="/cart/update" class="firesale">

        <table class="cart">
          <thead>
            <tr>
              <th class="remove"><?php echo lang('firesale:cart:label_remove'); ?></th>
              <th class="image"><?php echo lang('firesale:cart:label_image'); ?></th>
              <th class="name"><?php echo lang('firesale:cart:label_name'); ?></th>
              <th class="model"><?php echo lang('firesale:cart:label_model'); ?></th>
              <th><?php echo lang('firesale:cart:label_quantity'); ?></th>
              <th><?php echo lang('firesale:cart:label_unit_price'); ?></th>
              <th><?php echo lang('firesale:cart:label_total'); ?></th>
            </tr>
          </thead>
          <tbody>
{{ if contents != false }}
{{ contents }}
	  	    <tr>
              <td class="remove"><input type="checkbox" name="item[{{ rowid }}][remove]" value="1" /></td>
              <td class="image">{{ if { helper:string_word_count string=image } > 0 }}<img src="{{ site:url }}files/thumb/{{ image }}/100/100" alt="image" />{{ else }}<div class="no_image_60"></div>{{ endif }}</td>
              <td class="name"><a href="/product/{{ slug }}">{{ name }}</a></td>
              <td class="model">{{ code }}</td>
              <td><input type="text" name="item[{{ rowid }}][qty]" value="{{ qty }}" /></td>
              <td>{{ settings:currency }} {{ helper:number_format string=price decimals="2" }}</td>
              <td>{{ settings:currency }} {{ helper:number_format string=subtotal decimals="2" }}</td>
            </tr>
{{ /contents }}
{{ else }}
            <tr><td colspan="7"><center><strong><?php echo lang('firesale:cart:label_no_items_in_cart'); ?></strong></center></td></tr>
{{ endif }}
          </tbody>
        </table>

        <section id="cart-buttons">
          <div class="right">
            <button type="submit" name="btnAction" value="update" class="btn"><span><?php echo lang('firesale:cart:button_update'); ?></span></button>
            <button type="submit" name="btnAction" value="checkout" class="btn"><span><?php echo lang('firesale:cart:button_goto_checkout'); ?></span></button>
          </div>
        </section>

        <section id="cart-totals">
          <ul>
            <li><label><?php echo lang('firesale:cart:label_sub_total'); ?>:</label><span>{{ settings:currency }} {{ subtotal }}</span></li>
            <li><label><?php echo lang('firesale:cart:label_tax'); ?> ({{ tax_percent }}%):</label><span>{{ settings:currency }} {{ tax }}</span></li>
            <li class="large"><label><?php echo lang('firesale:cart:label_total'); ?>:</label><span>{{ settings:currency }} {{ total }}</li>
          </ul>
          <br class="clear" />
        </section>

      </form>
