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
use components\inventory\models\VendorItemModel;

/**
 * ListVendorItemPricesListener
 *
 * @author Dave Meikle
 */
class ListVendorItemPricesListener extends AbstractListener {

    public function on_request_start($params) {

        $datasource = $this->getDatasource('components\\inventory\\models\\VendorItemModel');
        $model = new VendorItemModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();

        $params = array('InventoryItems_id' => $params[0]);

        $result = $datasource->query('get', $model, 'list', $params);
        if (array_key_exists('VendorItems', $result)) {
            $this->httpRequest->setAttribute('VendorItems', $result['VendorItems']);
        }
    }

}
