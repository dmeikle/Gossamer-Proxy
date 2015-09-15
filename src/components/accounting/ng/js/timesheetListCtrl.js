module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;    
    $scope.loading = true;
    
    timesheetSrv.getTimesheetList(0,20)
        .then(function(){
            $scope.loading = false;
            $scope.timesheetList = timesheetSrv.timesheetList;
            if(timesheetSrv.error.showError === true){
                $scope.error.showError = true;
                //$scope.error.message = 'Could not reach the database, please try again.';
            }
    });
       
    
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

module.controller('timesheetModalCtrl', function($modalInstance, $scope, timesheetSrv, $filter) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    
    //Modal Controls
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
    
    //Call getDates
    $scope.getDates();
    
    //Laborer Autocomplete
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
        //console.log(searchObject);
        if (searchObject.val) {
            timesheetSrv.filterListBy(0, 20, searchObject)
                .then(function() {
                if (timesheetSrv.searchResults) {
                    $scope.staffList = timesheetSrv.searchResults;
                    $scope.totalItems = timesheetSrv.searchResultsCount;
                    if($scope.totalItems == 1){
                        $scope.positionID = $scope.staffList[0].StaffPositions_id;
                        $scope.setCategory($scope.positionID);
                        $scope.staffID = $scope.staffList[0].id;
                        $scope.laborerPositionID = $scope.staffList[0].StaffPositions_id;
                        $scope.hourlyRate = $scope.staffList[0].HourlyRate;                        
                        $scope.laborerName = $scope.staffList[0].lastname + ', ' + $scope.staffList[0].firstname;                       
                    }
                }
            });
        }
    };
    
    //Claims Autocomplete
    //Fetch claims
    function fetchClaims(search) {
        console.log('fetching claims...');
        timesheetSrv.claimsAutocomplete(search)
            .then(function() {
            if(timesheetSrv.claimsCount > 0){
                console.log('found ' + timesheetSrv.claimsCount  + ' matching claims'); 
                $scope.claimsAutocomplete = timesheetSrv.claimsList;
            } else {
                console.log('no matching claims found!');
            }
        });
    }
    
    //Clear the Claims list
    $scope.clearClaimsList = function(){
        $scope.claimsAutocomplete = {};
    }
    
    //Search Claims
//    $scope.claimsSearch = function() {
//        var searchObject = $scope.claimsSearch;
//        if (searchObject.val) {
//            timesheetSrv.filterClaims(0, 20, searchObject)
//            .then(function() {
//                if(timesheetSrv.claimResults) {
//                    console.log(timesheetSrv.claimResults);
//                }
//            });
//        }
//    };
    
    $scope.watchClaims = function(row){
        console.log(row);
       // $scope.newTimesheet[row].Claims_id;
        fetchClaims(row.Claims_id);
    };
    
    
    $scope.timesheetSelected = false;
    
    //watch the timesheet for updates
    $scope.$watch('newTimesheet', function() {
        console.log('Time sheet updated!');
        for(var i in $scope.newTimesheet){
            if($scope.newTimesheet[i].isSelected === true){
                $scope.timesheetSelected = true;
                return;
            } else {
                $scope.timesheetSelected = false;
            }
        }
    }, true);
    
    //Timesheet template
    var timesheetTemplate = {
        isSelected: false,
        Claims_id: '',
        AccountingPhaseCodes_id: '',
        StaffTypes_id: '',
        description: '',
        toll1: 'test',
        toll2: '',
        regularHours: '0',
        overtimeHours: '0',
        doubleOTHours: '0',
        statRegularHours: '0',
        statOTHours: '0',
        statDOTHours: '0',
        total: '0'
    };
    
    //New Timesheet
    $scope.newTimesheet = [timesheetTemplate];
    //console.log($scope.newTimesheet);
    
    $scope.sumTotal = {
        regularHours: '0',
        overtimeHours: '0',
        doubleOTHours: '0',
        statRegularHours: '0',
        statOTHours: '0',
        statDOTHours: '0',
        total: 0
    };
    
    //Update the hour totals
    $scope.updateTotal = function(row, col){
        row.total = 0;
        
        var rowHours = {
            reg: parseInt(row.regularHours),
            ot: parseInt(row.overtimeHours),
            dot: parseInt(row.doubleOTHours),
            sreg: parseInt(row.statRegularHours),
            sot: parseInt(row.statOTHours),
            sdot: parseInt(row.statDOTHours)
        };
 
        if(row[col] === ''){
            rowHours[col] = 0;
        }

        row.total = rowHours.reg + rowHours.ot + rowHours.dot + rowHours.sreg + rowHours.sot + rowHours.sdot;

        $scope.updateTotalSum();
        //console.log('ROW TOLLS = ' + row.toll1 + ' ' + row.toll2);
    };
    
    $scope.updateTotalSum = function(){
        
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDOTHours'];
        
        for (var j in colValues){
            var col = colValues[j];
            $scope.sumTotal[col] = 0;
            
            for(var i in $scope.newTimesheet){
                var totalCol = Object.keys($scope.newTimesheet[i]).length-1;
                
                if($scope.newTimesheet[i][col] === ''){
                    $scope.sumTotal[col] += 0;
                } else {                
                    $scope.sumTotal[col] += parseInt($scope.newTimesheet[i][col]);
                }
            }
        }        
        
        $scope.sumTotal.total = 0;
        for(var p in $scope.newTimesheet){
            var totalRow = parseInt($scope.newTimesheet[p].total);
            $scope.sumTotal.total += totalRow;
        }
    };
    
    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function(){
        $scope.newTimesheet.push({
            isSelected: false,
            Claims_id: '',
            AccountingPhaseCodes_id: '',
            StaffTypes_id: '',
            description: '',
            toll1: 'test',
            toll2: '',
            regularHours: '0',
            overtimeHours: '0',
            doubleOTHours: '0',
            statRegularHours: '0',
            statOTHours: '0',
            statDOTHours: '0',
            total: '0'
        });
        if($scope.laborerPositionID !== ''){
            $scope.newTimesheet[$scope.newTimesheet.length-1].StaffTypes_id = $scope.laborerPositionID;
        }
    };
    
    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function(){
        for (var i in $scope.newTimesheet){
            
            if($scope.newTimesheet[i].isSelected === true){
                $scope.newTimesheet.splice(parseInt(i)+1, 0,
                {
                    isSelected: false,
                    Claims_id: '',
                    AccountingPhaseCodes_id: '',
                    StaffTypes_id: '',
                    description: '',
                    toll1: 'test',
                    toll2: '',
                    regularHours: '0',
                    overtimeHours: '0',
                    doubleOTHours: '0',
                    statRegularHours: '0',
                    statOTHours: '0',
                    statDOTHours: '0',
                    total: '0'
                });                
                //console.log('Position ID = ' + $scope.laborerPositionID);
                if($scope.laborerPositionID !== ''){
                    $scope.newTimesheet[parseInt(i)+1].StaffTypes_id = $scope.laborerPositionID;
                }
            }
        }
    };
    
    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function(){
        console.log('--DELETE ROWS---');
        var timesheet = $scope.newTimesheet;
        var newArray = timesheet;
        
        for (var i = $scope.newTimesheet.length-1; i >= 0; i--){            
            //console.log('Timesheet ' + $scope.newTimesheet[i].Claims_id);
            if($scope.newTimesheet[i].isSelected === true){
                console.log('Timesheet ' + $scope.newTimesheet[i].Claims_id + ' is being deleted!');
                newArray.splice(parseInt(i), 1);                
            }            
        }
        
        $scope.updateTotalSum();
        $scope.newTimesheet = newArray;
    };
    
    
    //Select All
    $scope.selectAllToggle = function(value){
        if(value === true){
            for(var i in $scope.newTimesheet){
                $scope.newTimesheet[i].isSelected = true;
            }
        } else {
            for(var j in $scope.newTimesheet){
                $scope.newTimesheet[j].isSelected = false;
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
            $scope.newTimesheet[0].StaffTypes_id = positionID;
        }
    };
    
    //On Text Click
    $scope.checkEmpty = function (row, col) {
        if(row[col] === ''){
            row[col] = 0;
        }
    };
    
    //Remove Tolls
    $scope.removeTolls = function (object){
        var newObj = object;
        
        for (var i in newObj){
            delete newObj[i].toll1;
            delete newObj[i].toll2;
        }
        return newObj;
    };
    
    //Get Tolls
    $scope.getTolls = function (object){
        var newObj = [];
        
        for (var i in object){
            newObj.push({toll1: object[i].toll1, toll2: object[i].toll2});
            //newObj.push(object[i].toll2);
        }
        
        return newObj;
    };
    
    //Save timesheet
    $scope.saveTimesheet = function (object){
        console.log('Saving Timesheet...');
        console.log(object);
        
        var timesheet = {
            staffID: $scope.staffID,
            workDate: $filter('date')($scope.yesterday, 'yyyy-MM-dd')
        };        
       
        
        var tolls = $scope.getTolls(object);
        var timesheetItems = $scope.removeTolls(object);
        
        console.log('Timesheet:');
        console.log(timesheet);
        console.log('Timesheet Items:');
        console.log(timesheetItems);
        console.log('Tolls:');
        console.log(tolls);
        
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        timesheetSrv.saveTimesheet(timesheet, timesheetItems, tolls, formToken);
    
    };
});