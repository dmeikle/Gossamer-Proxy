module.controller('inventoryModalCtrl', function($modalInstance, $scope, inventoryModalSrv, $filter, $timeout) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = false;
    
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    //console.log(generalCost);
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close();
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    
    //Set up the objects
    $scope.headings = {
        Claims_id: '',
        ClaimPhases_id: '',
        dateUsed:''
    };
    
    var lineItemsTemplate = {
        isSelected:false,
        productCode:'',
        InventoryItems_id: '',
        name: '',
        PackageTypes_id:'',
        unitPrice:'',
        quantity:'',
        //description:'',
        //date:'',
        Departments_id: '',
        cost:'',
        chargeOut: ''
        
    };
    
    $scope.total = {
        cost: 0,
        chargeout: 0
    };
//    //Check and see if you're editing an item or creating a new one...
//    if(generalCost){
//        $scope.loading = true;
//        generalCostsModalSrv.getGeneralCostItems(row, numRows, generalCost.id)
//        .then(function(){
//            console.log(generalCostsModalSrv.generalCostItems);
//            var costItems = generalCostsModalSrv.generalCostItems;
//            for(var i in costItems){
//                //costItems[i].dateEntered = Date.parse((costItems[i].dateEntered.replace(/-/g,"/")));
//                costItems[i].dateEntered = new Date(costItems[i].dateEntered);
//                costItems[i].cost = parseFloat(costItems[i].cost);
//                costItems[i].chargeOut = parseFloat(costItems[i].chargeOut);
//            }
//            $scope.AccountingGeneralCost = generalCost;
//            $scope.generalCostItems = costItems;
//            console.log($scope.generalCostItems);
//            $scope.loading = false;
//        });
//    } else {
//        $scope.loading = false;
        $scope.lineItems = angular.copy([lineItemsTemplate]);
//    }
    
    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function(jobNumber){
        console.log(inventoryModalSrv.claimsAutocomplete);
        for(var i in inventoryModalSrv.claimsAutocomplete){
            if(inventoryModalSrv.claimsAutocomplete[i].jobNumber === jobNumber){
                $scope.headings.Claims_id = inventoryModalSrv.claimsAutocomplete[i].id;
                //$scope.claimsLocations = $scope.getClaimsLocations($scope.headings.Claims_id);
                inventoryModalSrv.getClaimsLocations($scope.headings.Claims_id).then(function(locations){
                    console.log('heya');
                    $scope.claimsLocations = locations;
                });
                
//                $timeout(function(){
//                    console.log($scope.claimsLocations);
//                },5000);
            }
        }
    };
    
    //---Table Controls---
    //Add a row    
    $scope.addRow = function(){
        $scope.lineItems.push(angular.copy(lineItemsTemplate));
    };
        
    //Insert rows below currently selected items
    $scope.insertRows = function(){
        for (var i in $scope.lineItems){
            if($scope.lineItems[i].isSelected === true){
                $scope.lineItems.splice(parseInt(i)+1, 0, angular.copy(lineItemsTemplate));
            }
        }
    };
    
    //Remove Rows from timesheet
    $scope.removeRows = function(){
        for (var i = $scope.lineItems.length-1; i >= 0; i--){
            if($scope.lineItems[i].isSelected === true){
                $scope.lineItems.splice(parseInt(i), 1);
            }
        }
    };
    
    //Check selected
    $scope.checkSelected = function(){
        $scope.rowSelected = true;
        for(var index in $scope.lineItems){
            if($scope.lineItems[index].isSelected === true){
                $scope.rowSelected = true;
            }
        }
    };

    //Select All
    $scope.selectAllToggle = function(value){
        for(var i in $scope.lineItems){
            if(value === true){
                $scope.lineItems[i].isSelected = true;
            } else {
                $scope.lineItems[i].isSelected = false;
            }
        }
    };
    
    //Claim Typeahead
    $scope.fetchClaimAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        console.log('fetching...');
        return inventoryModalSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Materials Typeahead
    $scope.fetchMaterialsAutocomplete = function(viewVal){
        var searchObject = {};
        searchObject.name = viewVal;
        return inventoryModalSrv.fetchMaterialNameAutocomplete(searchObject);
    };
    
    //Product Code Typeahead
    $scope.fetchProductCodeAutocomplete = function(viewVal){
        var searchObject = {};
        searchObject.productCode = viewVal;
        return inventoryModalSrv.fetchProductCodeAutocomplete(searchObject);
    };
    
    //Get Material info from material name
    $scope.getMaterialNameInfo = function(row, value){
        for(var j in inventoryModalSrv.materialsAutocomplete){
            if(inventoryModalSrv.materialsAutocomplete[j].name === value){
                row.productCode = inventoryModalSrv.materialsAutocomplete[j].productCode;
                row.unitPrice = inventoryModalSrv.materialsAutocomplete[j].unitPrice;
                row.PackageTypes_id = inventoryModalSrv.materialsAutocomplete[j].PackageTypes_id;
            }
        }
    };
    
    //Get Material info from product code
    $scope.getProductCodeInfo = function(row, value){
        console.log(inventoryModalSrv.productCodeAutocomplete);
        for(var i in inventoryModalSrv.productCodeAutocomplete){
            if(inventoryModalSrv.productCodeAutocomplete[i].productCode === value){
                row.name = inventoryModalSrv.productCodeAutocomplete[i].name;
                row.unitPrice = inventoryModalSrv.productCodeAutocomplete[i].unitPrice;
                row.PackageTypes_id = inventoryModalSrv.productCodeAutocomplete[i].PackageTypes_id;
                row.InventoryItems_id = inventoryModalSrv.productCodeAutocomplete[i].id;
            }
        }
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day':1};
    $scope.openDatepicker = function(event, index){
        $scope.isOpen.datepicker = true;
    };
    
    
    //Update cost based on item quantity and price
    $scope.updateCost = function(row){
        if(row.quantity === null || row.unitPrice === null){
            row.cost = '';
            return;
        }
        if(row.quantity && row.unitPrice){
            row.cost = row.quantity * row.unitPrice;
        }
    };
    
    //Update totals
    $scope.updateTotal = function(){
        $scope.total = {
            cost: 0,
            chargeout: 0
        };
        for(var i in $scope.lineItems){
            $scope.total.cost += $scope.lineItems[i].cost;
            $scope.total.chargeout += $scope.lineItems[i].chargeOut;
        }
    };
    
    //Get the claims locations
    $scope.getClaimsLocations = function(Claims_id){
        return inventoryModalSrv.getClaimsLocations(Claims_id);
    };
    
    //Saving Items    
    $scope.save = function(){
        var headings = angular.copy($scope.headings);
        var lineItems = angular.copy($scope.lineItems);
        headings.dateUsed = $filter('date')(headings.dateUsed, 'yyyy-MM-dd');
        //$scope.AccountingGeneralCost.AccountingGeneralCostItems = generalCostItems;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        console.log(headings);
        console.log(lineItems);
        
        inventoryModalSrv.save(headings, lineItems, formToken);
        
    };
});