module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    //$scope.rowsPerPage = 20;
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;    
    $scope.loading = true;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;    
    
    function getTimesheetList(){
        $scope.loading = true;
        console.log(row + ' ' + numRows);
        
        timesheetSrv.getTimesheetList(row,numRows)
            .then(function(){
                $scope.loading = false;
                $scope.timesheetList = timesheetSrv.timesheetList;
                $scope.totalItems = timesheetSrv.timesheetCount;
                console.log($scope.totalItems);
                if(timesheetSrv.error.showError === true){
                    $scope.error.showError = true;
                    //$scope.error.message = 'Could not reach the database, please try again.';
                }
        });
    }
       
    $scope.$watch('currentPage + itemsPerPage', function() {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getTimesheetList(row, numRows);
    });
    
    //Modals
    $scope.openTimesheetModal = function(timesheet) {
        var template = templateSrv.timesheetModal;
        var modal = $modal.open({
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
        modal.result.then(function(timesheet){
            //$scope.timesheet
            getTimesheetList();
        });
    };
    
});
