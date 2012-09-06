<?php
queue_css('style');
display_css();
?>

<div>
<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

<?php 
if(item_has_thumbnail()) {
    echo item_thumbnail();    
}
?>
</div>
