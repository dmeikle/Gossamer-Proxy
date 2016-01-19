<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\notifications\listeners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use components\notifications\models\MessagingTypeModel;

/**
 * LoadTemplateTypesListener
 *
 * @author Dave Meikle
 */
class LoadMessagingTypesListener extends AbstractCachableListener {

    public function on_request_start($params) {

        $retval = array();
        $model = new MessagingTypeModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = array();

        $datasource = $this->getDatasource('components\notifications\models\MessagingTypeModel');

        $result = $datasource->query('get', $model, 'list', $params);
        if (is_array($result) && array_key_exists('MessagingTypes', $result)) {
            $this->httpRequest->setAttribute('MessagingTypes', $result['MessagingTypes']);
        }
    }

}
