module.controller('timesheetModalCtrl', function($modalInstance, $scope, timesheetSrv, $filter, timesheet) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    //console.log(timesheet);
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close($scope.staff);
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };

    //Get the dates
    $scope.getDates = function(){
        var date = new Date();
        //date.setDate(date.getDate() - 1);
        $scope.yesterday = date;
    };

    //Call getDates
    $scope.getDates();

    //Laborer Autocomplete
    function fetchAutocomplete() {
        timesheetSrv.autocomplete($scope.laborer)
            .then(function() {
            $scope.autocomplete = timesheetSrv.autocompleteList;
            console.log('autocomplete List:');
            console.log(timesheetSrv.autocompleteList);
        });
    }

    $scope.$watch('laborer', function() {
        if ($scope.laborer) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });

    //Search
    $scope.search = function() {
        var searchObject = $scope.laborer;
        //console.log(searchObject);
        if (searchObject) {
            timesheetSrv.filterListBy(0, 20, searchObject)
                .then(function() {
                if (timesheetSrv.searchResults) {
                    //console.log('got search results');
                    $scope.staffList = timesheetSrv.searchResults;
                    $scope.totalItems = timesheetSrv.searchResultsCount;
                    if($scope.totalItems === 1){
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
    $scope.clearClaimsList = function(row){
        for(var i in $scope.claimsAutocomplete){
            if($scope.claimsAutocomplete[i].label === row.jobNumber){
                console.log('matching id!');
                //var claimID =
                row.Claims_id = $scope.claimsAutocomplete[i].id;
            }
        }


        $scope.claimsAutocomplete = {};
    };

    $scope.watchClaims = function(row){
        console.log(row);
       // $scope.timesheet[row].Claims_id;
        fetchClaims(row.jobNumber);
    };


    $scope.timesheetSelected = false;

    //watch the timesheet for updates
    $scope.$watch('newTimesheet', function() {
        console.log('Time sheet updated!');
        for(var i in $scope.timesheet){
            if($scope.timesheet[i].isSelected === true){
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
        jobNumber: '',
        AccountingPhaseCodes_id: '',
        StaffTypes_id: '',
        description: '',
        toll1: 'test',
        toll2: '',
        regularHours: 0,
        overtimeHours: 0,
        doubleOTHours: 0,
        statRegularHours: 0,
        statOTHours: 0,
        statDOTHours: 0,
        total: 0
    };
    $scope.timesheet = [];
    
    $scope.loading = true;
    //Check to see if a timesheet ID exists
    if(timesheet.id){
        console.log(timesheet);
        $scope.laborer = timesheet.firstname + ' ' + timesheet.lastname;
        
        var workDate = Date.parse((timesheet.workDate.replace(/-/g,"/")));
        
        //console.log(workDate);
        $scope.timesheetDate = new Date(workDate);
        //console.log($scope.timesheetDate);
        timesheetSrv.getTimesheetItems(timesheet.id, 0, 20)
        .then(function(){
            console.log('done getting timesheet items!');
            //console.log(timesheetSrv.timesheetItems);
            
            //if one exists, populate the timesheet with the timesheetitems
            if(timesheetSrv.timesheetItems){
                //console.log('timesheet items exist!');
                //console.log(timesheetSrv.timesheetItems);
                $scope.timesheetItems = timesheetSrv.timesheetItems;
                //$scope.timesheet = timesheetSrv.timesheetItems;
                for (var i in $scope.timesheetItems){
                    $scope.timesheet.push({});
                    console.log('timesheet item ' + i);
                    //console.log($scope.timesheetItems[i].regularHours);
                    $scope.timesheet[i].jobNumber = $scope.timesheetItems[i].jobNumber;
                    $scope.timesheet[i].description = $scope.timesheetItems[i].description;
                    $scope.timesheet[i].StaffTypes_id = $scope.timesheetItems[i].StaffTypes_id;
                    
                    $scope.timesheet[i].AccountingPhaseCodes_id = $scope.timesheetItems[i].AccountingPhaseCodes_id;
                    $scope.timesheet[i].regularHours = parseFloat($scope.timesheetItems[i].regularHours);
                    $scope.timesheet[i].overtimeHours = parseFloat($scope.timesheetItems[i].overtimeHours);
                    $scope.timesheet[i].doubleOTHours = parseFloat($scope.timesheetItems[i].doubleOTHours);
                    $scope.timesheet[i].statRegularHours = parseFloat($scope.timesheetItems[i].statRegularHours);
                    $scope.timesheet[i].statOTHours = parseFloat($scope.timesheetItems[i].statOTHours);
                    $scope.timesheet[i].statDOTHours = parseFloat($scope.timesheetItems[i].statDOTHours);
                    $scope.timesheet[i].total = parseFloat($scope.timesheetItems[i].totalHours);
                    
                }
                $scope.updateTotalSum();
                console.log($scope.timesheet);
                $scope.loading = false;
            }
        });
    } else {       
        $scope.loading = false;
        //New Timesheet
        $scope.timesheet = [timesheetTemplate];
        $scope.timesheetDate = $scope.yesterday;
    }
    //console.log($scope.timesheet);

    $scope.sumTotal = {
        regularHours: 0,
        overtimeHours: 0,
        doubleOTHours: 0,
        statRegularHours: 0,
        statOTHours: 0,
        statDOTHours: 0,
        total: 0
    };

    //Update the hour totals
    $scope.updateTotal = function(row, col){
        //console.log('update total:');
        //console.log(col);
        //console.log(row[col]);
        //console.log(row.regularHours);
        
        row.total = 0;
        
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDOTHours'];
        
        var rowHours = {
            regularHours: parseFloat(row.regularHours),
            overtimeHours: parseFloat(row.overtimeHours),
            doubleOTHours: parseFloat(row.doubleOTHours),
            statRegularHours: parseFloat(row.statRegularHours),
            statOTHours: parseFloat(row.statOTHours),
            statDOTHours: parseFloat(row.statDOTHours)
        };
        
        //Check for null/NaN values and replace them with 0
        for(var i in rowHours){
            console.log(rowHours[i]);
            if(isNaN(rowHours[i])){
                rowHours[i] = 0;
            }
        }
        //console.log(rowHours);
        
        row.total = rowHours.regularHours + rowHours.overtimeHours + rowHours.doubleOTHours + rowHours.statRegularHours + rowHours.statOTHours + rowHours.statDOTHours;

        $scope.updateTotalSum();
        //console.log('ROW TOLLS = ' + row.toll1 + ' ' + row.toll2);
    };

    $scope.updateTotalSum = function(){

        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDOTHours'];

        for (var j in colValues){
            var col = colValues[j];
            $scope.sumTotal[col] = 0;

            for(var i in $scope.timesheet){
                var totalCol = Object.keys($scope.timesheet[i]).length-1;

                if($scope.timesheet[i][col] === null || isNaN($scope.timesheet[i][col])){
                    console.log('empty number');
                    console.log($scope.timesheet[i][col]);

                    $scope.sumTotal[col] += 0;
                } else {
                    $scope.sumTotal[col] += parseFloat($scope.timesheet[i][col]);
                }
            }
        }

        $scope.sumTotal.total = 0;
        for(var p in $scope.timesheet){
            var totalRow = parseInt($scope.timesheet[p].total);
            $scope.sumTotal.total += totalRow;
        }
    };

    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function(){
        $scope.timesheet.push({
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
            statDOTHours: 0,
            total: 0
        });
        if($scope.laborerPositionID !== ''){
            $scope.timesheet[$scope.timesheet.length-1].StaffTypes_id = $scope.laborerPositionID;
        }
    };

    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function(){
        for (var i in $scope.timesheet){

            if($scope.timesheet[i].isSelected === true){
                $scope.timesheet.splice(parseInt(i)+1, 0,
                {
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
                    statDOTHours: 0,
                    total: 0
                });
                //console.log('Position ID = ' + $scope.laborerPositionID);
                if($scope.laborerPositionID !== ''){
                    $scope.timesheet[parseInt(i)+1].StaffTypes_id = $scope.laborerPositionID;
                }
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function(){
        console.log('--DELETE ROWS---');
        var timesheet = $scope.timesheet;
        var newArray = timesheet;

        for (var i = $scope.timesheet.length-1; i >= 0; i--){
            //console.log('Timesheet ' + $scope.timesheet[i].Claims_id);
            if($scope.timesheet[i].isSelected === true){
                console.log('Timesheet ' + $scope.timesheet[i].Claims_id + ' is being deleted!');
                newArray.splice(parseInt(i), 1);
            }
        }

        $scope.updateTotalSum();
        $scope.timesheet = newArray;
    };


    //Select All
    $scope.selectAllToggle = function(value){
        if(value === true){
            for(var i in $scope.timesheet){
                $scope.timesheet[i].isSelected = true;
            }
        } else {
            for(var j in $scope.timesheet){
                $scope.timesheet[j].isSelected = false;
            }
        }
    };

    //Get vehicle ID tolls
    $scope.vehicleNumber = '';
    $scope.getVehicleTolls = function(vehicleID){
        console.log('getting tolls for ' + vehicleID);
        timesheetSrv.getTolls(vehicleID)
        .then(function(){
            console.log('done getting tolls');
            $scope.tolls = timesheetSrv.vehicleTolls;
            console.log($scope.tolls);
        });
    };


    //check the selected rows
    $scope.checkSelected = function(value){
        if(value === false){
            $scope.selectAll = false;
        }
    };

    $scope.setCategory = function(positionID){
        console.log('position ID = ' + positionID);
        if($scope.timesheet.length == 1){
            $scope.timesheet[0].StaffTypes_id = positionID;
        }
    };

    //On Text Click
    $scope.checkEmpty = function (row, col) {
        //console.log('checking empty');
        //console.log(row[col]);
        if(row[col] === null || isNaN(row[col])){
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
    $scope.getTolls = function (object, date){
        var newObj = [];

        for (var i in object){
            //newObj.push({toll1: object[i].toll1, toll2: object[i].toll2});
            //newObj.push(object[i].toll2);

            newObj.push({Claims_id: object[i].Claims_id,
                         workDate: date,
                         cost: object[i].toll1
                        });

            newObj.push({Claims_id: object[i].Claims_id,
                         workDate: date,
                         cost: object[i].toll2
                        });

        }

        return newObj;
    };

    //Save timesheet
    $scope.saveTimesheet = function (object){
        console.log('Saving Timesheet...');
        console.log(object);
        var date = $filter('date')($scope.timesheetDate, 'yyyy-MM-dd');

        var timesheet = {
            staffID: $scope.staffID,
            workDate: date,
            //Vehicle_id: 
        };


        var tolls = $scope.getTolls(object, date);
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
