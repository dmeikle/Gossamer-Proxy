<?php

namespace components\shoppingcart\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class CategoryModel extends AbstractModel {

    const DIRECTIVES = 'directives';

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'CartCategory';
        $this->tablename = 'cartcategories';
    }

//    public function listAll($offset = 0, $limit = 20, $customVerb = null) {
//        $params = array();
//        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);
//
//        $defaultLocale =  $this->getDefaultLocale();
//        $params['locale'] = $defaultLocale['locale'];
//        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
//
//        return ($data);
//    }

    public function edit($id) {
        //pre-loaded from eventhandler
        $categories = $this->httpRequest->getAttribute('categoryList');

        $params = array('id' => $id);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $data['categories'] = $categories;
        $data['thumbnails'] = $this->getFileList(__SITE_PATH . "/web/images/categories/");
        return ($data);
    }

    public function listAllByParentId($parentId, $offset, $limit) {
        $params = (($parentId > 0) ? array('parentId' => $parentId) : array());
        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);

        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        return ($data);
    }

    public function get($categoryId) {
        echo "deprecating get to use edit. id is $categoryId";
        die;
        $params = array('id' => $categoryId);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        return ($data);
    }

    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['category']['id'] = $id;


        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['category']);

        // return ($data);
    }

    public function delete($categoryId) {
        $params = $this->httpRequest->getPost();

        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);

        return ($data);
    }

}
