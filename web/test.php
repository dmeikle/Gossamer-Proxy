<?php

$a = array(
    "key1" => array(
        "pattern" => "/test"
    ),
    
    "key2" => array(
        "pattern" => "/test2"
    ),
    
    "key3" => array(
        "pattern" => "/test3"
    ),
    
    "key4" => array(
        "pattern" => "/test4"
    )
);

$result = array_search("key3", $a);
echo "here";
print_r($result);
echo "done";
?>