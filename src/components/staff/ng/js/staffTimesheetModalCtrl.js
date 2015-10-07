module.controller('staffTimesheetModalCtrl', function($modalInstance, $scope, staffTimesheetSrv, $filter) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    
    //Modal Controls
    $scope.confirm = function() {
        $modalInstance.close();
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };

    //Get the dates and Timepicker info
    var date = new Date();
    $scope.today = date;

    //Timepicker
    $scope.mstep = 15;
    $scope.hstep = 1;
    $scope.timeFrom = date.setHours(0,0,0,0);
    $scope.timeTo = date.setHours(0,0,0,0);

    //Laborer Autocomplete
    function fetchAutocomplete() {
        if($scope.laborer.search(' ') === -1){
            staffTimesheetSrv.autocomplete($scope.laborer)
                .then(function() {
                $scope.autocomplete = staffTimesheetSrv.autocompleteList;
            });
        }
    }

    $scope.$watch('laborer', function() {
        if ($scope.laborer) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });

    //Laborer Typeahead
    $scope.fetchLaborerAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return staffListSrv.fetchAutocomplete(searchObject);
    };

    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            staffListSrv.search(copiedObject).then(function() {
                $scope.staffList = staffListSrv.searchResults;
                $scope.totalItems = staffListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getStaffList();
    };

    $scope.hourlyRate = 0;
    //get staff id and hourly rate
    $scope.getStaffInfo = function(name){
        if(name !== undefined){
            var splitName = name.split(' ');
            for(var i in $scope.autocomplete){
                if(splitName[0] === $scope.autocomplete[i].firstname && splitName[1] === $scope.autocomplete[i].lastname){
                    $scope.staffID = $scope.autocomplete[i].id;
                    $scope.hourlyRate = parseFloat($scope.autocomplete[i].salary);
                    timesheetTemplate.hourlyRate = $scope.hourlyRate;
                }
            }
            //Update the existing timesheet items with the rate
            for(var j in $scope.timesheetItems){
                $scope.timesheetItems[j].hourlyRate = parseFloat($scope.hourlyRate * $scope.timesheetItems[j].rateVariance);
            }
        }
    };

    //Checks to see if a timesheet already exists
    $scope.findExistingTimesheet = function(name, workDate){
        if(name && workDate && name !== $scope.prevName && workDate !== $scope.prevDate){
            $scope.findExisting = true;
            $scope.loading = true;
            var date = $filter('date')(workDate, 'yyyy-MM-dd');
            staffTimesheetSrv.searchTimesheets(name, date)
                .then(function(){
                if(staffTimesheetSrv.timesheetSearchCount === '1'){
                    var timesheet = staffTimesheetSrv.timesheetSearchResults;
                    $scope.loadTimesheetItems(timesheet);
                    //$scope.findExisting = false;
                    $scope.hourlyRate = parseFloat(timesheet.hourlyRate);
                    timesheetTemplate.hourlyRate = $scope.hourlyRate;
                }else{
                    $scope.loadTimesheetItems('');
                    $scope.findExisting = false;
                }
            });
        }
        $scope.prevName = name;
        $scope.prevDate = workDate;
    };

    //Fetch claims
    function getClaims(search, row) {
        staffTimesheetSrv.claimsAutocomplete(search)
            .then(function() {
            if(staffTimesheetSrv.claimsCount > 0){
                $scope.claimsAutocomplete = staffTimesheetSrv.claimsList;
                if(staffTimesheetSrv.claimsCount === 1){
                    row.Claims_id = $scope.claimsAutocomplete[0].id;
                }
            }
        });
    }

    //Clear the Claims list
    $scope.clearClaimsList = function(row){
        for(var i in $scope.claimsAutocomplete){
            if($scope.claimsAutocomplete[i].jobNumber === row.jobNumber){
                row.Claims_id = $scope.claimsAutocomplete[i].id;
                row.address = $scope.claimsAutocomplete[i].address1;
                row.city = $scope.claimsAutocomplete[i].city;
            }
        }
        //$scope.claimsAutocomplete = {};
    };

    $scope.watchClaims = function(row){
        getClaims(row.jobNumber, row);
    };

    //Rate Variance (phase)
    $scope.getRateVarianceOptions = function(event){
        $scope.rateVarianceList = $(event.target).find('option');
    };

    $scope.getRateVariance = function(row, phaseID){
        for (var i = 0; i < $scope.rateVarianceList.length; i++){
            if($scope.rateVarianceList[i].attributes.value.nodeValue === phaseID){
                row.rateVariance = $scope.rateVarianceList[i].attributes['data-ratevariance'].nodeValue;
                row.hourlyRate = parseFloat($scope.hourlyRate * row.rateVariance);
            }
        }
    };


    $scope.timesheetSelected = false;

    //watch the timesheetItems for updates
    $scope.$watch('timesheetItems', function() {
        for(var i in $scope.timesheetItems){
            if($scope.timesheetItems[i].isSelected === true){
                $scope.timesheetSelected = true;
                return;
            } else {
                $scope.timesheetSelected = false;
            }
        }
    }, true);
    
    $scope.timesheet = {
        Timesheet_id: '',
        workDate: '',
        Vehicles_id: '',
        totalHours: '0'
    };
    //Timesheet template
    var timesheetTemplate = {
        isSelected: false,
        Claims_id: '',
        jobNumber: '',
        AccountingPhaseCodes_id: '',
        address: '',
        city: '',
        toll1: '',
        toll2: '',
        timeFrom: $scope.timeFrom,
        timeTo: $scope.timeTo,
        regularHours: 0,
        overtimeHours: 0,
        doubleOTHours: 0,
        totalHours: 0
    };
    $scope.timesheetItems = [];

    //Check to see if a timesheet ID exists
    $scope.loadTimesheetItems = function(){
        $scope.loading = true;
        $scope.loading = false;
        $scope.timesheetItems = angular.copy([timesheetTemplate]);
        $scope.timesheetDate = $scope.today;
    };

    $scope.loadTimesheetItems();

    //Summing up the row and column totals
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
            if(isNaN(rowHours[i])){
                rowHours[i] = 0;
            }
        }
        row.totalHours = rowHours.regularHours + rowHours.overtimeHours + rowHours.doubleOTHours + rowHours.statRegularHours + rowHours.statOTHours + rowHours.statDoubleOTHours;
        $scope.updateTotalSum();
    };

    $scope.updateTotalSum = function(){
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDoubleOTHours'];
        for (var j in colValues){
            var col = colValues[j];
            $scope.sumTotal[col] = 0;
            for(var i in $scope.timesheetItems){
                var totalCol = Object.keys($scope.timesheetItems[i]).length-1;
                if($scope.timesheetItems[i][col] === null || isNaN($scope.timesheetItems[i][col])){
                    $scope.sumTotal[col] += 0;
                } else {
                    $scope.sumTotal[col] += parseFloat($scope.timesheetItems[i][col]);
                }
            }
        }

        $scope.sumTotal.totalHours = 0;
        for(var p in $scope.timesheetItems){
            var totalRow = parseFloat($scope.timesheetItems[p].totalHours);
            $scope.sumTotal.totalHours += totalRow;
        }
        $scope.timesheet.totalHours = $scope.sumTotal.totalHours;
    };

    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function(){
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        $scope.timesheetItems.push(angular.copy(timesheetTemplate));
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
        var timesheet = $scope.timesheetItems;
        var newArray = timesheet;
        for (var i = $scope.timesheetItems.length-1; i >= 0; i--){
            if($scope.timesheetItems[i].isSelected === true){
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
    $scope.getVehicleTolls = function(vehicleID, timesheetItems){
        staffTimesheetSrv.getTolls(vehicleID)
            .then(function(){
            $scope.tolls = staffTimesheetSrv.vehicleTolls;
            if(timesheetItems){
                for(var i in timesheetItems){
                    if(i > 0){
                        $scope.selectToll1.push([]);
                        $scope.selectToll2.push([]);
                    }
                    for(var j in $scope.tolls){
                        if(timesheetItems[i].toll1 === $scope.tolls[j].cost){
                            $scope.timesheetItems[i].toll1 = $scope.tolls[j].cost;
                            $scope.selectToll1[i][j] = true;
                        }
                        if(timesheetItems[i].toll2 === $scope.tolls[j].cost){
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

    $scope.getHours = function (object){
        var newObj = angular.copy(object);
        for(var i in object){
            newObj[i].timeFrom = $filter('date')(newObj[i].timeFrom, 'HH-mm');
            newObj[i].timeTo = $filter('date')(newObj[i].timeTo, 'HH-mm');
        }
        return newObj;
    };

    //Save timesheet
    $scope.saveTimesheet = function (){
        var date = $filter('date')($scope.timesheetDate, 'yyyy-MM-dd');        
        $scope.timesheet.workDate = date;
        var timesheetItems = $scope.getHours($scope.timesheetItems);
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        staffTimesheetSrv.saveTimesheet($scope.timesheet, timesheetItems, formToken);
    };

    //Clear timesheet
    $scope.clearTimesheet = function (){
        $scope.timesheet.Vehicles_id = '';
        $scope.timesheetItems = angular.copy([timesheetTemplate]);
    };
});
