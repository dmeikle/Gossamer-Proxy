<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use components\accounting\models\AccountingGeneralCostModel;

/**
 * SaveTollListener
 *
 * @author Dave Meikle
 */
class SaveTollListener extends AbstractListener {

    public function on_save_success(Event $event) {

        $model = new AccountingGeneralCostModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = $event->getParams();

        $datasource = $this->getDatasource('components\accounting\models\AccountingGeneralCostModel');

        $result = $datasource->query('post', $model, 'saveGeneralCost', $params);
    }

}
