<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace libraries\utils;

/**
 * Description of URISectionComparator
 *
 * @author Dave Meikle
 */
class URISectionComparator extends URIComparator{
    
    public function findPattern($config, $uri){      
     
        //break the uri into an array so we can pop it off in each iteration
        //this time we're simply looking for a matching parent folder
        $pieces = explode('/', $uri);
        $key = false;
        while(!$key && count($pieces) > 0) {
            
            $key = parent::findPattern($config, implode('/', $pieces));
            //is it holding a matched value or did it return false?
            if($key === false) {
                array_pop($pieces);
            } else {
               
                return $key;
            }
        }
        return false;
    }
}
