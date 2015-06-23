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

/**
 * LoadSystemWidgetsListener
 *
 * @author Dave Meikle
 */
class LoadSystemWidgetsListener extends AbstractCachableListener{
    
    public function on_request_start($param) {
        $systemWidget = new SystemWidgetModel($this->httpRequest, $this->httpResponse, $this->logger);
      
        $params = array('ymlKey'=> __YML_KEY);
        
        $datasource = $this->getDatasource($systemWidget);
 
        $results = $datasource->query('get', $systemWidget, 'list', $params);
      
        if(is_array($results) && array_key_exists('WidgetsSystems', $results)) {
            $this->loadWidgetConfigs($results['WidgetsSystems']);
        }
        
    }
    
    private function loadWidgetConfigs(array $widgetList) {
        $parser = new \libraries\utils\YAMLParser();
        $retval = array();
        foreach($widgetList as $widgetConfig) {
            $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $widgetConfig['component'] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'widgets.yml');
            $config = $parser->loadConfig();
            if($config === false) {
                //no widgets.yml found
                continue;
            }
            if(array_key_exists($widgetConfig['htmlKey'], $config)) {
                $retval[$widgetConfig['sectionName']][] = $config[$widgetConfig['htmlKey']];
            }
        }
      
        $this->httpRequest->setAttribute('SystemWidgets', $retval);
    }
}
