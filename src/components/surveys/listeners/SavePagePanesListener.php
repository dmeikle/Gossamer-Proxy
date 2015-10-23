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
use components\surveys\models\SurveyPagePaneModel;
use core\eventlisteners\Event;

/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author Dave Meikle
 */
class SavePagePanesListener extends AbstractListener {

    public function on_request_start($params) {
        $params = $this->httpRequest->getParameters();
        $pageId = intval($params[0]);
        $postedParams = $this->httpRequest->getPost();
        $model = new SurveyPagePaneModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = array('SurveyPages_id' => $pageId, 'SurveyPanes_id' => $postedParams['SurveyPanes_id']);
        $datasource = $this->getDatasource('components\surveys\models\SurveyPagePaneModel');

        $datasource->query('POST', $model, 'savePagePanes', $params);

        unset($model);
    }

}
