<?php
$title = empty($item)
    ? __('[Deleted] (#%d)', $embeds[0]->item_id)
    : metadata($item, array('Dublin Core', 'Title'));

echo head(array(
    'title'=>__('Embed Statistics for "%s"', $title),
    'bodyclass' => 'embed browse',
));

?>
<div id='primary'>
<p><?php echo __('Total embeds: %d', $total); ?></p>

<div class="pagination"><?php echo pagination_links(); ?></div>


<table>
    <thead>
    <tr>
        <?php
        $browseHeadings[__('Site')] = null;
        $browseHeadings[__('Link')] = null;
        $browseHeadings[__('First viewed')] = 'first_view';
        $browseHeadings[__('Last viewed')] = 'last_view';
        $browseHeadings[__('Views')] = 'view_count';
        echo browse_sort_links($browseHeadings, array('link_tag' => 'th scope="col"', 'list_tag' => '')); 
        ?>    
    </tr>
    </thead>
    <tbody>
    
    <?php foreach(loop('embed', $embeds) as $embed):?>
    <tr>
        <td><?php echo $embed->host; ?></td>
        <td><a href="<?php echo $embed->url; ?>"><?php echo $embed->url; ?></a></td>
        <td><?php echo metadata('embed', 'first_view'); ?></td>
        <td><?php echo metadata('embed', 'last_view'); ?></td>
        <td><?php echo metadata('embed', 'view_count'); ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>



</div>