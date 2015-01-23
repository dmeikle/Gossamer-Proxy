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

class JSONView extends AbstractView
{


    //need this to override the default destruct in parent class
    public function __destruct()
    {

    }

    protected function renderView(){

        header('Content-Type: application/json');
        $data = $this->getData();
        //we don't want this in our json
        unset($data['SystemLocalesList']);
        unset($data['NAVIGATION']);
        if(!is_null($this->getData())) {
            try{
                // The second parameter of json_decode forces parsing into an associative array
                //extract(json_decode(json_encode($this->data), true));
                echo json_encode($data);
            }catch(\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }

    }

}
