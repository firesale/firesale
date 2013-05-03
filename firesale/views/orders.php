    <div class="firesale">

{{ orders }}
      <section class="order small">
        <header>
          <h3><?php echo lang('firesale:orders:label_order_id'); ?>: <span>#{{ id }}</span></h3>
          <h3 class="right">{{ order_status.value }}</h3>
        </header>
        <ul>
          <li><strong><?php echo lang('firesale:orders:label_date_placed'); ?>:</strong> {{ helper:date timestamp=created format="d/m/Y" }}</li>
          <li><strong><?php echo lang('firesale:orders:label_customer'); ?>:</strong> {{ created_by.display_name }}</li>
          <li><strong><?php echo lang('firesale:orders:label_products'); ?>:</strong> {{ count }}</li>
        </ul>
        <footer>
          <span>{{ price_total_formatted }}</span>
          <a href="{{ firesale:url route="orders-single" id=id }}"><?php echo lang('firesale:orders:label_view_order'); ?></a>
        </footer>
      </section>

{{ /orders }}
      <br class="clear" />

    </div>
