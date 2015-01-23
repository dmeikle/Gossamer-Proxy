<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\serialization;

/**
 * Description of Serializer
 *
 * @author Dave Meikle
 */
class Serializer {
   

    /**
     * extractRawChildNodeData  - receives raw arrays from child 1 to many
     *  tables and formats it for passing into a selection box as selected
     *  values.
     * 
     *  this works with OneToManyJoinInterface in db-repo
     * 
     * @param array $list - the raw array from the mapping table
     * @param type $key - the value to extract
     * 
     * @return array
     */
    public function extractRawChildNodeData(array $list, $key, $idKey = false) {
        $retval = array();
        foreach($list as $node) {
            if($idKey) {
                 $retval[$node['id']] = $node[$key];
            } else {
                $retval[] = $node[$key];
            }
            
        }
        
        return $retval;
    }
    
    /**
     * 
     * @param array $options - the list of options to draw to the page
     * @param array $selectedOptions - the list of already selected options from a previous save
     * @param type $subKey - the name of the column to be used as an associative array key
     * @param type $selectedValue - the currently selected item
     
     * @return string
     */
    public function formatSelectionBoxOptions(array $options, array $selectedOptions, $subKey = '', $selectedValue = '') {

        if(strlen($subKey) > 0) {           
            $options = $this->extractSubNode($options, $subKey);          
        }

        $retval = '';
        foreach($options as $key => $option) {
         
            if(count($selectedOptions) < 1 && $selectedValue == $key) {
                //this is for empty selections and passing a selected value in.
                //eg: creating a new question and selecting a type on page draw
                $retval .= "<option value=\"{$key}\" selected>{$option}</option>\r\n";
            } elseif(!in_array($key, $selectedOptions)) {
                
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
            if(count($row) < 1) {
                continue;
            }
            $output[$row['id']] = $row[$key];
        }
        
        return $output;
    }
    
}
