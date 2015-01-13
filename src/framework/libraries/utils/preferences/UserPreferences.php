<?php

namespace libraries\utils\preferences;

class UserPreferences
{
    private $params = array();


    public function setDefaultLocale($value) {
        $this->params['DefaultLocale'] = $value;
    }
    
    public function getDefaultLocale() {
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