<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\datasources;

/**
 * Description of RestConnectionAdapter
 *
 * @author Dave Meikle
 */
class RestConnectionAdapter extends ConnectionAdapter{
    
    public function query($queryType, AbstractModel $entity, $verb, $params) {
        $this->query($queryType, $entity, $verb, $params);
    }

}
