<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\tests\models;

use tests\BaseTest;
use components\staff\models\StaffModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;

/**
 * Description of StaffModelTest
 *
 * @author Dave Meikle
 */
class StaffModelTest extends BaseTest {

    public function testLogin() {
        $this->setURI('staff/list');
        $model = new StaffModel(new HTTPRequest(), new HTTPResponse(), $this->getLogger());
        $model->listall(0, 10);
    }

}
