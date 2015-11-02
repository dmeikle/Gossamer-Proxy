<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\surveys\form\SurveyPaneBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;

/**
 * Description of ScopingFormsController
 *
 * @author Dave Meikle
 */
class SurveyPaneQuestionsController extends AbstractController {

    public function save($id) {
        $this->model->save($id);

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_panes_list', array(0, 20));
    }

    public function edit($id) {

        $results = $this->model->edit($id);
        $questions = $this->drawQuestionList($this->httpRequest->getAttribute('QuestionsList'));

        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'questions' => $questions, 'form' => $this->drawForm($this->model, $results)));
    }

    public function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new SurveyPaneBuilder();

        $results = $this->httpRequest->getAttribute('ERROR_RESULT');


        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function listallByPaneId($id) {
        $result = $this->model->listallByPaneId($id);
        $list = array();
        if (count($result) > 0) {
            $list = current($result);
        }
        $questions = $this->httpRequest->getAttribute('Questions');
        $this->render(array('SurveyPaneQuestions' => $list, 'QuestionsList' => $questions));
    }

    public function saveToPaneById($id) {
        $this->mode->saveToPaneById($id);
    }

    private function drawQuestionList(array $questions = null) {
        if (!is_array($questions) || count($questions) < 1) {
            return;
        }
        $retval = '<ul id="sortable">';
        foreach ($questions as $question) {
            if (!array_key_exists('id', $question)) {
                continue;
            }
            $retval .= '<li data-id="' . $question['id'] . '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $question['question'] . '</li>';
        }
        $retval .= '</ul>';

        return $retval;
    }

    public function saveQuestionsOrder($id) {
        $this->model->saveQuestionsOrder($id);

        $this->render($this->httpRequest->getPost());
    }

}
