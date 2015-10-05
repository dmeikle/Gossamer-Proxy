module.controller('generalCostsModalCtrl', function($modalInstance, $scope, generalCostsModalSrv) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = [];
    var generalCostItemsTemplate = {
        isSelected:false,
        name:'',
        description:'',
        date:'',
        department:'',
        cost:'',
        chargeout: '',
        debitAccount:''
    };
    
    $scope.generalCostItems = angular.copy([generalCostItemsTemplate]);
    
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
        console.log('autocompleting...');
        var searchObject = {};
        searchObject.name = viewVal;
        return generalCostsModalSrv.fetchAutocomplete(searchObject);
    };
    
    $scope.fetchClaimAutocomplete = function(viewVal) {
        console.log('autocompleting...');
        var searchObject = {};
        searchObject.Claims_id = viewVal;
        return generalCostsModalSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day':1};
    $scope.openDatepicker = function(event, index){
        $scope.isOpen.datepicker[index] = true;
    };
});