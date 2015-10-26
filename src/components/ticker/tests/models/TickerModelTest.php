<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\ticker\tests\models;

use components\ticker\models\TickerModel;

/**
 * TickerModelTest
 *
 * @author Dave Meikle
 */
class TickerModelTest extends \tests\BaseTest {

    public function testRequestToken() {
        $model = new TickerModel();
        $model->requestToken(2);
    }

}
