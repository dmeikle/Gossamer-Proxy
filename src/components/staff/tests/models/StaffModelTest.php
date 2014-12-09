<?php

namespace components\staff\tests\models;

use tests\BaseTest;
use components\staff\models\StaffModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;


/**
 * Description of StaffModelTest
 *
 * @author davem
 */
class StaffModelTest extends BaseTest{
    
    public function testLogin() {
        $this->setURI('staff/list');
        $model = new StaffModel(new HTTPRequest(), new HTTPResponse(), $this->getLogger());
        $model->listall(0, 10);
    }
}
