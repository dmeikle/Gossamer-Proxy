<?php

namespace components\shoppingcart\lib;

use core\datasources\RestDataSource;
use components\shoppingcart\entities\Product;
use components\shoppingcart\entities\VolumeDiscount;

class Cart extends CartIterator {

    private $USDTotal = 0;

    private $CDNTotal = 0;

    private $cartWeight = 0;

    private $shippingOffset = 0;

    private $numPackages = 1;

    private $totalSurcharges = 0;

    private $datasource = null;

    public function __construct(RestDataSource $datasource) {
        $this->datasource = $datasource;
    }

    function addBasketItem($item) {
        return $this->addProduct($item->productID, $item->quantity, $item->options);
    }

    function addProduct($productID, $quantity, $variants) {
        if ($this->numPackages == 0)
            $this->numPackages++;

        $item = $this->getProductFromDB($productID, $quantity);
        $item->variants = $variants;
        $item->quantity = $quantity;
        //$item->options=$variants; it's assumed that we're now receiving IDs instead of strings
        $this->setItemOptions($item, $variants);
        if ($item->shipsSeparately)
            $this->numPackages++;
        $key = "key_" . $this->numRows;
        $item->key = $key;
        $this->stack[$this->numRows++] = $item;
        $this->USDTotal += $item->priceUSD * $quantity;
        $this->CDNTotal += $item->priceCAD * $quantity;
        $this->cartWeight += ($item->weight * $quantity);
        if (isset($item->shippingOffset) && $item->shippingOffset > 0)
            $this->shippingOffset += ($item->shippingOffset * $quantity);

        $item = null;
        return $key;
    }

    function removeProduct($key) {
        $tmpIndex = 0;
        foreach ($this->stack as $item) {
            if ($item->key == $key) {
                unset($this->stack[$tmpIndex]);
                $this->stack = array_merge($this->stack);
                $this->USDTotal -= $item->priceUSD * $item->quantity;
                $this->CDNTotal -= $item->priceCAD * $item->quantity;
                $this->cartWeight -= ($item->weight * $item->quantity);
                if (isset($item->shippingOffset) && $item->shippingOffset > 0)
                    $this->shippingOffset -= ($item->shippingOffset * $item->quantity);
                if (isset($item->shipsSeparately) && $item->shipsSeparately == true)
                    $this->numPackages--;
                if (isset($item->optionSurcharge) && $item->optionSurcharge > 0)
                    $this->totalSurcharges -= $item->optionSurcharge;
                $this->numRows--;
                return;
            }
            $tmpIndex++;
        }
    }

    function nextProduct() {
        if ($this->currentIndex >= $this->numRows) {
            return null;
        }
        $tmp = $this->stack[$this->currentIndex++];
        return $tmp;
    }

    function hasNext() {
        return ($this->currentIndex < $this->numRows);
    }

    function numItems() {
        return $this->numRows;
    }

    function getProductFromDB($productID, $quantity) {
        $params = array('id' => $productId);

        $data = $this->datasource->query(RestDataSource::METHOD_GET, new Product(), 'get', $params);

        $tmp = current($data);

        $tmp['quantity'] = $quantity;

        $this->checkPricing($tmp);

    }

    function moveFirst() {
        $this->currentIndex = 0;
    }

    function checkPricing(array &$tmp) {
        //first check to see if it is on sale
        if ($tmp['isOnSale']) {
            //$tmp->priceUSD=$tmp->salePriceUSD;
            $tmp['price'] = $tmp->salePrice;
            return;
        }

        $params = array('productId' => $tmp['productId'], 'quantity' => $tmp['quantity']);

        $data = $this->datasource->query(RestDataSource::METHOD_GET, new VolumeDiscount(), 'get', $params);

        // $tmp->priceCAD=$tmp->priceCAD*(1-(.01*$discount->discount));
        // $tmp->priceUSD=$tmp->priceUSD*(1-(.01*$discount->discount));
        $tmp['price'] = $data['price'] * (1 - (.01 * $data['discount']));

    }

    function setItemOptions(&$tmp, $variants) {

        //iterate through each variantID and get its value
        $ary = explode("|", $variants);
        foreach ($ary as $listItem) {
            if (is_numeric($listItem)) {
                $surcharge = $this->checkVariantSurcharge($tmp, $listItem);
                $tmp->surcharge = $surcharge;
            } else
                $tmp->options .= " $listItem";
        }
    }

    function checkVariantSurcharge(&$tmp, $variantID) {
        $variant = new VariantGroupItem;
        $cmd = new GetItemCommand;
        $variant->variantID = $variantID;
        $cmd->execute($variant);
        $cmd = null;
        if ($variant->getNext()) {
            $tmp->optionSurcharge += $variant->surcharge;
            //increment since their may be more that 1 option
            $tmp->options .= " | " . $variant->variant;
            $this->totalSurcharges += $variant->surcharge;
        }
        $variant = null;
        return 0;

    }

}
