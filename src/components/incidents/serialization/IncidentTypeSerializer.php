<?php

namespace components\incidents\serialization;

use core\serialization\Serializer;

/**
 * Description of IncidentTypeSerializer
 *
 * @author davem
 */
class IncidentTypeSerializer extends Serializer{
    
    
    public function formatSectionsForSelection(array $list = null) {
      
        if(is_null($list) || !is_array($list)) {
            return array();
        }
        
        $retval = array();
        
        foreach($list as $row) {
           
            $retval[$row['id']] = $row['section'];
        }
         
        return $retval;
    }
    
}
