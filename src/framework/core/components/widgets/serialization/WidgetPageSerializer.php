<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\serialization;

use core\serialization\Serializer;

/**
 * WidgetPageWidgetsSerializer
 *
 * @author Dave Meikle
 */
class WidgetPageSerializer extends Serializer {
    
    
    public function formatPageListResults(array $result) {
      
        $retval = array();
        $lastSection = '';
        foreach($result['PageTemplateDetails'] as $row) {
           $sectionsList = $row['sections'];
           unset($row['sections']);
           $sections = array();
          // pr($sectionsList);
           foreach($sectionsList as $section) {
               $sectionName = $section['sectionName'];
               unset($section['sectionName']);
               $sections[$sectionName][] = $section;
           }
           $row['sections'] = $sections;
           
           $retval[] = $row;
        }
        
        return $retval;
    }
}
