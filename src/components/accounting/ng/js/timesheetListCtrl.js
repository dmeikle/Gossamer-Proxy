module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;    
    $scope.loading = true;
    
    timesheetSrv.getTimesheetList(0,20).then(function(){
        $scope.loading = false;
        $scope.timesheetList = timesheetSrv.timesheetList;  
    });
    console.log('timesheet List 2!');   
    
    //Modals
    $scope.openTimesheetModal = function() {
        var template = templateSrv.timesheetModal;
        $modal.open({
          templateUrl: template,
          controller: 'timesheetModalCtrl',
          size: 'lg',
//          resolve: {
//            staff: function() {
//              return staff;
//            }
//          }
            
//        })
//            .catch(function(error) {
//            // error contains a detailed error message.
//            $scope.error.showError = true;
//            $scope.error.message = 'Could not connect to the database, please try again.';
//            console.log(error);
        });
    };    
});

module.controller('timesheetModalCtrl', function($modalInstance, $scope, timesheetSrv) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    $scope.confirm = function() {
        $modalInstance.close($scope.staff);
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    
    //Get the dates
    $scope.getDates = function(){
        $scope.date = new Date();
        $scope.yesterday = $scope.date.setDate($scope.date.getDate() - 1);
    };
    
    //Call the functions
    $scope.getDates();
    
    //Autocomplete
    function fetchAutocomplete() {
        timesheetSrv.autocomplete($scope.basicSearch)
            .then(function() {
            $scope.autocomplete = timesheetSrv.autocompleteList;
        });
    }
    $scope.$watch('basicSearch.val', function() {
        if ($scope.basicSearch.val) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });
    
    //Search
    $scope.search = function() {
        var searchObject = $scope.basicSearch;
        console.log(searchObject);
        if (searchObject.val) {
            timesheetSrv.filterListBy(0, 20, searchObject)
                .then(function() {
                if (timesheetSrv.searchResults) {
                    $scope.staffList = timesheetSrv.searchResults;
                    $scope.totalItems = timesheetSrv.searchResultsCount;
                    if($scope.totalItems == 1){
                        $scope.positionID = $scope.staffList[0].StaffPositions_id;
                        $scope.setCategory($scope.positionID);
                        $scope.laborerPositionID = $scope.staffList[0].StaffPositions_id;
                        $scope.hourlyRate = $scope.staffList[0].HourlyRate;
                    }
                }
            });
        }
    };   
    $scope.timesheetSelected = false;
    
    //watch the timesheet for updates
    $scope.$watch('newTimesheet', function() {
        console.log('Time sheet updated!');
        for(var i in $scope.newTimesheet){
            if($scope.newTimesheet[i].selected === true){
                $scope.timesheetSelected = true;
                return;
            } else {
                $scope.timesheetSelected = false;
            }
        }
    }, true);
    
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
    $scope.sumTotal = {
        reg:0,
        ot: 0,
        dot: 0,
        sreg: 0,
        sot: 0,
        sdot: 0,
        total: 0
    };
    
    //Update the hour totals
    $scope.updateTotal = function(row, col){
        row.total = 0;
        
        var rowHours = {
            reg: parseInt(row.reg),
            ot: parseInt(row.ot),
            dot: parseInt(row.dot),
            sreg: parseInt(row.sreg),
            sot: parseInt(row.sot),
            sdot: parseInt(row.sdot)
        };
 
        if(row[col] === ''){
            rowHours[col] = 0;
        }

        row.total = rowHours.reg + rowHours.ot + rowHours.dot + rowHours.sreg + rowHours.sot + rowHours.sdot;


        $scope.sumTotal[col] = 0;
        $scope.sumTotal.total = 0;

        for(var i in $scope.newTimesheet){
            var totalCol = Object.keys($scope.newTimesheet[i]).length-1;
            var totalRow = parseInt($scope.newTimesheet[i].total);

            if($scope.newTimesheet[i][col] === ''){
                $scope.sumTotal[col] += 0;
            } else {                
                $scope.sumTotal[col] += parseInt($scope.newTimesheet[i][col]);
                $scope.sumTotal.total += totalRow;
            }
        }
    };
    
    $scope.updateTotalSum = function(){
        
    };
    
    //Add a row to the bottom of the timesheet
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
        if($scope.laborerPositionID !== ''){
            $scope.newTimesheet[$scope.newTimesheet.length-1].category = $scope.laborerPositionID;
        }
    };
    
    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function(){
        for (var i in $scope.newTimesheet){
            
            if($scope.newTimesheet[i].selected === true){
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
            if($scope.laborerPositionID !== ''){
                $scope.newTimesheet[$scope.newTimesheet.length-1].category = $scope.laborerPositionID;
            }
        }
    };
    
    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function(){
        console.log('--DELETE ROWS---');
        var timesheet = $scope.newTimesheet;
        var newArray = timesheet;
        
        for (var i = $scope.newTimesheet.length-1; i >= 0; i--){            
            console.log('Timesheet ' + $scope.newTimesheet[i].claim);
            if($scope.newTimesheet[i].selected === true){
                console.log('Timesheet ' + $scope.newTimesheet[i].claim + ' is being deleted!');
                newArray.splice(parseInt(i), 1);                
            }            
        }
        
        $scope.newTimesheet = newArray;
    };
    
    
    //Select All
    $scope.selectAllToggle = function(value){
        if(value === true){
            for(var i in $scope.newTimesheet){
                $scope.newTimesheet[i].selected = true;
            }
        } else {
            for(var j in $scope.newTimesheet){
                $scope.newTimesheet[j].selected = false;
            }
        }
    };
    
    
    //check the selected rows
    $scope.checkSelected = function(value){
        if(value === false){
            $scope.selectAll = false;
        }
    };
    
    $scope.setCategory = function(positionID){
        console.log('position ID = ' + positionID);
        if($scope.newTimesheet.length == 1){
            $scope.newTimesheet[0].category = positionID;
        }
    };
    
    //On Text Click
    $scope.checkEmpty = function (row, col) {
        if(row[col] === ''){
            row[col] = 0;
        }
    };
});