<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\views;

use core\AbstractView;

/**
 * Used as the view for all Ajax requests that need the response header
 * to be application/json and without rendering any other calls.
 * 
 * @author Dave Meikle
 */
class RenderHTMLView extends AbstractView {

    //need this to override the default destruct in parent class
    // DO NOT REMOVE
//    public function __destruct() {
//        
//    }

    protected function renderView() {

       // header('Content-Type: application/json');

        if (!is_null($this->getData())) {
            
            try {
               $this->loadFileToRender();
            } catch (\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }
    }

    private function loadFileToRender() {
        $config = $this->getData();
        $path = __SITE_PATH . DIRECTORY_SEPARATOR . $config['path'];
        if(!file_exists($path)) {
           
            throw new \Exception($config['path'] . ' is not a valid file to render in RenderHTMLView');
        }
       
        $this->template = file_get_contents($path);
    }
}
