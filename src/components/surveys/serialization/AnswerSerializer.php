<?php

namespace components\surveys\serialization;

use core\serialization\Serializer;

/**
 * Description of AnswerSerialization
 *
 * @author davem
 */
class AnswerSerializer extends Serializer {

    
    public function formatSearchResults(array $results) {
        $retval = array();
//        print_r($results);
//        die;
        foreach($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['answer'],
                'value' => '<b>' . $row['answer'] . "</b><br />" 
            );
        }
        
        return $retval;
    }
}
