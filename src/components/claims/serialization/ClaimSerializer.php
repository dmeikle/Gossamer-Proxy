<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\serialization;

use core\serialization\Serializer;

/**
 * ClaimSerialization
 *
 * @author Dave Meikle
 */
class ClaimSerializer extends Serializer {
    
    public function formatJobNumberResults(array $results) {
        $retval = array();
        if(!array_key_exists('Claims', $results)) {
            return array();
        }
        
        foreach($results['Claims'] as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['jobNumber'],
                'value' => $row['jobNumber']
                );
        }
        
        return $retval;
    }
}
