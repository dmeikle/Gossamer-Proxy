<?php

namespace components\companies\serialization;

use core\serialization\Serializer;

/**
 * Description of CompanyTypeSerialization
 *
 * @author davem
 */
class CompanyTypeSerialization extends Serializer{
    
    
    public function pruneCompanyTypes(array $list) {
        $retval = array();
        
        foreach($list as $row) {
            $retval[$row['id']] = $row['type'];
        }
        
        return $retval;
    }
}
