<?php

namespace core\components\locales\eventlisteners;

use \core\eventlisteners\AbstractListener;
use core\components\locales\utils\LocaleLoader;
use core\components\locales\models\LocaleModel;

class LoadLocalesListener extends AbstractListener
{
    public function on_request_start($filename) {
        $retval = array();
        $model = new LocaleModel($this->httpRequest, $this->httpResponse, $this->logger);
 
        $params = array();

        $datasource = $this->getDatasource(get_class($model));
        try {
            $result = $datasource->query('get', $model, 'list', $params);
            if(is_array($result) && count($result) > 0) {
               $locales = current($result); 
            
                foreach($locales as $locale) {
                    $retval[$locale['locale']] = $locale;
                }

                $this->httpRequest->setAttribute('locales', $retval);
            }
            
        }catch(\Exception $e){}
        unset($model);
    }
    
}