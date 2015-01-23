<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\incidents\serialization;

use core\serialization\Serializer;

/**
 * Description of IncidentTypeSerializer
 *
 * @author Dave Meikle
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
