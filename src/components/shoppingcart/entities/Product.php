<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\entities;

use components\shoppingcart\lib\CartIterator;


class Product extends CartIterator
{    
    
    
    protected $productID;
    
    protected $categoryID;
    
    protected $name;
    
    protected $description;
    
    protected $customersRating;
    
    protected $priceUSD;
    
    protected $price;
    
    protected $salePriceUSD;
    
    protected $salePrice;
    
    protected $isOnSale;
    
    protected $picture;
    
    protected $inStock;
    
    protected $thumbnail;
    
    protected $customerVotes;
    
    protected $itemsSold;
    
    
    public function getProductId() {
        return $this->productID;
    }
    
    public function setProductId($productId) {
        $this->productId = $productId;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getCustomersRating() {
        return $this->customersRating;
    }
    
    public function setCustomersRating($customersRating) {
        $this->customersRating = $customersRating;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    public function getSalePrice() {
        return $this->salePrice;
    }
    
    public function setSalePrice($salePrice) {
        $this->salePrice = $salePrice;
    }
    
    public function getIsOnSale() {
        return $this->isOnSale;
    }
    
    public function setIsOnSale($isOnSale) {
        $this->isOnSale = $isOnSale;
    }
    
    public function getPicture() {
        return $this->picture;
    }
    
    public function setPicture($picture) {
        $this->picture = $picture;
    }
    
    public function getInStock() {
        return $this->inStock;
    }
    
    public function setInstock($inStock) {
        $this->inStock = $inStock;
    }
    
    public function getThumbnail() {
        return $this->thumbnail;
    }
    
    public function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }
    
    public function getCustomerVotes() {
        return $this->customerVotes;
    }
    
    public function setCustomerVotes($customerVotes) {
        $this->customerVotes = $customerVotes;
    }
    
    public function getItemsSold() {
        return $this->itemsSold;
    }
    
    public function setItemsSold($itemsSold) {
        $this->itemsSold = $itemsSold;
    }
    
    protected $bigPicture;
    
    protected $enabled;
    
    protected $briefDescription;
    
    protected $listPrice;
    
    protected $productCode;
    
    protected $weight;
    
    protected $discontinued=false;
    
    protected $dateIn;
    
    protected $hasCustomText = false;
    
    protected $shippingOffset;
    
    protected $shipsSeparately = false;
    
    protected $minimumOrderQuantity = 1;
    
    protected $numPerBox;
    
    protected $deliveryTime;
    
    protected $filename;
    
    
    public function getBigPicture() {
        return $this->bigPicture;
    }
    
    public function setBigPicture($bigPicture) {
        $this->bigPicture = $bigPicture;
    }
    
    public function getEnabled() {
        return $this->enabled;
    }
    
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
    
    public function getEnabled() {
        return $this->enabled;
    }
    
    public function setBriefDescription($briefDescription) {
        $this->briefDescription = $briefDescription;
    }
    
    public function getListPrice() {
        return $this->listPrice;
    }
    
    public function setListPrice($listPrice) {
        $this->listPrice = $listPrice;
    }
    
    public function getProductCode() {
        return $this->productCode;
    }
    
    public function setProductCode($productCode) {
        $this->productCode = $productCode;
    }
    
    public function getWeight() {
        return $this->weight;
    }
    
    public function setWeight($weight) {
        $this->weight = $weight;
    }
    
    public function getDiscontinued() {
        return $this->discontinued;
    }
    
    public function setDiscontinued($discontinued) {
        $this->discontinued = $discontinued;
    }
    
    public function getDateIn() {
        return $this->dateIn;
    }
    
    public function setDateIn($dateIn) {
        $this->dateIn = $dateIn;
    }
    
    public function getHasCustomText() {
        return $this->hasCustomText;
    }
    
    public function setHasCustomText($hasCustomText) {
        $this->hasCustomText = $hasCustomText;
    }
    
    public function getShippingOffset() {
        return $this->shippingOffset;
    }
    
    public function setShippingOffset($shippingOffset) {
        $this->shippingOffset = $shippingOffset;
    }
    
    public function getShipsSeparately() {
        return $this->shipsSeparately;
    }
    
    public function setShipsSeparately($shipsSeparately) {
        $this->shipsSeparately = $shipsSeparately;
    }
    
    public function getMinimumOrderQuantity() {
        return $this->minimumOrderQuantity;
    }
    
    public function setMinimumOrderQuantity($minQty) {
        $this->minimumOrderQuantity = $minQty;
    }
    
    public function getNumPerBox() {
        return $this->numPerBox;
    }
    
    public function setNumPerBox($numPerBox) {
        $this->numPerBox = $numPerBox;
    }
    
    public function getDeliveryTime() {
        return $this->deliveryTime;
    }
    
    public function setDeliveryTime($deliveryTime) {
        $this->deliveryTime = $deliveryTime;
    }
    
    public function setFilename($filename) {
        $this->filename = $filename;
    }
    
    public function getFilename() {
        return $this->filename;
    }
}
