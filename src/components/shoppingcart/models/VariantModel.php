<?php

namespace components\shoppingcart\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class ProductModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'CartProduct';
        $this->tablename = 'cartproducts';
    }

    public function listAllByCategoryId($category, $offset, $limit) {

        $params = ((strlen($category) > 0) ? array('category' => $category) : array());
        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);


        $defaultLocale = $this->getDefaultLocale();

        $params['locale'] = $defaultLocale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByCategory', $params);
        $data['pageTitle'] = 'Art Wall Tablets';
        $data['title'] = 'Home Decor | Glen Meikle';
        return ($data);
    }

    public function get($itemId) {
        $params = array('id' => $itemId);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        $data['pageTitle'] = 'Art Wall Tablets';
        return ($data);
    }

    public function edit($id) {

        $params = array(
            'id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        //loaded from event dispatcher
        $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');
        $data['categoryOptions'] = $this->formatSelectionBoxOptions($data['categoryList'], array_column($data['Product'][0]['ProductCategory'], 'Categories_id'));
        return ($data);
    }

    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['product']['id'] = $id;

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['product']);

        $data['categoryList'] = $this->httpRequest->getAttribute('categoryList');


        //return ($data);
    }

    public function delete($itemId) {
        $params = $this->httpRequest->getPost();

        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);

        return ($data);
    }

}
