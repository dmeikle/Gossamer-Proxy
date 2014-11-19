<?php

namespace components\geography\serialization;

use core\serialization\Serializer;

/**
 * Description of ContactSerializer
 *
 * @author davem
 */
class ProvinceSerializer extends Serializer{
    
    public function pruneList(array $list) {
        $retval = array();
        
        foreach($list as $row) {
            $retval[$row['id']] = $row['province'];
        }
        
        return $retval;
    }
    
}
