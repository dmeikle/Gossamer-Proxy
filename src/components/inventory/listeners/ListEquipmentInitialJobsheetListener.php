<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\listeners;

use core\eventlisteners\AbstractListener;
use components\inventory\models\InventoryEquipmentModel;

/**
 * ListEquipmentInitialJobsheetListener
 *
 * @author Dave Meikle
 */
class ListEquipmentInitialJobsheetListener extends AbstractListener {

    public function on_filerender_start($params) {

        $datasource = $this->getDatasource('components\\inventory\\models\\InventoryEquipmentModel');
        $model = new InventoryEquipmentModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getQueryParameters();
        $locale = $this->getDefaultLocale();
        $params['locale'] = $locale['locale'];

        $result = $datasource->query('get', $model, 'initialjobsheet', $params);

        if (is_array($result) && array_key_exists('InventoryEquipment', $result)) {
            $this->httpRequest->setAttribute('InventoryEquipment', $result['InventoryEquipment']);
        } else {
            $this->httpRequest->setAttribute('InventoryEquipment', array());
        }
    }

    public function on_request_start($params) {
        $this->on_filerender_start($params);
    }

}
