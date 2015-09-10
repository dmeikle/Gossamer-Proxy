module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;
    
    $scope.loading = true;
    
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    
    timesheetSrv.getTimesheetList(0,20).then(function(){
        $scope.loading = false;
        $scope.timesheetList = timesheetSrv.timesheetList;  
    });
    console.log('timesheet List 2!');

    //Get the dates
    $scope.getDates = function(){
        console.log('Getting dates');
        $scope.date = new Date();
        $scope.yesterday = $scope.date.setDate($scope.date.getDate() - 1);
    };
    
    //Autocomplete
    function fetchAutocomplete() {
        //console.log($scope.basicSearch);
          timesheetSrv.autocomplete($scope.basicSearch)
              .then(function() {
              $scope.autocomplete = timesheetSrv.autocompleteList;
          });
    }
    
    $scope.$watch('basicSearch.val', function() {
        //console.log($scope.basicSearch.val);
        if ($scope.basicSearch.val !== undefined) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });
    
    //Call the functions
    $scope.getDates();
    
    
});