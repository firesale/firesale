
    <div class="firesale">

{{ orders }}
      <section class="order small">
        <header>
          <h3>Order ID: <span>#{{ id }}</span></h3>
          <h3 class="right">{{ status.value }}</h3>
        </header>
        <ul>
          <li><strong>Date Placed:</strong> {{ helper:date timestamp=created format="d/m/Y" }}
          <li><strong>Customer:</strong> {{ created_by.display_name }}</li>
          <li><strong>Products:</strong> {{ count }}</li>
        </ul>
        <footer>
          <span>{{ settings:currency }}{{ price_total }}</span>
          <a href="/users/orders/{{ id }}">View Order</a>
        </footer>
      </section>

{{ /orders }}
      <br class="clear" />

    </div>
