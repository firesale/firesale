<?php if( !empty($results) ): ?>
        <table>
            <thead>
                <th style="width: 70%">Search Term</th>
                <th>Count</th>
                <th>Sales</th>
            </thead>
            <tbody>
<?php foreach( $results AS $result ): ?>
                <tr>
                    <td><?php echo ucwords($result['term']); ?></td>
                    <td><?php echo number_format($result['count']); ?></td>
                    <td><?php echo number_format($result['sales']); ?></td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>
<?php else: ?>
        <div class="no_data"><?php echo lang('firesale:search:no_terms'); ?></div>
<?php endif;
