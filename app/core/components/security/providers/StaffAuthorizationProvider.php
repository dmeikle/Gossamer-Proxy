<?php


namespace core\components\security\providers;

use core\components\security\core\AuthorizationProviderInterface;
use libraries\utils\YAMLParser;
use core\components\security\core\ClientInterface;
use core\datasources\DatasourceAware;


/**
 * Description of StaffAuthorizationProvider
 *
 * @author davem
 */
class StaffAuthorizationProvider extends DatasourceAware implements AuthorizationProviderInterface
{
    protected $client = null;
    
    public function isAuthorized() {
        $config = $this->loadAccess();
        
        if(is_null($config)) {
            return true; // this is not a monitored area so let it pass
        }
        
        $roles = $config['roles'];
        $authorized = array_intersect($roles, $this->client->getRoles());
        
        return (is_array($authorized) && count($authorized) > 0);
    }

    public function setClient(ClientInterface $client) {
        $this->client = $client;
    }
    
    public function loadAccess() {
        $loader = new YAMLParser();
        $loader->setFilePath(__SITE_PATH . '/app/config/navigation-access.yml');
        
        $config = $loader->loadConfig();
        
        $this->loadComponentConfigurations($config);
        
        if(array_key_exists(__YML_KEY, $config)) {
            return $config[__YML_KEY];
        }
        
        return null;
    }

    private function loadComponentConfigurations(array &$config) {
        //first load the component list
        $list = $this->getDirectoryList();
        $loader = new YAMLParser();
      
        foreach ($list as $folderPath) {
            $loader->setFilePath($folderPath . '/config/navigation-access.yml');
            $componentConfig = $loader->loadConfig();
            
            if(!is_null($componentConfig) && is_array($componentConfig)) {
                $config = array_merge($config, $componentConfig);
               
            }    
        }        
    }
    
    private function getDirectoryList() {
    
        $retval = array();
        if ($handle = opendir(__SITE_PATH . '/src/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/src/components/' . $file;
                }
            }
            closedir($handle);
        }
        if ($handle = opendir(__SITE_PATH . '/app/core/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/app/core/components/' . $file;
                }
            }
            closedir($handle);
        }

        return $retval;
    }
}
