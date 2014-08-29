<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

$parameters = (object) array(
    'product' => (object) array(
        'price' => '10.40',
        'weight' => '2lbs',
        'locale' => (object) array(
            'en_US' => array(
                'title' => 'test title',
                'description' => 'test description'
            ),
            'fr_CA' => array(
                'title' => 'frtest title',
                'description' => 'frtest description'
            ),
            'zh_CN' => array(
                'title' => 'cntest title',
                'description' => 'cntest description'
            )
        )
    )
);

pr($parameters);
$newArray = decoupleToArray($parameters);
pr($newArray);
$newArray2 = convertArrayText($newArray);
pr($newArray2);
function decoupleToArray($parameters) {
        
    if(is_object($parameters)) {
        $parameters = get_object_vars($parameters);
    }
    
    return is_array($parameters) ? array_map(__METHOD__, $parameters) : $parameters;
}

function convertArrayText(array $parameters) {
    $retval = array();
    foreach($parameters as $key => $value) {
        if(is_array($value)) {
            $retval[$key] = convertArrayText($value);
        }else {
            $retval[$key] = $value . ' tada';
            
        }
    }
    
    return $retval;
}

function convertText($item, $key) {
    
    echo "$key holds $item<br>";
    return $item.' tada';
}
function pr($parameters) {
    echo '<pre>';
    print_r($parameters);
    echo '</pre>';
}