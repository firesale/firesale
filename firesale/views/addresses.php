
    <div class="firesale">

{{ addresses }}
      <section class="order small">
        <header>
          <h3>{{ title }}</h3>
        </header>
        <ul>
            {{ if { helper:str_word_count string=firstname } > 0 }}<li>{{ firstname }} {{ lastname }}</li> {{ endif }}
            {{ if { helper:str_word_count string=address1 } > 0 }}<li>{{ address1 }}</li> {{ endif }}
            {{ if { helper:str_word_count string=address2 } > 0 }}<li>{{ address2 }}</li> {{ endif }}
            {{ if { helper:str_word_count string=city } > 0 }}<li>{{ city }}</li> {{ endif }}
            {{ if { helper:str_word_count string=county } > 0 }}<li>{{ county }}</li> {{ endif }}
            {{ if { helper:str_word_count string=postcode } > 0 }}<li>{{ postcode }}</li> {{ endif }}
            <li>{{ country.name }}</li>
        </ul>
        <footer>
          <span>&nbsp;</span>
          <a href="/users/addresses/edit/{{ id }}"><?php echo lang('firesale:addresses:edit_adress'); ?></a>
        </footer>
      </section>

{{ /addresses }}
      <br class="clear" />

    </div>
    
    <a href="/users/addresses/create" class="btn"><span><?php echo lang('firesale:addresses:new_adress'); ?></span></a>
