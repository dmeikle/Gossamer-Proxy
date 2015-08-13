<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\widgets\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use core\components\widgets\models\WidgetPageModel;
use core\components\widgets\serialization\WidgetPageSerializer;

/**
 * LoadWidgetPageTemplateListener
 * 
 * loads the widget template configs from cache rather than hitting db each time
 *
 * @author Dave Meikle
 */
class LoadWidgetPageTemplateListener extends AbstractCachableListener {

    public function on_request_start($params) {

        $results = $this->getValuesFromCache('WidgetPageTemplateConfigs', false);

        if ($results === false) {
            $results = $this->loadTemplates();
            $this->saveValuesToCache('WidgetPageTemplateConfigs', $results, false);
        }

        if (is_array($results)) {

            $serializer = new WidgetPageSerializer();
            $results = $serializer->formatPageListResults($results);
            $this->httpRequest->setAttribute('PageTemplateDetails', $results);

        } else {
            $this->httpRequest->setAttribute('PageTemplateDetails', array());
        }
    }

    private function loadTemplates() {
        $model = new WidgetPageModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = array('isActive' => '1');
        $datasource = $this->getDatasource($model);

        return $datasource->query('get', $model, 'listtemplates', $params);
    }

}
