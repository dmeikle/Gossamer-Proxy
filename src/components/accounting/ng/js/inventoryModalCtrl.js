module.controller('inventoryModalCtrl', function($modalInstance, $scope, inventoryModalSrv, $filter) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = [];
    
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
        ClaimPhases_id: ''
    };
    
    var lineItemsTemplate = {
        isSelected:false,
        materialName: '',
        unit:'',
        unitPrice:'',
        qty:'',
        description:'',
        date:'',
        department: '',
        cost:'0',
        chargeout: '0'
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
        for(var i in inventoryModalSrv.autocomplete){
            if(inventoryModalSrv.autocomplete[i].jobNumber === jobNumber){
                $scope.headings.Claims_id = inventoryModalSrv.autocomplete[i].id;
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
    
    //Typeahead
    $scope.fetchStaffAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return inventoryModalSrv.fetchAutocomplete(searchObject);
    };
    
    $scope.fetchClaimAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return inventoryModalSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day':1};
    $scope.openDatepicker = function(event, index){
        $scope.isOpen.datepicker[index] = true;
    };
    
    //Saving Items    
    $scope.save = function(){
        var lineItems = angular.copy($scope.lineItems);
//        for (var i in lineItems){
//            //console.log('filtering date!');
//            generalCostItems[i].dateEntered = $filter('date')(generalCostItems[i].dateEntered, 'yyyy-MM-dd');            
//        }
        console.log('Saving Items!');
        
        //$scope.AccountingGeneralCost.AccountingGeneralCostItems = generalCostItems;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        inventoryModalSrv.save($scope.headings, lineItems, formToken);
        
    };
});