<?php

namespace components\contactus\serialization;

use core\serialization\Serializer;

/**
 * Description of CompanyTypeSerialization
 *
 * @author davem
 */
class ContactUsTypeSerialization extends Serializer{
    
    
    public function pruneContactUsTypes(array $list) {
        $retval = array();
        
        foreach($list as $row) {
            $retval[$row['id']] = $row['type'];
        }
        
        return $retval;
    }
}
