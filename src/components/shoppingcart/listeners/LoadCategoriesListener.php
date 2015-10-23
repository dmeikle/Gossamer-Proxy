<?php

namespace components\shoppingcart\listeners;

use core\eventlisteners\AbstractListener;
use libraries\utils\Registry;
use components\shoppingcart\models\CategoryModel;

class LoadCategoriesListener extends AbstractListener {

    public function on_request_start($params = array()) {

        $retval = array();
        $model = new CategoryModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale = $this->getDefaultLocale();
        $params = array('locale ' => $defaultLocale['locale']);

        $datasource = $this->getDatasource('components\shoppingcart\models\CategoryModel');

        $categories = $datasource->query('get', $model, 'list', $params);

        foreach ($categories as $row) {
            foreach ($row as $category) {
                $retval[$category['id']] = $category['category'];
            }
        }

        $this->httpRequest->setAttribute('categoryList', $retval);
        unset($model);
    }

}
