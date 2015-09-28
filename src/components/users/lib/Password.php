<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\users\lib;

/**
 * Description of Password
 *
 * @author Dave Meikle
 */
class Password {
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function formatPasswordHistory($password, array $values = null) {
        $history = '';
        if(array_key_exists('passwordHistory', $values)) {
            $history = $values['passwordHistory'];
        }
        $list = explode('|', $history);
        $list[] = ($password);
        if(count($list) > self::MAX_PASSWORD_HISTORY) {
            array_shift($list);
        }
        
        return implode('|', array_filter($list));
    }
    
    
    public function checkPasswordExists($newPassword, $history) {
        $list = explode('|', $history);
        
        foreach($list as $previousPassword) {
            $result = (crypt($newPassword, $previousPassword) == $previousPassword);
            if($result) {
                return true;
            }
        }
        
        return false;
    }
}
