// Timesheet service
module.service('timesheetSrv', function($http) {
    var apiPath = '/admin/accounting/timesheets/';
    var staff_apiPath = '/admin/staff/';
    var staff_search_apiPath = '/admin/staff/search';
    var self = this;
    
    var row = 0;
    var numRows = 20;
    
    //Get the list of timesheets
    this.getTimesheetList = function(row, numRows){
        return $http.get(apiPath + row + '/' + numRows)
        .then(function(response) {

            self.timesheetList = response.data.Timesheets;
        }, function(response){
            console.log('An error occured while attempting to access the database, please try again.');
        });
    };
    
    //Autocomplete
    this.autocomplete = function(searchObject) {
        var value = searchObject.val[0];
        var column = 'name';

        return $http.get(staff_apiPath + 'search?' + column + '=' + value)
            .then(function(response) {
            self.autocompleteList = response.data.Staffs;
        });
    };
    
    //Search
    this.filterListBy = function(row, numRows, object) {
        var config = {};
        if (object.val[0]) {
            
            var name = object.val[0].split(' ');
            for (var i = 0; i < Object.keys(object).length; i++) {
                config.firstname = name[0];
                config.lastname = name[1];

            }
        } else {
            config = undefined;
        }
        
        return $http({
            url: staff_search_apiPath,
            method: 'GET',
            params: config
        })
            .then(function(response) {
            console.log(response);
            self.searchResults = response.data.Staffs;
            self.searchResultsCount = response.data.Staffs.length;
        });
    };
    
    //Save a Timesheet
    this.saveTimesheet = function(timesheet, formToken){
        
        var data = {};
        data.timesheet = timesheet;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + '0',
            data: data
        }).then(function(response) {
            console.log(response);
      //      self.credentialStatus = response.data;
        });
    };
    
//    this.saveCredentials = function(object, formToken) {
//        var data = {};
//        data.StaffAuthorization = object;
//        data.FORM_SECURITY_TOKEN = formToken;
//        return $http({
//            method: 'POST',
//            headers: {
//            'Content-Type': 'application/x-www-form-urlencoded'
//            },
//            url: apiPath + 'credentials/' + object.id,
//            data: data
//        }).then(function(response) {
//            self.credentialStatus = response.data;
//        });
//    };
});