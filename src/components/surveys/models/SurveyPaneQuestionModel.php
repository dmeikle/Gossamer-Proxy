<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of SurveyPaneModel
 *
 * @author Dave Meikle
 */
class SurveyPaneQuestionModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'SurveyPaneQuestion';
        $this->tablename = 'surveypanequestions';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);

        return $data;
    }

    public function listAllByPaneId($id) {
        $locale = $this->getDefaultLocale();
        $params = array(
            'SurveyPanes_id' => intval($id),
            'locale' => $locale['locale'],
            'isActive' => '1',
            'directive::ORDER_BY' => 'priority', 'directive::DIRECTION' => 'ASC'
        );


        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByPaneId', $params);

        return $data;
    }

    public function saveToPaneById($id) {
        $params = $this->httpRequest->getPost();
        $params['SurveyPanes_id'] = intval($id);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);

        return $data;
    }

    public function saveQuestionsOrder($id) {
        $postedParams = $this->httpRequest->getPost();
        $params = array('SurveyPanes_id' => intval($id));
        foreach ($postedParams['Questions_id'] as $key => $value) {
            $params[] = array('Questions_id' => intval($value), 'SurveyPanes_id' => intval($id));
        }
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);

        return $data;
    }

}
