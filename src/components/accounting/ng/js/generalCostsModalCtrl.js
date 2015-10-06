module.controller('generalCostsModalCtrl', function($modalInstance, $scope, generalCostsModalSrv, $filter, generalCost) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = [];
    
    console.log(generalCost);
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close();
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    
    //Set up the objects
    var generalCostItemsTemplate = {
        isSelected:false,
        id: '',
        name:'',
        description:'',
        dateEntered:'',
        Departments_id:'',
        cost:'',
        chargeOut: '',
        AccountingDebitAccounts_id:'',
        isApproved: '0',
        isCancelled: '0',
        isExported: '0'
    };
    $scope.AccountingGeneralCost = {
        id: '',
        Claims_id: '',
        ClaimPhases_id: '',
        AccountingCreditAccounts_id: '',
        jobNumber: ''
    };
    $scope.generalCostItems = angular.copy([generalCostItemsTemplate]);
    
    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function(jobNumber){
        for(var i in generalCostsModalSrv.autocomplete){
            if(generalCostsModalSrv.autocomplete[i].label === jobNumber){
                $scope.AccountingGeneralCost.Claims_id = generalCostsModalSrv.autocomplete[i].id;
            }
        }
    };
    
    //---Table Controls---
    //Add a row    
    $scope.addRow = function(){
        $scope.generalCostItems.push(angular.copy([generalCostItemsTemplate]));
    };
        
    //Insert rows below currently selected items
    $scope.insertRows = function(){
        for (var i in $scope.generalCostItems){
            if($scope.generalCostItems[i].isSelected === true){
                $scope.generalCostItems.splice(parseInt(i)+1, 0, angular.copy(generalCostItemsTemplate));
            }
        }
    };
    
    //Remove Rows from timesheet
    $scope.removeRows = function(){
        for (var i = $scope.generalCostItems.length-1; i >= 0; i--){
            if($scope.generalCostItems[i].isSelected === true){
                $scope.generalCostItems.splice(parseInt(i), 1);
            }
        }
    };
    
    //Check selected
    $scope.checkSelected = function(){
        $scope.rowSelected = true;
        for(var index in $scope.generalCostItems){
            if($scope.generalCostItems[index].isSelected === true){
                $scope.rowSelected = true;
            }
        }
    };

    //Select All
    $scope.selectAllToggle = function(value){
        for(var i in $scope.generalCostItems){
            if(value === true){
                $scope.generalCostItems[i].isSelected = true;
            } else {
                $scope.generalCostItems[i].isSelected = false;
            }
        }
    };
    
    //Typeahead
    $scope.fetchStaffAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return generalCostsModalSrv.fetchAutocomplete(searchObject);
    };
    
    $scope.fetchClaimAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.Claims_id = viewVal;
        return generalCostsModalSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day':1};
    $scope.openDatepicker = function(event, index){
        $scope.isOpen.datepicker[index] = true;
    };
    
    //Saving Items    
    $scope.saveGeneralCostItems = function(){
        var generalCostItems = angular.copy($scope.generalCostItems);
        for (var i in generalCostItems){
            console.log('filtering date!');
            generalCostItems[i].dateEntered = $filter('date')(generalCostItems[i].dateEntered, 'yyyy-MM-dd');            
        }
        console.log('Saving Items!');
        
        //$scope.AccountingGeneralCost.AccountingGeneralCostItems = generalCostItems;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        generalCostsModalSrv.saveGeneralCosts($scope.AccountingGeneralCost, generalCostItems, formToken);
        
        console.log($scope.AccountingGeneralCost);
        console.log(generalCostItems);
    };
});