<!DOCTYPE html>
<html>
<head>
<?php
queue_css_file('style');
echo head_css();
?>
</head>
<body>
<div>
<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
<?php fire_plugin_hook('embed_codes_content', array('item'=>$item, 'view'=>$this)); ?>
<?php if (metadata('item', 'has files')): ?>
    <div class="element-text"><?php echo files_for_item(); ?></div>
<?php endif; ?>

</div>
</body>
</html>