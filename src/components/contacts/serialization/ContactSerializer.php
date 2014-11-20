<?php

namespace components\contacts\serialization;

use core\serialization\Serializer;

/**
 * Description of ContactSerializer
 *
 * @author davem
 */
class ContactSerializer extends Serializer{
    
    public function formatContactSearchResults(array $list) {
        $retval = array();
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            if(!array_key_exists('id', $row)) {
                return array();
            }
            //jquery ui needs these 3 values - id, label, value
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['firstname'] . ' ' .$row['lastname'] . ((strlen($row['name']) > 0) ? ' - ' . $row['name'] : ''),
                'value' => $row['firstname'] . ' ' .$row['lastname'] . ((strlen($row['name']) > 0) ? ' - ' . $row['name'] : '')
            );
        }
        
        return $retval;
    }
}
