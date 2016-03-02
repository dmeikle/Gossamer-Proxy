<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\serialization;

use core\serialization\Serializer;

/**
 * serializer for the CMS Sections
 *
 * @author Dave Meikle
 */
class SectionsSerializer extends Serializer {

    /**
     * formats an array of sections into an options list
     * 
     * @param array $options
     * @param array $cmsPage
     * 
     * @return string
     */
    public function formatSectionsOptionsList(array $options = array(), array $cmsPage = array()) {
        $retval = '<option value="0" data-slug="">Root of Website</option>';

        foreach ($options as $row) {
            $retval .= "<option value=\"" . $row['CmsSections_id'] . "\" data-slug=\"" . $row['slug'] . "\"";
            if (array_key_exists('CmsSections_id', $cmsPage)) {
                if ($cmsPage['CmsSections_id'] == $row['CmsSections_id']) {
                    $retval .= ' selected';
                }
            }
            $retval .= ">" . $row['sectionName'] . "</option>\r\n";
        }

        return $retval;
    }

}
