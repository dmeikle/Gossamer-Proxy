<?php



namespace components\reminders\models;


use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use components\claims\models\ClaimLocationModel;
use components\claims\models\ClaimModel;

/**
 * Description of StaffReminderModel
 *
 * @author davem
 */
class StaffReminderModel extends ReminderModel{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'StaffReminder';
        $this->tablename = 'staffreminders';
    }
    
      public function listall($offset = 0, $rows = 20) {
        
        $params = array(
            'Staff_id' => $this->getLoggedInStaffId(),
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listStaffReminders', $params);
        
        if(is_array($data) && array_key_exists(ucfirst($this->tablename) . 'Count', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }
        
        return $data;
    }

    
    public function edit($id) {
      
        $params = array(
            'id' => intval($id),
            'Staff_id' => $this->getLoggedInStaffId()
        );
     
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'get', $params);
        
        $claimsList =  $this->httpRequest->getAttribute('claimsList');
      
        $formattedList = $this->formatSelectionBoxOptions($this->pruneClaimsList($claimsList), $params);
        if(array_key_exists('StaffReminder', $data)) {
            $data['StaffReminder'] = current($data['StaffReminder']);
        } else {
            
        }
       
        $data['claimsList'] = $formattedList;
       
        return $data;
    }
}
