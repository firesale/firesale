
      <div class="width-full confirmation">

        <div class="width-half">
          <h2>Shipping Address</h2>
          <ul>
            {{ if { helper:str_word_count string=ship_to.firstname } > 0 }}<li>{{ ship_to.fistname }}</li> {{ endif }}
            {{ if { helper:str_word_count string=ship_to.address1 } > 0 }}<li>{{ ship_to.address1 }}</li> {{ endif }}
            {{ if { helper:str_word_count string=ship_to.address2 } > 0 }}<li>{{ ship_to.address2 }}</li> {{ endif }}
            {{ if { helper:str_word_count string=ship_to.city } > 0 }}<li>{{ ship_to.city }}</li> {{ endif }}
            {{ if { helper:str_word_count string=ship_to.county } > 0 }}<li>{{ ship_to.county }}</li> {{ endif }}
            {{ if { helper:str_word_count string=ship_to.postcode } > 0 }}<li>{{ ship_to.postcode }}</li> {{ endif }}
            <li>{{ ship_to.country.name }}</li>
          </ul>
        </div>

        <div class="width-hal">
          <h2>Payment Address</h2>
          <ul>
            {{ if { helper:str_word_count string=bill_to.firstname } > 0 }}<li>{{ bill_to.fistname }}</li> {{ endif }}
            {{ if { helper:str_word_count string=bill_to.address1 } > 0 }}<li>{{ bill_to.address1 }}</li> {{ endif }}
            {{ if { helper:str_word_count string=bill_to.address2 } > 0 }}<li>{{ bill_to.address2 }}</li> {{ endif }}
            {{ if { helper:str_word_count string=bill_to.city } > 0 }}<li>{{ bill_to.city }}</li> {{ endif }}
            {{ if { helper:str_word_count string=bill_to.county } > 0 }}<li>{{ bill_to.county }}</li> {{ endif }}
            {{ if { helper:str_word_count string=bill_to.postcode } > 0 }}<li>{{ bill_to.postcode }}</li> {{ endif }}
            <li>{{ bill_to.country.name }}</li>
          </ul>
        </div>

        <br class="clear" />
        <br />
    
        <h2>Products</h2>

        <table class="standard orders" width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <th>Product</th>
            <th>Model</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th width="130">Total</th>
          </tr>
{{ items }}
          <tr>
            <td class="align-left"><strong>{{ name }}</strong></td>
            <td>{{ code }}</td>
            <td>{{ qty }}</td>
            <td><span>{{ settings:currency }}</span>{{ price }}</td>
            <td><span>{{ settings:currency }}</span>{{ total }}</td>
          </tr>
{{ /items }}
          <tr>
            <td class="align-right" colspan="4"><strong>Sub-Total:</strong></td>
            <td><span>{{ settings:currency }}</span>{{ price_sub }}</td>
          </tr>
          <tr>
            <td class="align-right" colspan="4"><strong>Shipping:</strong></td>
            <td><span>{{ settings:currency }}</span>{{ price_ship }}</td>
          </tr>
          <tr class="last">
            <td class="large align-right" colspan="4"><strong>Total:</strong></td>
            <td class="large price"><span>{{ settings:currency }}</span>{{ price_total }}</td>
          </tr>
        </table>

        <br class="clear" />
        <br />

        <h2>Order Status</h2>

        <table class="standard orders" width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <th width="150">Status</th>
            <th>Message</th>
          </tr>
          <tr>
            <td>{{ status.value }}</td>
            <td>{{ status.message }}</td>
          </tr>
        </table>

      </div>