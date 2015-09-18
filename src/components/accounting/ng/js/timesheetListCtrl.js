module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;    
    $scope.loading = true;
    
    timesheetSrv.getTimesheetList(0,20)
        .then(function(){
            $scope.loading = false;
            $scope.timesheetList = timesheetSrv.timesheetList;
        console.log($scope.timesheetList);
            if(timesheetSrv.error.showError === true){
                $scope.error.showError = true;
                //$scope.error.message = 'Could not reach the database, please try again.';
            }
    });
       
    
    //Modals
    $scope.openTimesheetModal = function(timesheet) {
        var template = templateSrv.timesheetModal;
        $modal.open({
            templateUrl: template,
            controller: 'timesheetModalCtrl',
            size: 'lg',
            resolve: {
                timesheet: function () {
                    return timesheet;
                }
            }
//          resolve: {
//            staff: function() {
//              return staff;
//            }
//          }
            
//        })
        });
    };    
});
