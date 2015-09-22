module.controller('timesheetModalCtrl', function($modalInstance, $scope, timesheetSrv, $filter, timesheet) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    //console.log(timesheet);
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close();
        //$modalInstance.close($scope.staff);
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
        if($scope.laborer.search(' ') === -1){
            //console.log('performing autocomplete...');
            timesheetSrv.autocomplete($scope.laborer)
                .then(function() {
                $scope.autocomplete = timesheetSrv.autocompleteList;
                //console.log('autocomplete List:');
                //console.log(timesheetSrv.autocompleteList);

            });
        }
    }

    $scope.$watch('laborer', function() {
        if ($scope.laborer) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });
    
    $scope.hourlyRate = 0;
    //get staff id and rate
    $scope.getStaffInfo = function(name){
        console.log('getting staff ID');
        console.log( $scope.autocomplete);
        if(name !== undefined){       
            var splitName = name.split(' ');
            console.log(splitName);
            for(var i in $scope.autocomplete){
                if(splitName[0] === $scope.autocomplete[i].firstname && splitName[1] === $scope.autocomplete[i].lastname){
                    //console.log(name + ' id = ' + $scope.autocomplete[i].id);
                    $scope.staffID = $scope.autocomplete[i].id;
                    $scope.hourlyRate = parseFloat($scope.autocomplete[i].salary);
                }
            }
            //Update the existing timesheet items with the rate            
            for(var j in $scope.timesheetItems){
                $scope.timesheetItems[j].hourlyRate = parseFloat($scope.hourlyRate * $scope.timesheetItems[j].rateVariance);
            }
        }
    };
    
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
                        $scope.hourlyRate = parseFloat($scope.staffList[0].HourlyRate);
                        $scope.laborerName = $scope.staffList[0].lastname + ', ' + $scope.staffList[0].firstname;
                    }
                }
            });
        }
    };

    //Claims Autocomplete
    //Fetch claims
    function fetchClaims(search, row) {
        console.log('fetching claims...');
        timesheetSrv.claimsAutocomplete(search)
            .then(function() {
            if(timesheetSrv.claimsCount > 0){
                console.log('found ' + timesheetSrv.claimsCount  + ' matching claims');
                $scope.claimsAutocomplete = timesheetSrv.claimsList;
                if(timesheetSrv.claimsCount === 1){
                    console.log('found matching claim id!!!');
                    row.Claims_id = $scope.claimsAutocomplete[0].id;
                }
            } else {
                console.log('no matching claims found!');
            }
        });
    }

    //Clear the Claims list
    $scope.clearClaimsList = function(row){
        for(var i in $scope.claimsAutocomplete){
            if($scope.claimsAutocomplete[i].label === row.jobNumber){
                console.log('found matching claim id!');
                row.Claims_id = $scope.claimsAutocomplete[i].id;
            }
        }


        $scope.claimsAutocomplete = {};
    };

    $scope.watchClaims = function(row){
        fetchClaims(row.jobNumber, row);
    };
    
    
    //Rate Variance (phase)
    $scope.getRateVarianceOptions = function(event){
        $scope.rateVarianceList = $(event.target).find('option');
    };
    
    $scope.getRateVariance = function(row, phaseID){
        for (var i = 0; i < $scope.rateVarianceList.length; i++){ 
            if($scope.rateVarianceList[i].attributes.value.nodeValue === phaseID){
                console.log('rate variance = ' + $scope.rateVarianceList[i].attributes['data-ratevariance'].nodeValue);
                row.rateVariance = $scope.rateVarianceList[i].attributes['data-ratevariance'].nodeValue;
                row.hourlyRate = parseFloat($scope.hourlyRate * row.rateVariance);
            }
        }
    };


    $scope.timesheetSelected = false;

    //watch the timesheetItems for updates
    $scope.$watch('timesheetItems', function() {
        //console.log('Time sheet updated!');
        for(var i in $scope.timesheetItems){
            if($scope.timesheetItems[i].isSelected === true){
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
        hourlyRate: $scope.hourlyRate,
        rateVariance:'1',
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
    };
    $scope.timesheetItems = [];
    
    $scope.loading = true;
    
    //Check to see if a timesheet ID exists
    if(timesheet.id){
        console.log(timesheet);
        $scope.timesheetID = timesheet.id;
        $scope.staffID = timesheet.Staff_id;
        $scope.laborer = timesheet.firstname + ' ' + timesheet.lastname;
        $scope.hourlyRate = timesheet.hourlyRate;
        var workDate = Date.parse((timesheet.workDate.replace(/-/g,"/")));
        $scope.timesheetDate = new Date(workDate);
        timesheetSrv.getTimesheet(timesheet.id)
        .then(function(){
            console.log('done getting timesheet items!');
            console.log(timesheetSrv.timesheetItems);
            
            //if timesheet items exists, populate the timesheet
            if(timesheetSrv.timesheetItems){
                $scope.timesheetItems = timesheetSrv.timesheetItems;
                
                //Get the vehicle IDs and tolls   
                $scope.vehicleID = timesheet.Vehicles_id;
                $scope.getVehicleTolls($scope.vehicleID, $scope.timesheetItems);
                $scope.updateTotalSum();
                //console.log($scope.timesheet);
                $scope.loading = false;
            }
        });
    } else {       
        $scope.loading = false;
        //New Timesheet
        $scope.timesheetID = null;
        //$scope.timesheet = [timesheetTemplate];
        $scope.timesheetItems = [angular.extend({}, timesheetTemplate)];
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
        statDoubleOTHours: 0,
        totalHours: 0
    };

    //Update the hour totals
    $scope.updateTotal = function(row, col){
        //console.log('update total:');
        //console.log(col);
        //console.log(row[col]);
        //console.log(row.regularHours);
        
        row.totalHours = 0;
        
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDoubleOTHours'];
        
        var rowHours = {
            regularHours: parseFloat(row.regularHours),
            overtimeHours: parseFloat(row.overtimeHours),
            doubleOTHours: parseFloat(row.doubleOTHours),
            statRegularHours: parseFloat(row.statRegularHours),
            statOTHours: parseFloat(row.statOTHours),
            statDoubleOTHours: parseFloat(row.statDoubleOTHours)
        };
        
        //Check for null/NaN values and replace them with 0
        for(var i in rowHours){
            //console.log(rowHours[i]);
            if(isNaN(rowHours[i])){
                rowHours[i] = 0;
            }
        }
        //console.log(rowHours);
        
        row.totalHours = rowHours.regularHours + rowHours.overtimeHours + rowHours.doubleOTHours + rowHours.statRegularHours + rowHours.statOTHours + rowHours.statDoubleOTHours;

        $scope.updateTotalSum();
        //console.log('ROW TOLLS = ' + row.toll1 + ' ' + row.toll2);
    };

    $scope.updateTotalSum = function(){

        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDoubleOTHours'];

        for (var j in colValues){
            var col = colValues[j];
            $scope.sumTotal[col] = 0;

            for(var i in $scope.timesheetItems){
                var totalCol = Object.keys($scope.timesheetItems[i]).length-1;

                if($scope.timesheetItems[i][col] === null || isNaN($scope.timesheetItems[i][col])){
                    //console.log('empty number');
                    //console.log($scope.timesheetItems[i][col]);

                    $scope.sumTotal[col] += 0;
                } else {
                    $scope.sumTotal[col] += parseFloat($scope.timesheetItems[i][col]);
                }
            }
        }

        $scope.sumTotal.totalHours = 0;
        for(var p in $scope.timesheetItems){
            var totalRow = parseInt($scope.timesheetItems[p].totalHours);
            $scope.sumTotal.totalHours += totalRow;
        }
    };

    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function(){
        console.log($scope.hourlyRate);
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        //console.log(timesheetTemplate);
        $scope.timesheetItems.push(angular.extend({}, timesheetTemplate));
        if($scope.laborerPositionID !== ''){
            $scope.timesheetItems[$scope.timesheetItems.length-1].StaffTypes_id = $scope.laborerPositionID;
        }
    };

    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function(){
        timesheetTemplate.hourlyRate = $scope.hourlyRate;

        for (var i in $scope.timesheetItems){
            if($scope.timesheetItems[i].isSelected === true){
                $scope.timesheetItems.splice(parseInt(i)+1, 0, angular.extend({}, timesheetTemplate));
                if($scope.laborerPositionID !== ''){
                    $scope.timesheetItems[parseInt(i)+1].StaffTypes_id = $scope.laborerPositionID;
                }
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function(){
        console.log('--DELETE ROWS---');
        var timesheet = $scope.timesheetItems;
        var newArray = timesheet;

        for (var i = $scope.timesheetItems.length-1; i >= 0; i--){
            //console.log('Timesheet ' + $scope.timesheetItems[i].Claims_id);
            if($scope.timesheetItems[i].isSelected === true){
                console.log('Timesheet ' + $scope.timesheetItems[i].Claims_id + ' is being deleted!');
                newArray.splice(parseInt(i), 1);
            }
        }

        $scope.updateTotalSum();
        $scope.timesheetItems = newArray;
    };

    //Select All
    $scope.selectAllToggle = function(value){
        if(value === true){
            for(var i in $scope.timesheetItems){
                $scope.timesheetItems[i].isSelected = true;
            }
        } else {
            for(var j in $scope.timesheetItems){
                $scope.timesheetItems[j].isSelected = false;
            }
        }
    };

    $scope.selectToll1 = [[]];
    $scope.selectToll2 = [[]];
    
    //Get vehicle ID tolls
    //$scope.vehicleNumber = '';
    $scope.getVehicleTolls = function(vehicleID, timesheetItems){
        console.log('getting tolls for ' + vehicleID);
        timesheetSrv.getTolls(vehicleID)
        .then(function(){
            console.log('done getting tolls');
            $scope.tolls = timesheetSrv.vehicleTolls;
            console.log($scope.tolls);
            
            if(timesheetItems){
                for(var i in timesheetItems){
                    if(i > 0){
                        $scope.selectToll1.push([]);
                        $scope.selectToll2.push([]);
                    }
                                    
                    for(var j in $scope.tolls){
                        console.log('toll: ' + $scope.tolls[j].cost);
                        
                        if(timesheetItems[i].toll1 === $scope.tolls[j].cost){
                            console.log('matching toll1!');
                            $scope.timesheetItems[i].toll1 = $scope.tolls[j].cost;
                            $scope.selectToll1[i][j] = true;
                        }
                        
                        if(timesheetItems[i].toll2 === $scope.tolls[j].cost){
                            console.log('matching toll2!');
                            $scope.timesheetItems[i].toll2 = $scope.tolls[j].cost;
                            $scope.selectToll2[i][j] = true;
                        }
                    }
                }
            }
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
        if($scope.timesheetItems.length == 1){
            $scope.timesheetItems[0].StaffTypes_id = positionID;
        }
    };

    //Check if an hour value is empty, replace it with 0
    $scope.checkEmpty = function (row, col) {
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
            newObj[i].Timesheet_id = $scope.timesheetID;
        }
        return newObj;
    };

    //Get Tolls
    $scope.getTolls = function (object, date){
        console.log(object);
        var newObj = [];

        for (var i in object){
            //newObj.push({toll1: object[i].toll1, toll2: object[i].toll2});
            //newObj.push(object[i].toll2);
            newObj = [];
            newObj.push({Claims_id: object[i].Claims_id,
                         workDate: date,
                         cost: object[i].toll1
                        });

            newObj.push({Claims_id: object[i].Claims_id,
                         workDate: date,
                         cost: object[i].toll2
                        });
            object[i].tolls = newObj;
        }

        return newObj;
    };

    //Save timesheet
    $scope.saveTimesheet = function (object){
        console.log('Saving Timesheet...');
        console.log(object);
        var date = $filter('date')($scope.timesheetDate, 'yyyy-MM-dd');

        var timesheet = {
            Timesheet_id: $scope.timesheetID,
            staffID: $scope.staffID,
            workDate: date,
            Vehicles_id: $scope.vehicleID,
            hourlyRate: $scope.hourlyRate,
            totalHours: $scope.sumTotal.totalHours
        };

        
        var tolls = $scope.getTolls(object, date);
        var timesheetItems = $scope.removeTolls(object);

        console.log('Timesheet:');
        console.log(timesheet);
        console.log('Timesheet Items:');
        console.log(timesheetItems);
//        console.log('Tolls:');
//        console.log(tolls);

        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        timesheetSrv.saveTimesheet(timesheet, timesheetItems, formToken);
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
