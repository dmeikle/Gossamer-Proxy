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
    
    //Timesheet template
    var timesheetTemplate = {
        selected: false,
        claim: '',
        phase: '',
        category: '',
        description: '',
        reg: '0',
        ot: '0',
        dot: '0',
        sreg: '0',
        sot: '0',
        sdot: '0',
        total: '0'
    };
    
    //New Timesheet
    $scope.newTimesheet = [timesheetTemplate];
    
    $scope.updateTotal = function(row){
        row.total = parseInt(row.reg) + parseInt(row.ot) + parseInt(row.dot);
    };
    
    $scope.addTimesheetRow = function(){
        $scope.newTimesheet.push({
        selected: false,
        claim: '',
        phase: '',
        category: '',
        description: '',
        reg: '0',
        ot: '0',
        dot: '0',
        sreg: '0',
        sot: '0',
        sdot: '0',
        total: '0'
    });
    };
    
    $scope.insertTimesheetRows = function(){
        for (var i in $scope.newTimesheet){
            
            if($scope.newTimesheet[i].selected === true){
                //console.log('selected row = ' + i+1);
                console.log($scope.newTimesheet[i]);
                $scope.newTimesheet.splice(parseInt(i)+1, 0,
                {
                    selected: false,
                    claim: '',
                    phase: '',
                    category: '',
                    description: '',
                    reg: '0',
                    ot: '0',
                    dot: '0',
                    sreg: '0',
                    sot: '0',
                    sdot: '0',
                    total: '0'
                });                
            }            
        }
    };
    
    $scope.removeTimesheetRows = function(){
        for (var i in $scope.newTimesheet){
            
            if($scope.newTimesheet[i].selected === true){
                $scope.newTimesheet.splice(parseInt(i), 1);                
            }            
        }
    };
    //Call the functions
    $scope.getDates();
    
    
});