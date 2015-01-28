<?php


namespace core\components\blogs\listeners;

use core\eventlisteners\AbstractCachableListener;
use Gossamer\Caching\CacheManager;
use core\eventlisteners\Event;

/**
 * Description of DeleteCachedFileListener
 *
 * @author Dave Meikle
 */
class DeleteCachedFileListener extends AbstractCachableListener {
    
    public function on_save_success(Event $event) {
        // CmsPage-content-restoration-services.cache
        $eventParams = $event->getParams();
        
        if(intval($eventParams['id']) == 0) {
            
            return;
        }
        
        $params = $this->httpRequest->getPost();
        $page = ($params['Blog']);
       
        //make sure the key passed from routing matches the one specified
        //for saving to cache also...
        $key = $this->getKey() . '-';
        if(!is_null($key)) {
            //use all requestParams to avoid name collisions on pages with
            //same name in other sections
            try{
                $permalink = $page['permalink'];
                $key = 'blogs' . DIRECTORY_SEPARATOR . $key .  (strlen($permalink) > 0) ? str_replace('-', '_', $permalink) : ''; 
            }catch(\Exception $e) {
                        
            }
        }
      
        $manager = new CacheManager($this->logger);
        $manager->invalidateCache($key);
        unset($manager);
    }
}
