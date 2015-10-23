<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\listeners;

use core\eventlisteners\AbstractListener;
use components\surveys\models\AnswerModel;

/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author Dave Meikle
 */
class LoadAnswersByQuestionListener extends AbstractListener {

    public function on_request_start($params) {

        $requestParams = ($this->httpRequest->getParameters());
        $retval = array();
        $model = new AnswerModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale = $this->getDefaultLocale();
        $params = array('locale ' => $defaultLocale['locale'], 'Questions_id' => intval($requestParams[1]), 'directive:ORDER_BY' => 'QuestionsAnswers.priority', 'directive:DIRECTION' => 'ASC');
        $datasource = $this->getDatasource('components\surveys\models\AnswerModel');

        $answers = current($datasource->query('get', $model, 'listQuestionAnswers', $params));

        $this->httpRequest->setAttribute('AnswersList', $answers);
        unset($model);
    }

}
