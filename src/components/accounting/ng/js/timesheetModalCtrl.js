module.controller('timesheetModalCtrl', function ($modalInstance, $scope, timesheetSrv, $filter, timesheet) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    $scope.autocomplete.loading = false;
    $scope.hourlyRate = 0;
    $scope.timesheetItems = [];
    $scope.timesheetSelected = false;
    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close($scope.timesheet);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    //Get the dates
    $scope.getDates = function () {
        var date = new Date();
        $scope.yesterday = date;
    };

    //Call getDates
    $scope.getDates();

//    //Laborer Autocomplete
//    function fetchAutocomplete() {
//        if ($scope.laborer.search(' ') === -1) {
//            timesheetSrv.staffAutocomplete($scope.laborer)
//                    .then(function () {
//                        $scope.autocomplete = timesheetSrv.autocompleteList;
//                    });
//        }
//    }

//    $scope.$watch('laborer', function () {
//        //$scope.autocomplete = {};
//        if ($scope.laborer) {
//            $scope.autocomplete.loading = true;
//            fetchAutocomplete();
//        }
//    });

//    //Laborer Typeahead
//    $scope.fetchLaborerAutocomplete = function (viewVal) {
//        var searchObject = {};
//        searchObject.name = viewVal;
//        return staffListSrv.fetchAutocomplete(searchObject);
//    };

    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            staffListSrv.search(copiedObject).then(function () {
                $scope.staffList = staffListSrv.searchResults;
                $scope.totalItems = staffListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getStaffList();
    };

    //get staff id and hourly rate
    $scope.getLaborerInfo = function (laborer) {
        $scope.staffID = laborer.id;
        $scope.hourlyRate = parseFloat(laborer.salary);
        timesheetTemplate.hourlyRate = laborer.hourlyRate;
        for (var j in $scope.timesheetItems) {
            $scope.timesheetItems[j].hourlyRate = parseFloat($scope.hourlyRate * $scope.timesheetItems[j].rateVariance);
        }
//        if (name !== undefined) {
//            var splitName = name.split(' ');
//            for (var i in $scope.autocomplete) {
//                if (splitName[0] === $scope.autocomplete[i].firstname && splitName[1] === $scope.autocomplete[i].lastname) {
//                    $scope.staffID = $scope.autocomplete[i].id;
//                    $scope.hourlyRate = parseFloat($scope.autocomplete[i].salary);
//                    timesheetTemplate.hourlyRate = $scope.hourlyRate;
//                }
//            }
//            //Update the existing timesheet items with the rate            
//            for (var j in $scope.timesheetItems) {
//                $scope.timesheetItems[j].hourlyRate = parseFloat($scope.hourlyRate * $scope.timesheetItems[j].rateVariance);
//            }
//        }
    };

    //Checks to see if a timesheet already exists
    $scope.findExistingTimesheet = function (name, workDate) {
        var date = $filter('date')(workDate, 'yyyy-MM-dd');
        if (name && workDate) {
            if (name !== $scope.prevName || date !== $scope.prevDate) {
                $scope.findExisting = true;
                $scope.loading = true;
                timesheetSrv.searchTimesheets(name.firstname + ' ' + name.lastname, date)
                        .then(function () {
                            if (timesheetSrv.timesheetSearchResults) {
                                var timesheet = timesheetSrv.timesheetSearchResults;
                                $scope.loadTimesheetItems(timesheet);
                                $scope.hourlyRate = parseFloat(timesheet.hourlyRate);
                                timesheetTemplate.hourlyRate = $scope.hourlyRate;
                            } else {
                                $scope.loadTimesheetItems('');
                                $scope.findExisting = false;
                            }
                        });
            }
        }
        $scope.prevName = name;
        $scope.prevDate = date;
    };

    //Claims Autocomplete
    //Fetch claims
    function fetchClaims(search, row) {
        timesheetSrv.claimsAutocomplete(search)
                .then(function () {
                    if (timesheetSrv.claimsCount > 0) {
                        $scope.claimsAutocomplete = timesheetSrv.claimsList;
                        if (timesheetSrv.claimsCount === 1) {
                            row.Claims_id = $scope.claimsAutocomplete[0].id;
                        }
                    }
                });
    }

    //Clear the Claims list
    $scope.clearClaimsList = function (row) {
        for (var i in $scope.claimsAutocomplete) {
            if ($scope.claimsAutocomplete[i].label === row.jobNumber) {
                row.Claims_id = $scope.claimsAutocomplete[i].id;
            }
        }
        $scope.claimsAutocomplete = {};
    };

    $scope.watchClaims = function (row) {
        fetchClaims(row.jobNumber, row);
    };
    
    //Claims Typeahead
    $scope.fetchClaimsAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return timesheetSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    $scope.getClaimsID = function(row, claim){
        row.Claims_id = claim.id;
        row.jobNumber = claim.jobNumber;
    };
    
    //Claims Typeahead
    $scope.fetchLaborerAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return timesheetSrv.fetchLaborerAutocomplete(searchObject);
    };

    //Rate Variance (phase)
    $scope.getRateVarianceOptions = function (event) {
        $scope.rateVarianceList = $(event.target).find('option');
    };

    $scope.getRateVariance = function (row, phaseID) {
        for (var i = 0; i < $scope.rateVarianceList.length; i++) {
            if ($scope.rateVarianceList[i].attributes.value.nodeValue === phaseID) {

                row.rateVariance = $scope.rateVarianceList[i].attributes['data-ratevariance'].nodeValue;
                row.ClaimPhases_id = $scope.rateVarianceList[i].attributes['data-claimphase_id'].nodeValue;

                row.hourlyRate = parseFloat($scope.hourlyRate * row.rateVariance);
            }
        }
    };

    //watch the timesheetItems for updates
    $scope.$watch('timesheetItems', function () {
        for (var i in $scope.timesheetItems) {
            if ($scope.timesheetItems[i].isSelected === true) {
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
        rateVariance: '1',
        ClaimPhases_id: '',
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

    //Check to see if a timesheet ID exists
    $scope.loadTimesheetItems = function (timesheet) {
        $scope.loading = true;
        if (timesheet.id) {
            $scope.timesheetID = timesheet.id;
            $scope.staffID = timesheet.Staff_id;
            $scope.laborer = timesheet.firstname + ' ' + timesheet.lastname;
            $scope.hourlyRate = timesheet.hourlyRate;
            var workDate = Date.parse((timesheet.workDate.replace(/-/g, "/")));
            $scope.timesheetDate = new Date(workDate);
            timesheetSrv.getTimesheet(timesheet.id)
                    .then(function () {
                        //if timesheet items exists, populate the timesheet
                        if (timesheetSrv.timesheetItems) {
                            $scope.timesheetItems = timesheetSrv.timesheetItems;
                            //Get the vehicle IDs and tolls   
                            $scope.vehicleID = timesheet.Vehicles_id;
                            $scope.getVehicleTolls($scope.vehicleID, $scope.timesheetItems);
                            $scope.updateTotalSum();
                            $scope.loading = false;
                            $scope.findExisting = false;
                        }
                    });
        } else {
            //Create a blank Timesheet
            $scope.loading = false;
            $scope.findExisting = false;
            $scope.timesheetID = null;
            $scope.timesheetItems = [angular.extend({}, timesheetTemplate)];
            $scope.timesheetDate = $scope.yesterday;
        }
    };

    $scope.loadTimesheetItems(timesheet);

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
    $scope.updateTotal = function (row, col) {
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
        for (var i in rowHours) {
            if (isNaN(rowHours[i])) {
                rowHours[i] = 0;
            }
        }
        row.totalHours = rowHours.regularHours + rowHours.overtimeHours + rowHours.doubleOTHours + rowHours.statRegularHours + rowHours.statOTHours + rowHours.statDoubleOTHours;
        $scope.updateTotalSum();
    };

    $scope.updateTotalSum = function () {
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDoubleOTHours'];

        for (var j in colValues) {
            var col = colValues[j];
            $scope.sumTotal[col] = 0;
            for (var i in $scope.timesheetItems) {
                var totalCol = Object.keys($scope.timesheetItems[i]).length - 1;
                if ($scope.timesheetItems[i][col] === null || isNaN($scope.timesheetItems[i][col])) {
                    $scope.sumTotal[col] += 0;
                } else {
                    $scope.sumTotal[col] += parseFloat($scope.timesheetItems[i][col]);
                }
            }
        }

        $scope.sumTotal.totalHours = 0;
        for (var p in $scope.timesheetItems) {
            var totalRow = parseInt($scope.timesheetItems[p].totalHours);
            $scope.sumTotal.totalHours += totalRow;
        }
    };

    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function () {
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        $scope.timesheetItems.push(angular.extend({}, timesheetTemplate));
        if ($scope.laborerPositionID !== '') {
            $scope.timesheetItems[$scope.timesheetItems.length - 1].StaffTypes_id = $scope.laborerPositionID;
        }
    };

    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function () {
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        for (var i in $scope.timesheetItems) {
            if ($scope.timesheetItems[i].isSelected === true) {
                $scope.timesheetItems.splice(parseInt(i) + 1, 0, angular.extend({}, timesheetTemplate));
                if ($scope.laborerPositionID !== '') {
                    $scope.timesheetItems[parseInt(i) + 1].StaffTypes_id = $scope.laborerPositionID;
                }
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function () {
        var timesheet = $scope.timesheetItems;
        var newArray = timesheet;
        for (var i = $scope.timesheetItems.length - 1; i >= 0; i--) {
            if ($scope.timesheetItems[i].isSelected === true) {
                newArray.splice(parseInt(i), 1);
            }
        }
        $scope.updateTotalSum();
        $scope.timesheetItems = newArray;
    };

    //Select All
    $scope.selectAllToggle = function (value) {
        if (value === true) {
            for (var i in $scope.timesheetItems) {
                $scope.timesheetItems[i].isSelected = true;
            }
        } else {
            for (var j in $scope.timesheetItems) {
                $scope.timesheetItems[j].isSelected = false;
            }
        }
    };

    $scope.selectToll1 = [[]];
    $scope.selectToll2 = [[]];

    //Get vehicle ID tolls
    $scope.getVehicleTolls = function (vehicleID, timesheetItems) {
        timesheetSrv.getTolls(vehicleID)
                .then(function () {
                    $scope.tolls = timesheetSrv.vehicleTolls;
                    if (timesheetItems) {
                        for (var i in timesheetItems) {
                            if (i > 0) {
                                $scope.selectToll1.push([]);
                                $scope.selectToll2.push([]);
                            }
                            for (var j in $scope.tolls) {
                                if (timesheetItems[i].toll1 === $scope.tolls[j].cost) {
                                    $scope.timesheetItems[i].toll1 = $scope.tolls[j].cost;
                                    $scope.selectToll1[i][j] = true;
                                }

                                if (timesheetItems[i].toll2 === $scope.tolls[j].cost) {
                                    $scope.timesheetItems[i].toll2 = $scope.tolls[j].cost;
                                    $scope.selectToll2[i][j] = true;
                                }
                            }
                        }
                    }
                });
    };

    //check the selected rows
    $scope.checkSelected = function (value) {
        if (value === false) {
            $scope.selectAll = false;
        }
    };

    $scope.setCategory = function (positionID) {
        if ($scope.timesheetItems.length == 1) {
            $scope.timesheetItems[0].StaffTypes_id = positionID;
        }
    };

    //Check if an hour value is empty, replace it with 0
    $scope.checkEmpty = function (row, col) {
        if (row[col] === null || isNaN(row[col])) {
            row[col] = 0;
        }
    };

    //Remove Tolls
    $scope.removeTolls = function (object) {
        var newObj = object;
        for (var i in newObj) {
            delete newObj[i].toll1;
            delete newObj[i].toll2;
            newObj[i].Timesheet_id = $scope.timesheetID;
        }
        return newObj;
    };

    //Get Tolls
    $scope.getTolls = function (object, date) {
        var newObj = [];
        for (var i in object) {
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
    $scope.saveTimesheet = function (object) {
        var date = $filter('date')($scope.timesheetDate, 'yyyy-MM-dd');

        $scope.timesheet = {
            Timesheet_id: $scope.timesheetID,
            staffID: $scope.staffID,
            workDate: date,
            Vehicles_id: $scope.vehicleID,
            hourlyRate: $scope.hourlyRate,
            totalHours: $scope.sumTotal.totalHours
        };

        var tolls = $scope.getTolls(object, date);
        var timesheetItems = $scope.removeTolls(object);
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        timesheetSrv.saveTimesheet($scope.timesheet, timesheetItems, formToken);
    };

    //Clear timesheet
    $scope.clearTimesheet = function () {
        $scope.laborer = '';
        $scope.vehicleID = '';
        $scope.hourlyRate = 0;
        $scope.prevName = '';
        $scope.prevDate = '';
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        $scope.timesheetItems = angular.extend({}, [timesheetTemplate]);
        $scope.updateTotalSum();
    };

});
