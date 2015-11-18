module.controller('inventoryEditItemCtrl', function($scope, $location, inventoryEditSrv) {
    //$scope.item = {}; //new AngularQueryObject();
    $scope.lineItems = [];
    $scope.vendorItem = {};
    
    $scope.getDetails = function() {
        inventoryEditSrv.getDetails($scope.item).then(function(response) {
            $scope.item = response.data.InventoryItem;
        });
    };

    $scope.saveItem = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEditSrv.save($scope.item, formToken).then(function(response) {
            //do not fire a redirect to reload page
        });
    };

    $scope.saveLineItems = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
       // formatLineItems();
        inventoryEditSrv.saveLineItems($scope.lineItems, formToken, $scope.item.id).then(function(response) {
            //do not fire a redirect to reload page
        });
    }; 
    
    function formatLineItems() {
        var items = $scope.lineItems;        
        
        for(var i in items) {
            if(!items[i].hasOwnProperty('isPreferredVendor ')) {
                items[i].isPreferredVendor = '0';
            }           
        } 
        
        $scope.lineItems = items;
    }
    
    $scope.setVendorId = function(row)  {
        row.Vendors_id = row.company.id;
    };
    
      $scope.fetchVendorsAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.company = viewVal;
        return inventoryEditSrv.fetchVendorsAutocomplete(searchObject);
    };
    
    function LineItem(){
        var inventoryItemsId = document.getElementById('InventoryItem_id').value;
        return {
            vendorsAutocomplete: '',
            productCode: '',
            InventoryItems_id:  inventoryItemsId, //$scope.item.id,
            price: '',
            id: $scope.vendorItem.id,
            Vendors_id: '',
            isPreferredVendor: 0
        }; 
    }
    
    $scope.lineItems.push(new LineItem());
    
    //Table Controls
    $scope.addRow = function(){
        $scope.lineItems.push(new LineItem());        
    };
    
    $scope.insertRows = function () {
        for(var i = $scope.lineItems.length-1; i >= 0; i--){
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i) + 1, 0, new LineItem());
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeRows = function () {
        for (var i = $scope.lineItems.length - 1; i >= 0; i--) {
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i), 1);
            }
        }
    };
});