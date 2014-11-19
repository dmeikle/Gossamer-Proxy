<?php

namespace core\serialization;

/**
 * Description of Serializer
 *
 * @author davem
 */
class Serializer {
   
    
    public function formatSelectionBoxOptions(array $options, array $selectedOptions, $subKey = '') {
        
        if(strlen($subKey) > 0) {           
            $options = $this->extractSubNode($options, $subKey);          
        }
     
        $retval = '';
        foreach($options as $key => $option) {
            if(!in_array($key, $selectedOptions)) {
                $retval .= "<option value=\"{$key}\">{$option}</option>\r\n";
            } else {
                $retval .= "<option value=\"{$key}\" selected>{$option}</option>\r\n";
            }
        }
        
        return $retval;
    }
    
    /**
     * navigates the sub arrays to extract the child elements by subkey
     * @param array $array
     * @param type $key
     * 
     * @return array
     */
    protected function extractSubNode(array $array, $key) {
       
        $output = array();
        foreach($array as $row) {
            $output[$row['id']] = $row[$key];
        }
        
        return $output;
    }
    
}
