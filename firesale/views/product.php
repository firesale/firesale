
      <div class="width-threefourth firesale product">
        <section class="product-images">
          <ul>
<?php if( isset($images) && !empty($images) ): ?>
<?php foreach( $images AS $key => $image ): ?>
<?php if( $key == 0 ): ?>
            <li class="main">
              <a href="{{ url:base }}files/thumb/<?php echo $image->id; ?>/1000/1000" id="image-<?php echo $image->id; ?>" class="cloud-zoom" rel="position:'inside'">
                <span class="zoom"></span>
                <img src="{{ url:base }}files/thumb/<?php echo $image->id; ?>/400/400" alt="<?php echo $image->name; ?>" />
              </a>
            </li>
<?php elseif( $key <= 3 ): ?>
            <li>
              <a href="{{ url:base }}files/thumb/<?php echo $image->id; ?>/1000/1000" id="image-<?php echo $image->id; ?>">
                <img src="{{ url:base }}files/thumb/<?php echo $image->id; ?>/92/92" alt="<?php echo $image->name; ?>" />
              </a>
            </li>
<?php endif ?>
<?php endforeach; ?>
<?php else: ?>
            <li class="main"><a href="#"><div class="no_image_332"></div></a></li>
<?php endif; ?>
          </ul>
          <br class="clear" />
        </section>
        <section class="product-details">
          <ul>
            <li class="availability"><strong><?php echo lang('firesale:product:label_availability'); ?></strong>{{ product.stock_status.value }} ({{ product.stock }})</li>
            <li class="model"><strong><?php echo lang('firesale:product:label_model'); ?></strong>{{ product.title }}</li>
            <li class="prodid"><strong><?php echo lang('firesale:product:label_product_code'); ?></strong><span><?php echo $product['code']; ?></span></li>
          </ul>
          <section class="price-round large"><span class="rrp">{{ if product.rrp > product.price }}{{ product.rrp_formatted }}{{ endif }}</span><span class="price">{{ product.price_formatted }}</span></section>
          <br class="clear" />
        </section>
            <section class="product-buy">
          {{ firesale:modifier_form type="select" product=product.id }}
        </section>
        <section id="product-description">
          {{ product.description }}
        </section>
        <br class="clear" />
      </div>
