<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\controllers;

use core\AbstractController;
use components\inventory\form\InventoryCategoryBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;

class InventoryCategoriesController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {

        $result = $this->model->edit($id);       
        //this is a json intended response
        $this->render($result);
    }

    
    /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }
        
        $result['form'] = $this->drawForm($this->model, array());
        $result['id'] = 0;
        
        $this->render($result);
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $categoryBuilder = new InventoryCategoryBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');       
        $categoryBuilder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );

        return $categoryBuilder->buildForm($builder, $values, $options, $results);
    }


    public function getFormWrapper() {
        return $this->entity;
    }

}
