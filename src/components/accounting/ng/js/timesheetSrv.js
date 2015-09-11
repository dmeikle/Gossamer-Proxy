// Timesheet service
module.service('timesheetSrv', function($http) {
    var apiPath = '/admin/accounting/timesheets/';
    var staff_apiPath = '/admin/staff/';
    var self = this;
    
    var row = 0;
    var numRows = 20;
    
    //Get the list of timesheets
    this.getTimesheetList = function(row, numRows){
        return $http.get(apiPath + row + '/' + numRows)
        .then(function(response) {
            self.timesheetList = response.data.Timesheets;
        });
    };
    
    //Autocomplete
    this.autocomplete = function(searchObject) {
        var value = searchObject.val[0];
        var column = 'name';

        return $http.get(staff_apiPath + 'search?' + column + '=' + value)
            .then(function(response) {
            console.log(response);
            self.autocompleteList = response.data.Staffs;
        });
    };
    
    //Search
    this.filterListBy = function(row, numRows, object) {
        var config = {};
        console.log('Filter List');
        console.log(object);
        if (object.val[0]) {
            for (var i = 0; i < Object.keys(object).length; i++) {
             //   config[object[i]] = object.val[i];
                config.name = object.val[i]; 
            }
        } else {
            config = undefined;
        }
        console.log(config);


        return $http({
            url: staff_apiPath + row + '/' + numRows,
            method: 'GET',
            params: config
        })
            .then(function(response) {
            console.log(response.data.Staffs);
            //self.searchResults = response.data.Timesheets;
            //self.searchResultsCount = response.data.Timesheets[0].rowCount;
            self.searchResults = response.data.Staffs;
            self.searchResultsCount = response.data.StaffsCount[0].rowCount;
        });
    };
});