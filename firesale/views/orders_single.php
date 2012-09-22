
      <div class="firesale width-full confirmation">

        <div class="width-half">
          <h2><?php echo lang('firesale:orders:labe_shipping_address'); ?></h2>
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

        <div class="width-half">
          <h2><?php echo lang('firesale:orders:labe_payment_address'); ?></h2>
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
            <td><span>{{ settings:currency }}</span>{{ price }}</td>
            <td><span>{{ settings:currency }}</span>{{ total }}</td>
          </tr>
{{ /items }}
          <tr>
            <td class="align-right" colspan="4"><strong><?php echo lang('firesale:cart:label_sub_total'); ?>:</strong></td>
            <td><span>{{ settings:currency }}</span>{{ price_sub }}</td>
          </tr>
          <tr>
            <td class="align-right" colspan="4"><strong><?php echo lang('firesale:tabs:shipping'); ?>:</strong></td>
            <td><span>{{ settings:currency }}</span>{{ price_ship }}</td>
          </tr>
          <tr class="last">
            <td class="large align-right" colspan="4"><strong><?php echo lang('firesale:cart:label_total'); ?>:</strong></td>
            <td class="large price"><span>{{ settings:currency }}</span>{{ price_total }}</td>
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