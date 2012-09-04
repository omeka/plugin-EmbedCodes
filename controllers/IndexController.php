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
        
    }
}