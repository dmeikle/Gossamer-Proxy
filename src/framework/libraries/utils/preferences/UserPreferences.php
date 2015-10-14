<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils\preferences;

class UserPreferences
{
    private $params = array();


    public function setViewType($view) {
        $this->params['DefaultView'] = $view;
    }
    
    public function getViewType() {
        return $this->params['DefaultView'];
    }
    
    
    public function setDefaultLocale($value) {
        $this->params['DefaultLocale'] = $value;
    }
    
    public function getDefaultLocale() {
        if(!array_key_exists('DefaultLocale', $this->params)) {
            return null;
        }
        
        return $this->params['DefaultLocale'];
    }
    
    public function setNotificationTypeId($value) {
        $this->params['NotificationTypeId'] = $value;
    }
    
    public function getNotificationTypeId() {
        return $this->params['NotificationTypeId'];
    }
    
    public function toArray() {
        return $this->params;
    }
}