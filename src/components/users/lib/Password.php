<?php

namespace components\users\lib;

/**
 * Description of Password
 *
 * @author davem
 */
class Password {
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function formatPasswordHistory($password, array $values = null) {
        $history = $values['passwordHistory'];
        
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
