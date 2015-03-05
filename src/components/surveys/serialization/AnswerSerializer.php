<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\serialization;

use core\serialization\Serializer;

/**
 * Description of AnswerSerialization
 *
 * @author Dave Meikle
 */
class AnswerSerializer extends Serializer {

    
    public function formatSearchResults(array $results) {
        $retval = array();
        if(count($results) == 0) {
            return;
        }
        foreach($results as $row) {
            if(count($row) == 0) {
                return;
            }
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['answer'],
                'value' => '<b>' . $row['answer'] . "</b><br />" 
            );
        }
        
        return $retval;
    }
}
