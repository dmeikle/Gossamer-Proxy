// Timesheet service
module.service('timesheetSrv', function($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/timesheets/';
    var timesheetItemsPath = '/admin/accounting/timesheetitems/';
    var staffPath = '/admin/staff/';
    var staffSearchPath = '/admin/staff/search';
    var claimsPath = '/admin/claims/';
    var claimsSearchPath = '/admin/claims/search';
    var vehicleTollPath = '/admin/vehicles/tolls/';

    var self = this;

    self.error = {};
    self.error.showError = false;

    //Get the list of timesheets
    this.getTimesheetList = function(row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
            .then(function(response) {
                self.timesheetList = response.data.Timesheets;
                self.timesheetCount = response.data.TimesheetsCount[0].rowCount;
            }, function(response) {
                //Handle any errors
                self.error.showError = true;
            });
    };

    //Get details for the breakdown view
    this.getTimesheetDetail = function(object) {
        console.log('getting breakdown...');
        return $http.get(apiPath + 'breakdown/' + object.id)
            .then(function(response) {
                self.timesheetBreakdown = response.data.TimesheetBreakdowns;
            });
    };

    //Get the a specific timesheet
    this.getTimesheet = function(id) {
        return $http.get(apiPath + id)
            .then(function(response) {
                self.timesheetItems = response.data.Timesheet[1].TimesheetItems;
                console.log(self.timesheetItems);
                for (var i in self.timesheetItems) {
                    self.timesheetItems[i].regularHours = parseFloat(self.timesheetItems[i].regularHours);
                    self.timesheetItems[i].overtimeHours = parseFloat(self.timesheetItems[i].overtimeHours);
                    self.timesheetItems[i].doubleOTHours = parseFloat(self.timesheetItems[i].doubleOTHours);
                    self.timesheetItems[i].statRegularHours = parseFloat(self.timesheetItems[i].statRegularHours);
                    self.timesheetItems[i].statOTHours = parseFloat(self.timesheetItems[i].statOTHours);
                    self.timesheetItems[i].statDoubleOTHours = parseFloat(self.timesheetItems[i].statDoubleOTHours);
                    self.timesheetItems[i].totalHours = parseFloat(self.timesheetItems[i].totalHours);
                }
            }, function(response) {
                //Handle any errors
                self.error.showError = true;
            });
    };

    //Get timesheet items for an ID
    this.getTimesheetItems = function(id, row, numRows) {
        return $http.get(timesheetItemsPath + id + '/' + row + '/' + numRows)
            .then(function(response) {
                self.timesheetItems = response.data.Timesheets;
            });
    };

    //Search for a timesheet by name and workdate
    this.searchTimesheets = function(name, workDate) {
        var config = {};
        config.name = name;
        config.workDate = workDate;
        return $http({
                url: apiPath + 'search?',
                method: 'GET',
                params: config
            })
            .then(function(response) {
                console.log(response);
                self.timesheetSearchCount = response.data.TimesheetsCount[0].rowCount;
                self.timesheetSearchResults = response.data.Timesheets[0];
                console.log(response.data.Timesheets[0]);
            });
    };

    //Staff Autocomplete
    this.staffAutocomplete = function(searchObject) {
        var config = {};
        config.name = searchObject;
        return $http({
                url: staffPath + 'search?',
                method: 'GET',
                params: config
            })
            .then(function(response) {
                self.autocompleteList = response.data.Staffs;
            });
    };

    //Staff Search
    this.filterListBy = function(row, numRows, object) {
        var config = {};
        if (object) {
            var splitObject = object.split(' ');
            console.log(splitObject);
            if (object || splitObject.length === 1) {
                config.name = object;
            }
        } else {
            config = undefined;
        }

        return $http({
                url: staffSearchPath,
                method: 'GET',
                params: config
            })
            .then(function(response) {
                self.searchResults = response.data.Staffs;
                self.searchResultsCount = response.data.Staffs.length;
            });
    };

    //Claim Autocomplete
    this.claimsAutocomplete = function(searchObject) {
//        var value = searchObject;
//        var column = 'name';
//
//        return $http.get(claimsPath + 'search?' + column + '=' + value)
//            .then(function(response) {
//                self.claimsList = response.data;
//                self.claimsCount = Object.keys(response.data).length - 2;
//            });
//        return searchSrv.fetchAutocomplete(claimsPath, searchObject).then(function () {
//            self.autocompleteValues = searchSrv.autocomplete.Claims;
//            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
//                return self.autocompleteValues;
//            } else if (self.autocompleteValues[0] === 'undefined undefined') {
//                return undefined;
//            }
//        });
    };
    
    //Claims Autocomplete
    this.fetchClaimsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(claimsPath, searchObject).then(function () {
            self.autocompleteValues = searchSrv.autocomplete.Claims;
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    //Claim Search
    this.filterClaims = function(row, numRows, object) {
        console.log(object);
        var config = {};
        if (object.val[0]) {
            config.claim = object.val[0];
        } else {
            config = undefined;
        }
        return $http({
                url: claimsSearchPath,
                method: 'GET',
                params: config
            })
            .then(function(response) {});
    };

    //Save a Timesheet
    this.saveTimesheet = function(timesheet, timesheetItems, formToken) {
        console.log('saving timesheet...');
        var timesheetID = '';
        if (timesheet.Timesheet_id) {
            timesheetID = parseInt(timesheet.Timesheet_id);
        } else {
            timesheetID = '0';
        }

        var data = {};
        data.timesheet = timesheet;
        data.timesheetItems = timesheetItems;
        //data.tolls = tolls;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + timesheetID,
            data: data
        }).then(function(response) {
            console.log(response);
        });
    };

    //Get vehicle tolls
    this.getTolls = function(vehicleID) {
        return $http.get(vehicleTollPath + vehicleID)
            .then(function(response) {
                self.vehicleTolls = response.data.VehicleTolls;
            });
    };

    //Typeahead autocomplete
    this.fetchAutocomplete = function(searchObject) {
        console.log('fetching typeahead autocomplete...');
        return searchSrv.fetchAutocomplete(staffPath, searchObject).then(function() {
            self.autocomplete = searchSrv.autocomplete.Staffs;
            self.autocompleteValues = [];
            if (searchObject.name) {
                for (var staff in self.autocomplete) {
                    if (self.autocomplete.hasOwnProperty(staff) && self.autocomplete.length > 0) {
                        self.autocompleteValues.push(self.autocomplete[staff].firstname + ' ' + self.autocomplete[staff].lastname);
                    }
                }
            }
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    this.search = function(searchObject) {
        return searchSrv.search(apiPath, searchObject).then(function() {
            self.searchResults = searchSrv.searchResults.Timesheets;
            self.searchResultsCount = searchSrv.searchResults.TimesheetsCount[0].rowCount;
        });
    };

    this.advancedSearch = function(searchObject) {
        var config = angular.copy(searchObject);
        config.workDate = $filter('date')(config.workDate, 'yyyy-MM-dd', '+0000');
        return $http({
                url: apiPath + 'search?',
                method: 'GET',
                params: config
            })
            .then(function(response) {
                console.log(response);
                self.advancedSearchResults = response.data.Timesheets;
                self.advancedSearchResultsCount = response.data.TimesheetsCount[0].rowCount;
            });
    };
});