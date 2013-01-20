
    <div class="firesale">

{{ addresses }}
      <section class="order small">
        <header>
          <h3>{{ title }}</h3>
        </header>
        <ul>
            {{ if firstname }}<li>{{ firstname }} {{ lastname }}</li> {{ endif }}
            {{ if address1 }}<li>{{ address1 }}</li> {{ endif }}
            {{ if address2 }}<li>{{ address2 }}</li> {{ endif }}
            {{ if city }}<li>{{ city }}</li> {{ endif }}
            {{ if county }}<li>{{ county }}</li> {{ endif }}
            {{ if postcode }}<li>{{ postcode }}</li> {{ endif }}
            <li>{{ country.name }}</li>
        </ul>
        <footer>
          <span>&nbsp;</span>
          <a href="{{ firesale:url route="addresses" }}/edit/{{ id }}"><?php echo lang('firesale:addresses:edit_address'); ?></a>
        </footer>
      </section>

{{ /addresses }}
      <br class="clear" />

    </div>

    <a href="{{ firesale:url route="addresses" }}/create" class="btn"><span><?php echo lang('firesale:addresses:new_address'); ?></span></a>
