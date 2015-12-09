<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of ClaimDocumentUploadBuilder
 *
 * @author Dave Meikle
 */
class ClaimDocumentUploadBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        $builder->add('unitNumber', 'text', array('ng-model' => 'item.unitNumber', 'class' => 'form-control'))

        return $builder->getForm();
    }

}
