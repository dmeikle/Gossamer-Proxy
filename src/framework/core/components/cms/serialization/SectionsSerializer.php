<?php

namespace core\components\cms\serialization;

use core\serialization\Serializer;

/**
 * Description of SectionsSerializer
 *
 * @author davem
 */
class SectionsSerializer extends Serializer{
    public function formatSectionsOptionsList($options = array(), $cmsPage = array()) {
        $retval = '';
        
        foreach($options as $row) {
            $retval .= "<option value=\"" . $row['CmsSections_id'] ."\"";
            if(array_key_exists('CmsSections_id', $cmsPage)) {
                if($cmsPage['CmsSections_id'] == $row['CmsSections_id']) {
                    $retval .= ' selected';
                }
            }
            $retval .= ">" . $row['name'] . "</option>\r\n";
        }
        
        return $retval;
    }
}
