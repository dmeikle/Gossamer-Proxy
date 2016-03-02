<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Model for the CMS Sections
 *
 * @author Dave Meikle
 */
class SectionModel extends AbstractModel {

    /**
     * 
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'CmsSection';
        $this->tablename = 'cmssections';
    }

    /**
     * save a section to the db
     * 
     * @param int $id
     * @return array
     */
    public function save($id) {
        $data = $this->httpRequest->getPost();
        $data['section']['id'] = intval($id);

        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $data['section']);

        if (!is_array($result) || count($result) == 0) {
            return array('result' => false);
        }

        return $data;
    }

    /**
     * delete a section from the db
     * 
     * @param int $id
     * @return array(true)
     */
    public function delete($id) {

        $data = array('id' => intval($id));

        $result = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $data);

        return array('result' => true);
    }

}
