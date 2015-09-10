module.controller('timesheetListCtrl', function($scope, $modal,  costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;
    
    $scope.loading = true;
    
    timesheetSrv.getTimesheetList(0,20).then(function(){
        $scope.loading = false;
        $scope.timesheetList = timesheetSrv.timesheetList;  
    });
    console.log('timesheet List 2!');

//    $scope.date = new Date();
//    //$scope.yesterday = $scope.date.setDate($scope.date.getDate() - 1);
//    $scope.yesterday = 'yesterday!!';

    //console.log($scope.yesterday);
    
    //Get the dates
    $scope.getDates = function(){
        console.log('Getting dates');
        $scope.date = new Date();
        $scope.yesterday = $scope.date.setDate($scope.date.getDate() - 1);
        //$scope.yesterday = 'yesterday!!';
        //$scope.$apply();
    };
    
    $scope.getDates();
});