<?php

class EmbedCodes extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array('install', 
                              'uninstall', 
                              'define_routes',
                              'public_append_to_items_show'
                              );
    
    
    public function hookInstall()
    {
        
    }
    
    public function hookUninstall()
    {
        
    }
        
    
    public function hookPublicAppendToItemsShow($array)
    {

        $item = get_current_item();
        $uri = abs_uri(array('controller'=>'items', 'action'=>'embed', 'id'=>$item->id), 'id');
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
                        
        echo $clippy;
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
    
    
    
}