<?php

namespace components\workperformed\serialization;

use core\serialization\Serializer;
/**
 * Description of WorkPerformed
 *
 * @author davem
 */
class WorkPerformedSerializer extends Serializer{
    
    public function pruneList(array $list) {
        $retval = array();
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            if(!array_key_exists('id', $row)) {
                return array();
            }
            //jquery ui needs these 3 values - id, label, value
            $retval[$row['id']] = $row['description'];
        }
        
        return $retval;
    }
}
