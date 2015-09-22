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
 * base class for taking raw database results and formatting them for use
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
     * @param string $key - the value to extract
     * 
     * @return array
     */
    public function extractRawChildNodeData(array $list, $key, $idKey = false) {
     
        $retval = array();
        foreach ($list as $node) {
            if ($idKey) {
                $retval[$node['id']] = $node[$key];
            } else {
                $retval[] = $node[$key];
            }
        }

        return $retval;
    }

    /**
     * receives an array and returns a default option list for selection box
     * 
     * @param array $options - the list of options to draw to the page
     * @param array $selectedOptions - the list of already selected options from a previous save
     * @param string $textKey - the name of the column to be used as visible text
     * @param string $selectedValue - the currently selected item

     * @return string
     */
    public function formatSelectionBoxOptions(array $options, array $selectedOptions = null, $textKey = '', $selectedValue = '') {

        if (strlen($textKey) > 0) {
            $options = $this->extractSubNode($options, $textKey);
        }
        if(is_null($selectedOptions)) {
            $selectedOptions = array();
        }
        $retval = '';
        foreach ($options as $key => $option) {

            if (count($selectedOptions) < 1 && $selectedValue == $key) {
                //this is for empty selections and passing a selected value in.
                //eg: creating a new question and selecting a type on page draw
                $retval .= "<option value=\"{$key}\" selected>{$option}</option>\r\n";
            } elseif (!in_array($key, $selectedOptions)) {
             
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
     * @param string $key
     * 
     * @return array
     */
    protected function extractSubNode(array $array, $key) {
       
        $output = array();
        foreach ($array as $row) {
            if (count($row) < 1 || !is_array($row) || !array_key_exists('id', $row)) {
                continue;
            }
            $output[$row['id']] = $row[$key];
        }

        return $output;
    }

}
