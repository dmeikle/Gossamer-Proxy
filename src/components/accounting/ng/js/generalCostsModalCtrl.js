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
    }
    //Insert a row
    
    //Delete a row
    
    //Check selected
    $scope.checkSelected = function(){
        $scope.rowSelected = true;
        for(var index in $scope.generalCostItems){
            if($scope.generalCostItems[index].isSelected === true){
                $scope.rowSelected = true;
            }
        }
    }
    
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