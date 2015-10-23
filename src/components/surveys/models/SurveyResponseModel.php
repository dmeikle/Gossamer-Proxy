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
 * Description of ScopingFormModel
 *
 * @author Dave Meikle
 */
class SurveyResponseModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'SurveyResponse';
        $this->tablename = 'surveyresponses';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function getCompletedSurvey($id, $page) {
        $locale = $this->getDefaultLocale();

        $params = array(
            'id' => intval($id),
            'page' => $page,
            'locale' => $locale['locale']
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        return $data;
    }

}
