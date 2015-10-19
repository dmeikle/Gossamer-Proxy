module.controller('inventoryModalCtrl', function($modalInstance, $scope, inventoryModalSrv, $filter, $timeout, suppliesUsed) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = false;
    
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close();
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    
    //Set up the objects
    $scope.headings = {
        staffName: '',
        Staff_id: '',
        Claims_id: '',
        ClaimPhases_id: '',
        dateUsed:'',
        ClaimsLocations_id: '',
        Departments_id: ''
    };
    
    var lineItemsTemplate = {
        id:'',
        SuppliesUsedItems_id: '',
        isSelected:false,
        productCode:'',
        InventoryItems_id: '',
        name: '',
        PackageTypes_id:'',
        unitPrice:'',
        quantity:'',
        cost:'',
        chargeOut: ''        
    };
    
    $scope.total = {
        cost: 0,
        chargeOut: 0
    };
    
    //Get the claims locations
    $scope.getClaimsLocations = function(Claims_id){
        //return inventoryModalSrv.getClaimsLocations(Claims_id);
        inventoryModalSrv.getClaimsLocations($scope.headings.Claims_id).then(function(locations){
            $scope.claimsLocations = locations;
        });
    };
    
    //Check and see if you're editing an item or creating a new one...
    if(suppliesUsed){
        $scope.loading = true;
        //console.log(suppliesUsed);
        suppliesUsed.dateUsed = new Date(suppliesUsed.dateUsed);        
        $scope.headings = suppliesUsed;
        $scope.headings.staffName = $scope.headings.firstname + ' ' + $scope.headings.lastname;
        $scope.getClaimsLocations($scope.headings.ClaimsLocations_id);
        inventoryModalSrv.getItems(row, numRows, suppliesUsed.id)
        .then(function(){
            //console.log('loading supplies used thingy!');
            var lineItems = inventoryModalSrv.lineItems;
            for(var i in lineItems){
                lineItems[i].cost = parseFloat(lineItems[i].cost);
                lineItems[i].chargeOut = parseFloat(lineItems[i].chargeOut);
                lineItems[i].quantity = parseFloat(lineItems[i].quantity);
                lineItems[i].id = lineItems[i].SuppliesUsedItems_id;
            }
            //console.log('LINE ITEMS:');
            //console.log(lineItems);
            $scope.lineItems = lineItems;
//            console.log($scope.generalCostItems);
            $scope.updateTotal();
            $scope.loading = false;
        });
    } else {
        $scope.loading = false;
        $scope.lineItems = angular.copy([lineItemsTemplate]);
    }
    
    
    //Get Staff ID from autocomplete list
    $scope.getStaffID = function(name){
        if(name !== undefined){       
            var splitName = name.split(' ');
            //console.log(splitName);
            for(var i in inventoryModalSrv.autocomplete){
                if(splitName[0] === inventoryModalSrv.autocomplete[i].firstname && splitName[1] === inventoryModalSrv.autocomplete[i].lastname){
                    $scope.headings.Staff_id = inventoryModalSrv.autocomplete[i].id;
                }
            }
        }
    };
    
    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function(jobNumber){
        for(var i in inventoryModalSrv.claimsAutocomplete){
            if(inventoryModalSrv.claimsAutocomplete[i].jobNumber === jobNumber){
                $scope.headings.Claims_id = inventoryModalSrv.claimsAutocomplete[i].id;
                $scope.getClaimsLocations($scope.headings.Claims_id);
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
    
    //Staff Typeahead
    $scope.fetchStaffAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return inventoryModalSrv.fetchStaffAutocomplete(searchObject);
    };
    
    //Claim Typeahead
    $scope.fetchClaimAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
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
        //console.log(inventoryModalSrv.productCodeAutocomplete);
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
            chargeOut: 0
        };
        for(var i in $scope.lineItems){
            if(isNaN($scope.lineItems[i].cost)){
                $scope.lineItems[i].cost = 0;
            }
            if(isNaN($scope.lineItems[i].chargeOut)){
                $scope.lineItems[i].chargeOut = 0;
            }
            $scope.total.cost += $scope.lineItems[i].cost;
            $scope.total.chargeOut += $scope.lineItems[i].chargeOut;
        }
    };
    
    
    
    //Saving Items    
    $scope.save = function(){
        var headings = angular.copy($scope.headings);
        var lineItems = angular.copy($scope.lineItems);
        headings.dateUsed = $filter('date')(headings.dateUsed, 'yyyy-MM-dd');
        //$scope.AccountingGeneralCost.AccountingGeneralCostItems = generalCostItems;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        //console.log(headings);
        //console.log(lineItems);        
        inventoryModalSrv.save(headings, lineItems, formToken);
        
    };
});