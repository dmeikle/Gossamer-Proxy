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
class SurveyPageSerializer extends Serializer {

    
    public function formatSearchResults(array $results) {
        $retval = array();
//        print_r($results);
//        die;
        foreach($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['name'],
                'value' => '<b>' . $row['name'] . "</b><br />" 
            );
        }
        
        return $retval;
    }
}
