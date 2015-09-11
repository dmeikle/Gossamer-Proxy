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
    
    public function listall($offset = 0, $rows = 20, $customVerb = null) {
        $locale = $this->getDefaultLocale();
        
        $params = array(
            'directive::OFFSET' => intval($offset),
            'directive::LIMIT' => intval($rows),
            'Staff_id' => $this->getLoggedInStaffId(),
            'locale' => $locale['locale']
        );
        
        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    }
    
    public function edit($id) {
        $locale = $this->getDefaultLocale();
        $params = array(
            'id' => intval($id),
            'Staff_id' => $this->getLoggedInStaffId(),
            'locale' => $locale['locale']
        );
        
        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    }
    
    public function save($id) {
        $params = array(
            'id' => intval($id),
            'Staff_id' => $this->getLoggedInStaffId()
        );
        
        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
    }
}
