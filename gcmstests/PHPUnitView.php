<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 8/9/2016
 * Time: 1:45 PM
 */

namespace gcmstests;


use core\AbstractView;

class PHPUnitView extends AbstractView
{
    public function render($data = array()) {
        return $data;
    }
}