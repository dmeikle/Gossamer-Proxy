<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\serialization;

use core\serialization\Serializer;

/**
 * Description of WorkPerformed
 *
 * @author Dave Meikle
 */
class StaffSerializer extends Serializer{
    
    public function formatDepartmentsArray(array $list) {
        $retval = array();
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            if(!array_key_exists('id', $row)) {
                return array();
            }
           
            $retval[$row['id']] = $row['name'];
        }
        
        return $retval;
    }
    
    /**
     * extractRawChildNodeData  - receives raw arrays from child 1 to many
     *  tables and formats it for passing into a selection box as selected
     *  values.
     * this overrides the parent method since we want firstname and lastname
     * not just 1 column value
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
                $retval[$node['id']] = $node['firstname'] . ' ' . 
                    $node['lastname'];
            } else {
                $retval[] = $node[$key];
            }
        }

        return $retval;
    }
    
    public function getStaffName(array $list, $staffId) {
        foreach($list as $row) {
            echo $row['id'];
            if($row['id'] == $staffId) {
                return $row['firstname'] . ' ' . $row['lastname'];
            }
        }
        
        return '';
    }
}
