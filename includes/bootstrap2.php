// <?php
// 
// use libraries\utils\YAMLParser;
// use core\eventlisteners\EventDispatcher;
// use core\system\KernelEvents;
// use libraries\utils\YAMLConfiguration;
// 
// use core\http\RequestFormatter;
// 
// use libraries\utils\YAMLConfiguration2;
// 
// $yamlConfig = new YAMLConfiguration2($logger);
// $nodeParams = $yamlConfig->getNodeParameters($requestURI);
// $ymlKey = $nodeParams['ymlKey'];
// unset($yamlConfig);
// 
 // define('__YML_KEY', $ymlKey);
//  
//  
// $formatter = new RequestFormatter();
// die('here');
// $eventDispatcher = new EventDispatcher(null, $container->get('Logger'));
// 
// $conf = new YAMLConfiguration($logger, 'bootstrap', 'listeners');
// 
// $eventDispatcher->configListeners($conf->getConfigs());
// 
// $controllerConfig = new YAMLConfiguration($logger, 'bootstrap','defaults', 'index');
// 
// //iterateComponentConfigurations($eventDispatcher);
// 
// use core\system\Kernel;
// 
// //$eventDispatcher->dispatch('test_event', 'sayHello');
// $container->set('EventDispatcher', null, $eventDispatcher);
// 
// function iterateComponentConfigurations(EventDispatcher $eventDispatcher) {
    // global $logger;
    // $parser = new YAMLParser($logger);
    // $parser->setFilePath(__SITE_PATH . '/config/bootstrap.yml');
    // $bootstraps = $parser->loadConfig(); 
//     
    // $eventDispatcher->configListeners($bootstraps);
// 
    // $subdirectories = getDirectoryList();
    // $componentBootstraps = array();
    // foreach ($subdirectories as $folder) {
        // $parser->setFilePath($folder . '/config/bootstrap.yml');
        // $config = $parser->loadConfig(); 
        // if(is_array($config)) {
            // $eventDispatcher->configListeners($config);   
        // }
//         
    // }
//   
// }
// 
// function addEvent(array $eventConfig) {
    // foreach($eventConfig as $configRow) {
       // $event = new core\eventlisteners\Event($configRow['event'], $configRow['listener']); 
    // }
//     
// //$event = new core\eventlisteners\Event(KernelEvents::REQUEST_START, $httpRequest);
// }
// function getDirectoryList() {
//     
    // $retval = array();
    // if ($handle = opendir(__SITE_PATH . '/src/components')) {
        // $blacklist = array('.', '..', 'somedir', 'somefile.php');
        // while (false !== ($file = readdir($handle))) {
            // if (!in_array($file, $blacklist)) {
                // $retval[] = __SITE_PATH . '/src/components/' . $file;
            // }
        // }
        // closedir($handle);
    // }
// 
    // return $retval;
// }
