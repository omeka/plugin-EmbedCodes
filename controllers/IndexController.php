<?php

class EmbedCodes_IndexController extends Omeka_Controller_AbstractActionController
{
        
    public function init()
    {        
        $this->_helper->db->setDefaultModelName('Item');
    }
    
    public function embedAction()
    {

        $item = $this->_helper->db->findById();
        $this->view->item = $item;
        
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $ip = $request->getClientIp();
        $host = $request->getHttpHost();
        
        $embed = $this->_helper->db->getTable('Embed')->findByIpAndIdOrNew($ip, $item->id);

        if(is_null($embed->first_view)) {
            $embed->first_view = date('Y-m-d H:i:s');
            $embed->view_count = 0;
            $embed->host = $host;
        }
        
        $embed->view_count = $embed->view_count + 1;
        $embed->last_view = date('Y-m-d H:i:s');
        $embed->save();

        
    }
}