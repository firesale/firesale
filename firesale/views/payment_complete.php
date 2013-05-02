
      <div class="firesale width-full confirmation">

        <div class="width-half">
          <h2><?php echo lang('firesale:orders:labe_shipping_address'); ?></h2>
          <ul>
            {{ if ship_to.firstname }}<li>{{ ship_to.firstname }} {{ ship_to.lastname }}</li> {{ endif }}
            {{ if ship_to.address1 }}<li>{{ ship_to.address1 }}</li> {{ endif }}
            {{ if ship_to.address2 }}<li>{{ ship_to.address2 }}</li> {{ endif }}
            {{ if ship_to.city }}<li>{{ ship_to.city }}</li> {{ endif }}
            {{ if ship_to.county }}<li>{{ ship_to.county }}</li> {{ endif }}
            {{ if ship_to.postcode }}<li>{{ ship_to.postcode }}</li> {{ endif }}
            <li>{{ ship_to.country.name }}</li>
          </ul>
        </div>

        <div class="width-half">
          <h2><?php echo lang('firesale:orders:labe_payment_address'); ?></h2>
          <ul>
            {{ if bill_to.firstname }}<li>{{ bill_to.firstname }} {{ bill_to.lastname }}</li> {{ endif }}
            {{ if bill_to.address1 }}<li>{{ bill_to.address1 }}</li> {{ endif }}
            {{ if bill_to.address2 }}<li>{{ bill_to.address2 }}</li> {{ endif }}
            {{ if bill_to.city }}<li>{{ bill_to.city }}</li> {{ endif }}
            {{ if bill_to.county }}<li>{{ bill_to.county }}</li> {{ endif }}
            {{ if bill_to.postcode }}<li>{{ bill_to.postcode }}</li> {{ endif }}
            <li>{{ bill_to.country.name }}</li>
          </ul>
        </div>

        <br class="clear" />
        <br />

        <h2><?php echo lang('firesale:orders:label_products'); ?></h2>

        <table class="firesale standard orders" width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <th><?php echo lang('firesale:label_product'); ?></th>
            <th><?php echo lang('firesale:product:label_model'); ?></th>
            <th><?php echo lang('firesale:cart:label_quantity'); ?></th>
            <th><?php echo lang('firesale:cart:label_unit_price'); ?></th>
            <th width="130"><?php echo lang('firesale:cart:label_total'); ?></th>
          </tr>
{{ items }}
          <tr>
              <td class="align-left"><strong>{{ name }}</strong></td>
              <td>{{ code }}</td>
              <td>{{ qty }}</td>
              <td>{{ price }}</td>
              <td>{{ total }}</td>
          </tr>
{{ /items }}
          <tr>
            <td class="align-right" colspan="4"><strong><?php echo lang('firesale:cart:label_sub_total'); ?>:</strong></td>
            <td>{{ price_sub }}</td>
          </tr>
          <tr>
            <td class="align-right" colspan="4"><strong><?php echo lang('firesale:tabs:shipping'); ?>:</strong></td>
            <td>{{ price_ship }}</td>
          </tr>
          <tr class="last">
            <td class="large align-right" colspan="4"><strong><?php echo lang('firesale:cart:label_total'); ?>:</strong></td>
            <td class="large price">{{ price_total }}</td>
          </tr>
        </table>

        <br class="clear" />
        <br />

        <h2><?php echo lang('firesale:orders:label_order_status'); ?></h2>

        <table class="firesale standard orders" width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <th width="150"><?php echo lang('firesale:label_status'); ?></th>
            <th><?php echo lang('firesale:orders:label_message'); ?></th>
          </tr>
          <tr>
            <td>{{ status.value }}</td>
            <td>{{ status.message }}</td>
          </tr>
        </table>

      </div>
