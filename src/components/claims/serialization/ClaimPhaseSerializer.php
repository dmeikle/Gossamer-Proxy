<?php

namespace components\claims\serialization;

use core\serialization\Serializer;

/**
 * Description of ClaimPhaseSerialization
 *
 * @author davem
 */
class ClaimPhaseSerializer extends Serializer{
    
    
    public function formatPhasesForSelection(array $list = null) {
      
        if(is_null($list) || !is_array($list)) {
            return array();
        }
        
        $retval = array();
        
        foreach($list as $row) {
           
            $retval[$row['id']] = $row['description'];
        }
         
        return $retval;
    }
}
