<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of TimesheetModel
 *
 * @author Dave Meikle
 */
class TimesheetModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Timesheet';
        $this->tablename = 'timesheets';
    }
    
    public function save($id) {
        $params = $this->httpRequest->getPost();
        unset($params['FORM_SECURITY_TOKEN']);
        
        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
    }
    
    /**
     * retrieves a row from the datasource for editing
     * 
     * @param int $id
     * 
     * @return array
     */
    public function edit($id) {


        if ($this->isFailedValidationAttempt()) {

            return $this->httpRequest->getAttribute('POSTED_PARAMS');
        }

        $params = array(
            'id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        if (is_array($data) && array_key_exists($this->entity, $data)) {
            return $data;
        }

        return array();
    }
    
    public function search(array $params) {
        $offset = 0;
        $rows = 20;
        
        $params = array_merge($params, array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        ));
        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'list', $params);
     
        
        if (is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
        }

        return $data;
    }
}
