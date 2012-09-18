      
      <div class="width-threefourth firesale product">
        <section class="product-images">
          <ul>
{{ if images != false }}
{{ images }}
{{ if i == 0 }}
            <li class="main">
              <a href="/files/thumb/{{ id }}/1000/1000" id="image-{{ id }}" class="cloud-zoom" rel="position:'inside'">
                <span class="zoom"></span>
                <img src="/files/thumb/{{ id }}/400/400" alt="{{ name }}" />
              </a>
            </li>
{{ elseif i <= 3 }}
            <li>
              <a href="/files/thumb/{{ id }}/1000/1000" id="image-{{ id }}">
                <img src="/files/thumb/{{ id }}/92/92" alt="{{ name }}" />
              </a>
            </li>
{{ endif }}
{{ /images}}
{{ else }}
            <li class="main"><a href="#"><div class="no_image_332"></div></a></li>
{{ endif }}
          </ul>
          <br class="clear" />
        </section>
        <section class="product-details">
          <ul>
            <li class="availability"><strong><?php echo lang('firesale:product:label_availability'); ?></strong>{{ product.stock_status.value }} ({{ product.stock }})</li>
            <li class="model"><strong><?php echo lang('firesale:product:label_model'); ?></strong>{{ product.title }}</li>
            <li class="prodid"><strong><?php echo lang('firesale:product:label_product_code'); ?></strong><span><?php echo $product['code']; ?></span></li>
          </ul>
          <section class="price-round large"><span class="rrp">{{ if product.rrp > product.price }}{{ product.rrp }}{{ endif }}</span><span class="price">{{ product.price }}</span><span class="currency">{{ settings:currency }}</span></section>
          <br class="clear" />
        </section>
		    <section class="product-buy">
          <form method="post" action="/cart/insert/{{ product.id }}">
            <input type="hidden" name="id" value="{{ product.id }}" />
            <label for="product_quantity"><?php echo lang('firesale:product:label_qty'); ?></label><input id="product_quantity" size="3" value="1" type="text" />
            <button type="submit" class="btn"><?php echo lang('firesale:product:label_add_to_cart'); ?></button>
          </form>
        </section>
        <section id="product-description">
          {{ product.description }}
        </section>
      </div>
