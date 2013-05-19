      <div class="firesale width-full confirmation">

        <div class="firesale width-onethird">
          <h2>Shipping Address</h2>
          <ul>
            {{ if ship_to.firstname }}<li>{{ ship_to.firstname }}</li> {{ endif }}
            {{ if ship_to.address1 }}<li>{{ ship_to.address1 }}</li> {{ endif }}
            {{ if ship_to.address2 }}<li>{{ ship_to.address2 }}</li> {{ endif }}
            {{ if ship_to.city }}<li>{{ ship_to.city }}</li> {{ endif }}
            {{ if ship_to.county }}<li>{{ ship_to.county }}</li> {{ endif }}
            {{ if ship_to.postcode }}<li>{{ ship_to.postcode }}</li> {{ endif }}
            <li>{{ ship_to.country.name }}</li>
          </ul>
        </div>

        <div class="firesale width-onethird">
          <h2>Payment Address</h2>
          <ul>
            {{ if bill_to.firstname }}<li>{{ bill_to.firstname }}</li> {{ endif }}
            {{ if bill_to.address1 }}<li>{{ bill_to.address1 }}</li> {{ endif }}
            {{ if bill_to.address2 }}<li>{{ bill_to.address2 }}</li> {{ endif }}
            {{ if bill_to.city }}<li>{{ bill_to.city }}</li> {{ endif }}
            {{ if bill_to.county }}<li>{{ bill_to.county }}</li> {{ endif }}
            {{ if bill_to.postcode }}<li>{{ bill_to.postcode }}</li> {{ endif }}
            <li>{{ bill_to.country.name }}</li>
          </ul>
        </div>

        <div class="firesale width-onethird payment last">
          <h2>Payment Details</h2>
{{ payment }}
        </div>

        <br class="clear" />
        <br />

        <h2>Products</h2>

        <table class="firesale standard orders" width="100%" cellpadding="0" cellspacing="0" border="0">
          <thead>
          <tr>
            <th><?php echo lang('firesale:label_product'); ?></th>
            <th><?php echo lang('firesale:product:label_model'); ?></th>
            <th><?php echo lang('firesale:cart:label_quantity'); ?></th>
            <th><?php echo lang('firesale:cart:label_unit_price'); ?></th>
            <th width="130"><?php echo lang('firesale:cart:label_total'); ?></th>
          </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="4"><strong>Sub-Total:</strong></td>
              <td>{{ price_sub }}</td>
            </tr>
            <tr>
              <td colspan="4"><strong>Shipping:</strong></td>
              <td>{{ price_ship }}</td>
            </tr>
            <tr class="last">
              <td class="large" colspan="4"><strong>Total:</strong></td>
              <td class="large price">{{ price_total }}</td>
            </tr>
          </tfoot>
          <tbody>
{{ items }}
            <tr>
              <td class="align-left"><strong>{{ name }}</strong></td>
              <td>{{ code }}</td>
              <td>{{ qty }}</td>
              <td>{{ price_formatted }}</td>
              <td>{{ total }}</td>
            </tr>
{{ /items }}
          </tbody>
        </table>

      </div>
