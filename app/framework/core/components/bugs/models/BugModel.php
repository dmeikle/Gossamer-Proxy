<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\bugs\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of BugModel
 *
 * @author Dave Meikle
 */
class BugModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Bug';
        $this->tablename = 'bugs';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    /**
     * performs a save to the datasource
     *
     * @param int $id
     *
     * @return type
     */
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        if (intval($id) > 0) {
            $params[$this->entity]['followupStaff_id'] = $this->getLoggedInStaffId();
        } else {
            $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();
        }
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);

        return $data;
    }

}
