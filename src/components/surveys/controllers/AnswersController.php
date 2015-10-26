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
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;
use components\surveys\form\AnswerBuilder;
use components\surveys\serialization\AnswerSerializer;

/**
 * Description of AnswersController
 *
 * @author Dave Meikle
 */
class AnswersController extends AbstractController {

    public function search() {
        $result = $this->model->search();

        $serializer = new AnswerSerializer();
        $result = $serializer->formatSearchResults($result);

        $this->render($result);
    }

    public function edit($id) {
        $results = $this->model->edit($id);

        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $results)));
    }

    public function save($id) {
        $results = $this->model->save($id);

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_answers_list', array(0, 20));
    }

    public function drawForm(FormBuilderInterface $model, array $values = null) {

        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new AnswerBuilder();

        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $questionTypesList = $this->httpRequest->getAttribute('QuestionTypes');

        $options['locales'] = $this->httpRequest->getAttribute('locales');

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function setInactive($id) {
        parent::setInactiveAndRedirect($id, 'admin_surveys_answers_list', array(0, 20));
    }

}
