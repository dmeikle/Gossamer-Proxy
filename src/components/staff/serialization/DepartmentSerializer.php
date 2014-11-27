<?php

namespace components\staff\serialization;

use core\serialization\Serializer;
/**
 * Description of WorkPerformed
 *
 * @author davem
 */
class DepartmentSerializer extends Serializer{
    
    public function formatDepartmentsArray(array $list) {
        $retval = array();
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            if(!array_key_exists('id', $row)) {
                return array();
            }
           
            $retval[$row['id']] = $row['name'];
        }
        
        return $retval;
    }
}
