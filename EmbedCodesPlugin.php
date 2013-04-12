<?php

class EmbedCodesPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array('install', 
                              'uninstall', 
                              'define_routes',
                              'public_items_show',
                              'admin_items_show_sidebar'
                              );
    
    protected $_filters = array('admin_navigation_main');
    
    public function hookInstall()
    {
        $db = $this->_db;
        $sql = "            
            CREATE TABLE IF NOT EXISTS `$db->Embed` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `item_id` int(10) unsigned NOT NULL,
              `url` text NOT NULL,
              `host` tinytext NOT NULL,
              `first_view` date DEFAULT NULL,
              `last_view` date DEFAULT NULL,
              `view_count` int(11) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM ; ";
        $db->query($sql);
    }
    
    public function hookUninstall()
    {
        $db = $this->_db;
        $sql = "DROP TABLE IF EXISTS `$db->Embed`; ";
        $db->query($sql);
    }
    
    public function hookPublicItemsShow($args)
    {
        $item = $args['item'];
        $uri = absolute_url(array('controller'=>'items', 'action'=>'embed', 'id'=>$item->id), 'id');
        $iframe = "<iframe id='clippy' width='640' height='360' src='$uri'></iframe>";
        $clippy = '
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
        width="110"
        height="14"
        id="clippy" >
<param name="movie" value="' . WEB_PLUGIN . '/EmbedCodes/clippy.swf"/>
<param name="allowScriptAccess" value="always" />
<param name="quality" value="high" />
<param name="scale" value="noscale" />
<param NAME="FlashVars" value="text=' . $iframe . '">

<embed src="' . WEB_PLUGIN . '/EmbedCodes/clippy.swf"
       width="110"
       height="14"
       name="clippy"
       quality="high"
       allowScriptAccess="always"
       type="application/x-shockwave-flash"
       pluginspage="http://www.macromedia.com/go/getflashplayer"
       FlashVars="text=' . $iframe . '"
       
/>
</object>
                        ';
        echo "Embed " . $clippy;
    }
    
    public function hookAdminItemsShowSidebar($args)
    {
        $item = $args['item'];
        $embedTable = get_db()->getTable('Embed');
        $totalEmbeds = $embedTable->totalEmbeds($item->id);
        $allEmbeds = $embedTable->findBy(array('item_id'=>$item->id));
        $html = "<div class='panel'>";
        $html .= "<h4>" . __("Embeds") . "</h4>";
        $html .= "<p>" . __("Total views: %d", $totalEmbeds) . "</p>";
        $html .= "<p>" . __("Total embeds: %d", count($allEmbeds)) .  "</p>";
        $html .= "<p class='explanation'>" . __("Date is last viewed. Click to see the page.") . "</p>";
        $html .= "<ul>";
        foreach($allEmbeds as $embed) {
            $html .= "<li>";
            $html .= "<a href='{$embed->url}'>{$embed->last_view}</a> ";
            $html .= __("(%d views)", $embed->view_count);
            $html .= "</li>";
        }
        $html .= "</ul>";
        $html .= "</div>";
        echo $html;
    }
    
    public function hookDefineRoutes($array)
    {        
        $router = $array['router'];
        $router->addRoute(
            'embed',
            new Zend_Controller_Router_Route(
                'items/embed/:id',
                array(
                    'module'       => 'embed-codes',
                    'controller'   => 'index',
                    'action'       => 'embed',
                )
            )
        );        
    }
    
    public function filterAdminNavigationMain($navArray)
    {
        $navArray['EmbedCodes'] = array('label'=>__('Embedded Items'), 'uri'=>url('embed-codes'));
        return $navArray;
    }
}