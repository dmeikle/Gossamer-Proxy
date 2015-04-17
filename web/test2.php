<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

/**
 * test2
 *
 * @author Dave Meikle
 */
class Test {
    
    public function __call($name, $arguments) {
        $field = '';
        if(substr($name, 0, 8) == 'searchBy') {
            $field = substr($name, 8);
            $this->search($field, $arguments);
        }       
    }
    
    protected function search($field, $arguments) {
        echo $field;
    }
}


$t = new Test();

$t->searchByClaims_id();