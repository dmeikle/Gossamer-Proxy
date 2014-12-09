<?php


namespace components\reminders\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;


/**
 * Description of ScopingFormModel
 *
 * @author davem
 */
class ReminderModel extends AbstractModel {
    
     public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Reminder';
        $this->tablename = 'reminders';
    }
    
    public function edit($id) {
      
        $params = array(
            'id' => intval($id),
            'Staff_id' => $this->getLoggedInStaffId()
        );
     
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        
        $claimsList =  $this->httpRequest->getAttribute('claimsList');
      
        $formattedList = $this->formatSelectionBoxOptions($this->pruneClaimsList($claimsList), $params);
        
        $data['claimsList'] = $formattedList;
       
        return $data;
    }
    
    protected function pruneClaimsList(array $claimsList) {
        $retval = array();
        foreach($claimsList as $row) {
            $retval[$row['id']] = $row['claimNumber'];
        }
       
        return $retval;
    }
    
    public function save($id) {
        $params = $this->getHttpRequest()->getPost();        
        $params['reminder']['remindBeforeTime'] = date('Y-m-d H:i:s', strtotime($params['reminder']['notificationDate']) - ($params['reminder']['remindBeforeTime'] * 60));
        $params['reminder']['id'] = intval($id);
        
        $data = $params['reminder'];
        $data['Staff_id'] = $this->getLoggedInStaffId();
        
        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $data);
        
        return array();
    }
    
    public function delete($id) {
        $params = array('id' => intval($id), 'Staff_id' => $this->getLoggedInStaffId());
               
        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_DELETE, $params);
        
        return array('true');
    }
}
