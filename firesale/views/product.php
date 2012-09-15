      <div class="width-threefourth firesale">
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
            <li class="main"><a href="#">{{ theme:image file="notfound_l.jpg" alt="Not Found" }}</a></li>
{{ endif }}
          </ul>
          <br class="clear" />
        </section>
        <section class="product-details">
          <ul>
            <li class="availability"><strong>Availability</strong>{{ product.stock_status.value }} ({{ product.stock }})</li>
            <li class="model"><strong>Model</strong>{{ product.title }}</li>
            <li class="prodid"><strong>Product Code</strong><span><?php echo $product['code']; ?></span></li>
          </ul>
          <section class="price-round large"><span class="rrp">{{ if product.rrp > product.price }}{{ product.rrp }}{{ endif }}</span><span class="price">{{ product.price }}</span><span class="currency">{{ settings:currency }}</span></section>
          <br class="clear" />
          <hr />
        </section>
		<section class="product-buy">
          <form method="post" action="/cart/insert">
            <input type="hidden" name="id" value="{{ product.id }}" />
            <label for="product_quantity">Qty:</label><input id="product_quantity" size="3" value="1" type="text" />
            <a href="#cart-mini"><span class="text"><span class="icon"></span> Add to Cart</span></a>
          </form>
        </section>
        <br class="clear" />
        <div id="product-tabs" class="width-threefourth">
          <ul class="tabs">
            <li class="selected"><a href="#product-description">Description</a></li>
          </ul>
          <div class="tabs-container">
            <section id="product-description">

              {{ product.description }}

            </section>
          </div>
        </div>
      </div>

      <div class="firesale width-onefourth sidebar last">

        <h2>Categories</h2>
        <ul class="icon-arrow categories">
{{ firesale:categories limit="0" }}
{{ if parent == id }}
          <li>
            <a href="/category/{{ slug }}"><strong>{{ title }}</strong></a>
            <ul>
{{ firesale:sub_categories category=parent limit="0" }}
              <li><a href="/category/{{ slug }}">{{ if product.category.id == id }}<strong>{{ title }}</strong>{{ else }}{{ title }}{{ endif }}</a></li>
{{ /firesale:sub_categories }}
            </ul>
          </li>
{{ else }}
          <li><a href="/category/{{ slug }}">{{ title }}</a></li>
{{ endif }}
{{ /firesale:categories }}
        </ul>

        <h2>Best Sellers</h2>
        <ol class="products">
{{ firesale:get_products }}
          <li>
            <img src="{{ image }}" alt="{{ title }}" /><a href="/product/{{ slug }}{{ extra }}">{{ title }}</a>
            <span>{{ settings:currency }}{{ price }}</span>
{{ firesale_reviews:product_rating width=50 id=get_products.id }}            <span class="stars-small"><span style="width: {{ width }}px"></span>{{ rating }}</span>{{ /firesale_reviews:product_rating }}
          </li>
{{ /firesale:get_products }}
          <li class="more"><a href="#">more...</a></li>
        </ol>

      </div>

      <br class="clear" />
