<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use core\components\widgets\models\SystemWidgetModel;
use core\components\widgets\exceptions\FileNotFoundException;

/**
 * LoadSystemWidgetsListener
 *
 * @author Dave Meikle
 */
class LoadSystemWidgetsListener extends AbstractCachableListener{
    
    public function on_request_start($params) {
        $results = $this->loadConfigurations($params);
        $this->saveValuesToCache('widgets/' . __YML_KEY, $results);
        
        if(is_array($results) && array_key_exists('WidgetsSystems', $results)) {
            $this->loadWidgetConfigs($results['WidgetsSystems']);
        }        
    }
    
    private function loadConfigurations($params) {

        $systemWidget = new SystemWidgetModel($this->httpRequest, $this->httpResponse, $this->logger);
      
        $params = array('ymlKey'=> __YML_KEY,
            'directive::ORDER_BY' => 'priority');
        
        $datasource = $this->getDatasource($systemWidget);
 
        $results = $datasource->query('get', $systemWidget, 'listByPage', $params);      
        
     
        
        return $results;
    }
    
    private function loadWidgetConfigs(array $widgetList) {
        $parser = new \libraries\utils\YAMLParser();
        $retval = array();
       
        if(is_array($widgetList) && count($widgetList) > 0 && count($widgetList[0]) > 0) {
            
            foreach($widgetList as $widgetConfig) {
                //add the widget component name so we can bootstrap it on page load
                $this->httpRequest->addModule($widgetConfig['module']);

                $parser->setFilePath($this->getFilepath($widgetConfig));
                
                $config = $parser->loadConfig();
                if($config === false) {
                    //no widgets.yml found
                    throw new FileNotFoundException('No widget config found for ' . $widgetConfig['name']);
                    //continue;
                }
                
                if(array_key_exists($widgetConfig['htmlKey'], $config)) {
//                    if(is_array($config[$widgetConfig['htmlKey']]) && array_key_exists('file', $config[$widgetConfig['htmlKey']])) {
//                        $retval[$widgetConfig['sectionName']][] = $config[$widgetConfig['htmlKey']]['file'];
//                    } else {
                        $retval[$widgetConfig['sectionName']][] = $config[$widgetConfig['htmlKey']];
                   // }
                }
            }
           
        }
     
        $this->httpRequest->setAttribute('SystemWidgets', $retval);
    }
    
    private function getFilepath(array $widgetConfig) {
        if(file_exists(__SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $widgetConfig['component'] . 
                DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'widgets.yml')) {
            return __SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $widgetConfig['component'] . 
                DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'widgets.yml';
        }
        
        return __SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $widgetConfig['component'] . 
                DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'widgets.yml';
    }
    
    protected function getKey() {
        return 'widgets/' . __YML_KEY;
    }
}
