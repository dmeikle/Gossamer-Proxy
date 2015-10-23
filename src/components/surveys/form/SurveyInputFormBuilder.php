<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\QuestionBuilder;

/**
 * SurveyInputFormBuilder
 *
 * @author Dave Meikle
 */
class SurveyInputFormBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }
        $form = array();
        if (!array_key_exists('panes', $values)) {
            return null;
        }
        //iterate each pane and add the questions
        $panes = $values['panes'];
        foreach ($panes as $pane) {

            $questions = $pane['questions'];
            $pane['questions'] = $this->buildQuestions($questions);
            $form['panelist'][] = $pane;
        }

        $builder->add('previous', 'submit', array('value' => 'Previous', 'class' => 'btn btn-lg btn-primary previous'))
                ->add('next', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary next'));

        return array_merge($form, $builder->getForm());
    }

    private function buildQuestions($questions) {
        $questionBuilder = new QuestionBuilder();

        if (is_null($questions)) {
            return;
        }

        foreach ($questions as $question) {
            $questionBuilder->add('question', $question['code'], array('class' => 'btn-xs', $question['id'], 'params' => $question));
        }

        return $questionBuilder->getForm();
    }

}
