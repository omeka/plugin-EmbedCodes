<!DOCTYPE html>
<html>
<head>
<?php
$css = "
.thumbnail { margin: 0 auto 20px; }
.thumbnail img { vertical-align: bottom; border: 1px solid #e7e7e7; max-height: 150px; width: auto;}
h1 { margin: 0; }
html { font-family: 'Helvetica', 'Arial', sans-serif; text-align: center; }
body { margin: 20px 20px 0 20px; }
.source { position: fixed; bottom: 0; left: 0; right: 0; background-color:  #e7e7e7; margin: 20px -20px 0; padding: 10px 5px; font-size: .75em; }
.rights { margin: 0; font-size: .75em; display: block; cursor: pointer; color: #fff; background-color: maroon; padding: 5px 10px; position: fixed; top: 0; left: 0; text-align: left; font-weight: bold; }
.explanation { display: none; }
.caption { display: inline; padding-bottom: 55px; }
.rights:hover .explanation { display: inline-block; text-align: left; font-weight: normal; margin: 1em 0 0; }
";
queue_css_string($css);
echo head_css();
?>
<?php $rights = metadata($item, array('Dublin Core', 'Rights')); ?>
</head>
<body>
<div>
<?php if (metadata('item', 'has files')): ?>
    <?php $files = $item->Files; ?>
    <div class="thumbnail"><?php echo file_image('thumbnail', array(), $files[0]); ?></div>
<?php endif; ?>
    <div class='content'>
        <div class="caption"><a target='_blank' href="<?php echo record_url($item, 'show') ; ?>"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></a></div>
        <?php if($rights != ''): ?>
        <p class="rights"><?php echo __('Rights'); ?><span class="explanation"><?php echo $rights; ?></span></p>
        <?php endif; ?>
        <p class="source"><?php echo __('From: '); ?><?php echo link_to_home_page(null, array('target'=>'_blank')); ?></p>
        <?php fire_plugin_hook('embed_codes_content', array('item'=>$item, 'view'=>$this)); ?>
    </div>


</div>
</body>
</html>