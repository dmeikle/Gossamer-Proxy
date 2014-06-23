<?php

namespace libraries\utils;

class URIComparator
{
    
    public function findPattern($config, $uri){
        foreach($config as $outerkey => $grouping){
            foreach($grouping as $key => $value){
                if($key == 'pattern') {
                    if($this->parseWildCard($uri, $value)) {
                       return $outerkey;
                    }                   
                }
            }
            
        }
        return false;
    }
    
    private function parseWildCard($uri, $pageName) {
        
        //knock of the trailing parameters at end of URI
        $chunks = explode('?', $uri);
    
       //this is based on URI
        $uriPieces = (explode('/', $chunks[0]));
       
        if(current($uriPieces) == ''){
            array_shift($uriPieces);       
        }
        //this is based on config file
        $pagePieces = array_filter(explode('/', $pageName));
       
       if(count($pagePieces) > count($uriPieces)) {
           return false;
       }
       
        
        
        if(count($uriPieces) < count($pagePieces)  || count($pagePieces) < 1) {
            return false;
        }


        for($i = 0; $i < count($uriPieces); $i++) {
           
            if($pagePieces[$i] == '*') {
                continue;
            }

            if($pagePieces[$i] != $uriPieces[$i]) {
                return false;
            }
        }
      
        return true;
    }
}
