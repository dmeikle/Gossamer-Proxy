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
        
        $chunks = explode('?', $uri);
        
        $uriPieces = (explode('/', $chunks[0]));
        $pagePieces = array_filter(explode('/', $pageName));
        if($uriPieces[0] == ''){
            array_shift($uriPieces);
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
