<?php



namespace components\shoppingcart\listeners;


use core\eventlisteners\AbstractListener;
use libraries\utils\Registry;
use components\shoppingcart\models\ProductVariantItemModel;

class LoadProductVariantsListener extends AbstractListener
{
 
   public function on_before_render_start($params = array()) {
       
        $product = current($params['Product']);
        $locale = $this->getDefaultLocale();
        $data = array('id' => $product['id'], 'locale' => $locale['locale']);
        $productVariant = new ProductVariantItemModel($this->httpRequest, $this->httpResponse, $this->logger);

        $defaultLocale =  $this->getDefaultLocale();
        $params = array('locale '=> $defaultLocale['locale']);

        $datasource = $this->getDatasource('components\shoppingcart\models\ProductVariantItemModel');
       
        $productVariantList = $datasource->query('get', $productVariant, 'listProductVariants', $data);

        unset($model);
        $list = current($productVariantList);
      
        $retval = array();
        foreach($list[0] as $variant) {
            $retval[$variant['groupName']][$variant['VariantItems_id']] = array('variant' =>$variant['variant'], 'surcharge' => $variant['surcharge']);
            
        }
     
        $this->httpRequest->setAttribute('ProductVariantList', $retval);
   }
   
}
