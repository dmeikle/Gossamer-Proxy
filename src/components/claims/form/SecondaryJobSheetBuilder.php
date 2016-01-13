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
 * Description of SecondaryJobSheetBuilder
 *
 * @author Dave Meikle
 */
class SecondaryJobSheetBuilder extends AbstractBuilder {

    private $model;

    public function setModel(\core\AbstractModel $model) {
        $this->model = $model;
    }

    /**
     * @tutorial this builder is written differently to most other builders.
     *      The results still need to go through a serializer before sending to
     *      the view therefor we will return the form in the same array heirarchy
     *      that we received it - a typical builder would just return a single
     *      level array...
     *
     * @param FormBuilder $builder
     * @param array $values
     * @param array $options
     * @param array $validationResults
     *
     * @return array
     */
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        $retval = array();
        if (is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        foreach ($values['Actions'] as $item) {
            $this->getInitialFormItem($item);
            $this->getUpdateFormItem($item);
            $retval['Actions'][] = $item;
        }

        return $retval;
    }

    private function getInitialFormItem(array &$item) {
        $builder = new FormBuilder(null, $this->model);
        if ($item['questionType'] == 'text' || $item['questionType'] == 'textarea') {
            $builder->add($item['id'], $item['questionType'], array('ng-model' => 'ctrl.secondarySheet.item[' . $item['id'] . '].value', 'class' => 'form-control'));
        } elseif ($item['questionType'] == 'check') {
            $builder->add($item['id'], $item['questionType'], array('ng-change' => 'ctrl.itemChanged(\'' . $item['id'] . '\')', 'ng-true-value' => $item['id'], 'ng-checked' => 'ctrl.secondarySheet.item[\'' . $item['id'] . '\'].isSelected', 'ng-model' => 'ctrl.secondarySheet.item[\'' . $item['id'] . '\'].check', 'class' => 'form-control'));
        }
        $item['html'] = $builder->getForm();
    }

    private function getUpdateFormItem(array &$item) {
        if (is_null($item['AffectedAreasSecondarySheetItems_id'])) {
            $item['updateHtml'] = null;
            return;
        }
        $builder = new FormBuilder(null, $this->model);
        $builder->add($item['id'], 'check', array('ng-change' => 'ctrl.itemChanged(ctrl.secondarySheet.item[\'' . $item['id'] . '\'])', 'ng-true-value' => $item['id'], 'ng-checked' => 'ctrl.secondarySheet.item[\'' . $item['id'] . '\'].isDone', 'ng-model' => 'ctrl.secondarySheet.item[\'' . $item['id'] . '\'].isDone', 'class' => ''));

        $item['updateHtml'] = $builder->getForm();
    }

}
