<?php

namespace components\events\serialization;

use core\serialization\Serializer;

/**
 * Description of EventSerializer
 *
 * @author davem
 */
class EventTypeSerializer extends Serializer{
    
    public function pruneList(array $list) {
        $retval = array();
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            if(!array_key_exists('id', $row)) {
                return array();
            }

            $retval[$row['id']] = $row['type'];
        }
        
        return $retval;
    }
}
