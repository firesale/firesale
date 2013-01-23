<table>
    <tfoot>
        <tr><td colspan="4"><strong><?php echo lang('firesale:cart:label_sub_total'); ?>:</strong> {{ sub }}</td></tr>
        <tr><td colspan="4"><strong><?php echo lang('firesale:cart:label_tax'); ?>:</strong> {{ tax }}</td></tr>
        <tr><td colspan="4"><strong><?php echo lang('firesale:cart:label_total'); ?>:</strong> {{ total }}</td></tr>
    </tfoot>
    <tbody>
    {{ if products }}
    {{ products }}
        <tr>
            <td><a href="{{ firesale:url route='product' id=id }}">{{ name }}</a></td>
            <td>{{ quantity }} x</td>
            <td>{{ price }}</td>
            <td><a href="{{ firesale:url route='cart' }}/remove/{{ id }}">x</a></td>
        </tr>
    {{ /products }}
    {{ else }}
        <tr><td colspan="4"><div class="nodata"><?php echo lang('firesale:cart:label_no_items_in_cart'); ?></div></td></tr>
    {{ endif }}
    </tbody>
</table>
<a href="{{ firesale:url route='cart' }}/checkout" class="btn right"><?php echo lang('firesale:cart:button_goto_checkout'); ?></a>
