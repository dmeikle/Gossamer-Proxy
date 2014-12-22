<?php

namespace components\events\serialization;

use core\serialization\Serializer;

/**
 * Description of EventLocationSerializer
 *
 * @author davem
 */
class EventContactSerializer extends Serializer{
    
    public function formatEventContactsArray(array $list) {
        $retval = array();
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            if(!array_key_exists('id', $row)) {
                return array();
            }

            $retval[$row['id']] = $row['name'] . ' - ' . $row['company'];
        }
        
        return $retval;
    }
}
