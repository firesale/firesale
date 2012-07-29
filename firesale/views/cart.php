
      <form method="post" action="/cart/update">

        <table class="cart">
          <thead>
            <tr>
              <th class="remove">Remove</th>
              <th class="image">Image</th>
              <th class="name">Name</th>
              <th class="model">Model</th>
              <th>Quanity</th>
              <th>Unit Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
{{ if contents != false }}
{{ contents }}
	  	    <tr>
              <td class="remove"><input type="checkbox" name="item[{{ rowid }}][remove]" value="1" /></td>
              <td class="image">{{ if { helper:string_word_count string=image } > 0 }}<img src="{{ site:url }}files/thumb/{{ image }}/100/100" alt="image" />{{ else }}{{ theme:image file="notfound_xs.jpg" alt="Not Found" }}{{ endif }}</td>
              <td class="name"><a href="/product/{{ slug }}">{{ name }}</a></td>
              <td class="model">{{ code }}</td>
              <td><input type="text" name="item[{{ rowid }}][qty]" value="{{ qty }}" /></td>
              <td>{{ settings:currency }} {{ helper:number_format string=price decimals="2" }}</td>
              <td>{{ settings:currency }} {{ helper:number_format string=subtotal decimals="2" }}</td>
            </tr>
{{ /contents }}
{{ else }}
            <tr><td colspan="7"><center><strong>No items in your cart</strong></center></td></tr>
{{ endif }}
          </tbody>
        </table>

        <section id="cart-totals">
          <ul>
            <li><label>Sub-Total:</label><span>{{ settings:currency }} {{ subtotal }}</span></li>
            <li><label>Tax ({{ tax_percent }}%):</label><span>{{ settings:currency }} {{ tax }}</span></li>
            <li class="large"><label>Total:</label><span>{{ settings:currency }} {{ total }}</li>
          </ul>
          <br class="clear" />
        </section>

        <section id="cart-buttons">
          <div class="right">
            <button type="submit" name="btnAction" value="update" class="btn"><span>Update Cart</span></button>
            <button type="submit" name="btnAction" value="checkout" class="btn"><span>Goto Checkout</span></button>
          </div>
        </section>

      </form>
