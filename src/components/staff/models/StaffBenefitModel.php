<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

class StaffBenefitModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'StaffBenefit';
        $this->tablename = 'staffbenefits';
    }

    public function save($staffId) {
        $params = $this->httpRequest->getPost();
        $params['StaffBenefits']['Staff_id'] = $staffId;
        $params['StaffBenefits']['startDate'] = date("Y-m-d", strtotime($params['StaffBenefits']['startDate']));
        unset($params['StaffBenefits']['id']);
        pr($params);
        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['StaffBenefits']);
    }

    public function getFormWrapper() {

        return $this->entity;
    }
    
}
