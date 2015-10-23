<?php

namespace components\shoppingcart\listeners;

use core\eventlisteners\AbstractListener;
use libraries\utils\Registry;
use components\shoppingcart\models\StateModel;

class LoadAllStatesListener extends AbstractListener {

    public function on_request_start($params = array()) {

        $retval = array();
        $model = new StateModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale = $this->getDefaultLocale();
        $params = array('locale ' => $defaultLocale['locale']);

        $datasource = $this->getDatasource('components\shoppingcart\models\StateModel');

        $states = current($datasource->query('get', $model, 'list', $params));

        foreach ($states as $state) {
            $retval[$state['id']] = $state['state'];
        }


        $this->httpRequest->setAttribute('stateList', $retval);
        unset($model);
    }

}
