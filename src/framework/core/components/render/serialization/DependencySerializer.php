<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\render\serialization;

use core\serialization\Serializer;
/**
 * DependencySerializer
 *
 * @author Dave Meikle
 */
class DependencySerializer extends Serializer {
    
    public function formatSelectionBox($id, $value, array $options) {
        $retval = '';
        foreach($options as $option) {
            $retval .= '<option value="' . $option[$id] . '">' . $option[$value] . '</option>';
        }
        
        return $retval;
    }
}
