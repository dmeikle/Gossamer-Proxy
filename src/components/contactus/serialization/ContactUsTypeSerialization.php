<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contactus\serialization;

use core\serialization\Serializer;

/**
 * Description of CompanyTypeSerialization
 *
 * @author Dave Meikle
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
