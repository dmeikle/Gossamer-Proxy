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
use components\surveys\models\SurveyPaneQuestionModel;

/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author Dave Meikle
 */
class LoadQuestionsByPaneListener extends AbstractListener {

    public function on_request_start($params) {
        $requestParams = ($this->httpRequest->getParameters());
        $retval = array();
        $model = new SurveyPaneQuestionModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale = $this->getDefaultLocale();
        $params = array('locale ' => $defaultLocale['locale'], 'Questions_id' => intval($requestParams[1]));
        $datasource = $this->getDatasource('components\surveys\models\SurveyPaneQuestionModel');

        $answers = current($datasource->query('get', $model, 'list', $params));

        $this->httpRequest->setAttribute('QuestionsList', $answers);
        unset($model);
    }

}
