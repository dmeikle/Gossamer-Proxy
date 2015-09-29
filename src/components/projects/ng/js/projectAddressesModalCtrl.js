module.controller('projectAddressesModalCtrl', function($modalInstance, $scope, projectAddressesEditSrv, $filter) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
   
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close();
        //$modalInstance.close($scope.staff);
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    
    $scope.save = function (object){
        
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        console.log(object);
        console.log(formToken);
        projectAddressesEditSrv.save(object, formToken);
        //$modalInstance.close();        
    };
    
    //Clear timesheet
    $scope.clearTimesheet = function (){
        console.log('clearing timesheet');
        $scope.laborer = '';
        $scope.vehicleID = '';
        
        
        $scope.timesheetItems = [{
            isSelected: false,
            Claims_id: '',
            jobNumber: '',
            AccountingPhaseCodes_id: '',
            StaffTypes_id: '',
            description: '',
            toll1: '',
            toll2: '',
            regularHours: 0,
            overtimeHours: 0,
            doubleOTHours: 0,
            statRegularHours: 0,
            statOTHours: 0,
            statDoubleOTHours: 0,
            totalHours: 0
        }];
        
    };
    
});
