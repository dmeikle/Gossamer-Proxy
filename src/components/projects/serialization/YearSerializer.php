<?php

namespace components\projects\serialization;

use core\serialization\Serializer;


/**
 * Description of YearSerializer
 *
 * @author davem
 */
class YearSerializer extends Serializer{
    
    public function pruneList(array $list) {
        $retval = array();
        
        foreach($list as $row) {
            $retval[$row] = $row;
        }
        
        return $retval;
    }
}
