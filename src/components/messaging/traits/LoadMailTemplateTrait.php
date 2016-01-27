<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\traits;

use components\messaging\models\MessagingNotificationTemplateModel;

/**
 * LoadMailTemplateTrait
 *
 * @author Dave Meikle
 */
trait LoadMailTemplateTrait {

    protected $template;

    protected function loadTemplate($templateKey) {

        $locale = $this->getDefaultLocale();

        $datasource = $this->getDatasource('components\\messaging\\models\\MessagingNotificationTemplateModel');
        $model = new MessagingNotificationTemplateModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = array(
            'locale' => $locale['locale'],
            'name' => $templateKey
        );

        $result = $datasource->query('get', $model, 'get', $params);

        $this->template = $result['MessagingNotificationTemplate'][0]['template'];
    }

}
