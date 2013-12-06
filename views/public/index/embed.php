<!DOCTYPE html>
<html>
<head>
<?php
$css = "
.thumbnail { float:left; margin: 0 20px 20px 0; }
.thunbnail img { vertical-align: bottom; }
h1 { margin: 0; }
html { border: 1px solid #e7e7e7; font-family: 'Helvetica', 'Arial', sans-serif; margin: 2em 0; }
body { margin: 20px 20px 0 20px; }
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
    <div style='text-transform:uppercase;'><a target='_blank' href="<?php echo record_url($item, 'show') ; ?>"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></a></div>
        <p>
        <?php if($rights != ''): ?>
        <span><?php echo $rights; ?> | </span>
        <?php endif; ?>
        <?php echo __('From: '); ?><?php echo link_to_home_page(null, array('target'=>'_blank')); ?>
        </p>
         

        <?php fire_plugin_hook('embed_codes_content', array('item'=>$item, 'view'=>$this)); ?>
    </div>


</div>
</body>
</html>