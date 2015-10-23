<?php

namespace components\shoppingcart\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use components\shoppingcart\models\ProductVariantItemModel;

class LoadProductVariantsListener extends AbstractListener {

    public function on_before_render_start(Event $event) {

        $params = $event->getParams();
        if (is_null($params)) {
            //didn't find it
            return;
        }

        //$product = current($params['CartProduct']);
        $product = $this->getProduct($params);

        $locale = $this->getDefaultLocale();
        $data = array('id' => $product['id'], 'locale' => $locale['locale']);
        $productVariant = new ProductVariantItemModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale = $this->getDefaultLocale();
        $params = array('locale ' => $defaultLocale['locale']);

        $datasource = $this->getDatasource('components\shoppingcart\models\ProductVariantItemModel');

        $productVariantList = $datasource->query('get', $productVariant, 'listProductVariants', $data);

        unset($model);

        $list = current($productVariantList);

        $retval = array();
        foreach ($list as $variant) {
            if (count($variant) == 0) {
                continue;
            }
            $retval[$variant['groupName']][$variant['VariantItems_id']] = array('variant' => $variant['variant'], 'surcharge' => $variant['surcharge']);
        }

        $this->httpResponse->setAttribute('CartProductVariantList', $retval);
    }

    private function getProduct(array $params) {

        if (array_key_exists('CartProduct', $params)) {
            return current($params['CartProduct']);
        }
        $product = $params['product'];
        $product['id'] = key($params['product']);

        return $product;
    }

    /**
     * this method is for loading SELECTED options by user only, for adding
     * to their basket
     *
     * @param array $params
     */
    public function on_request_start($params) {

        $params = $this->httpRequest->getPost();

        if (!array_key_exists('product', $params) || !array_key_exists('variants', $params['product'])) {
            return;
        }
        $idList = '';
        foreach ($params['product']['variants'] as $key => $value) {
            $idList .= ',' . intval($value);
        }


        $productVariant = new ProductVariantItemModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale = $this->getDefaultLocale();
        $data = array('idlist' => substr($idList, 1), 'locale' => $defaultLocale['locale']);


        $datasource = $this->getDatasource('components\shoppingcart\models\ProductVariantItemModel');

        $productVariantList = $datasource->query('get', $productVariant, 'listProductVariantsById', $data);

        unset($model);
        $this->httpRequest->setAttribute('ProductVariantList', $productVariantList);
    }

}
