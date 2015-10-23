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
 * Description of SurveyPageModel
 *
 * @author Dave Meikle
 */
class SurveyPageModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'SurveyPage';
        $this->tablename = 'surveypages';
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

    public function listallBySurvey($id) {
        $locale = $this->getDefaultLocale();
        $params = array(
            'Surveys_id' => intval($id),
            'locale' => $locale['locale']
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        return $data;
    }

    public function search(array $term) {
        $locale = $this->getDefaultLocale();
        $params = $this->httpRequest->getPost();

        $params = array('keywords' => $params['term'],
            'locale' => $locale['locale']);

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params);

        return $data['SurveyPages'];
    }

}
