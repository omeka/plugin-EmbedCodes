<?php

class Table_Embed extends Omeka_Db_Table
{
    public function findByIpAndIdOrNew($ip, $id)
    {
        $select = $this->getSelectForFindBy(array('ip'=>$ip, 'item_id'=>$id));
        
        $embed = $this->fetchObject($select);
        if(empty($embed)) {
            $embed = new Embed;
            $embed->ip = $ip;
            $embed->item_id = $id;
        }
        return $embed;
    }
}