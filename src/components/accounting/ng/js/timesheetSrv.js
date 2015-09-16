// Timesheet service
module.service('timesheetSrv', function($http) {
    var apiPath = '/admin/accounting/timesheets/';
    var staff_apiPath = '/admin/staff/';
    var staff_search_apiPath = '/admin/staff/search';
    var claim_apiPath = '/admin/claims/';
    var claim_search_apiPath = '/admin/claims/search';
    var vehicle_toll_apiPath = '/admin/vehicles/tolls/';
    var self = this;
    
    var row = 0;
    var numRows = 20;
    self.error = {};
    self.error.showError = false;
    
    //Get the list of timesheets
    this.getTimesheetList = function(row, numRows){
        return $http.get(apiPath + row + '/' + numRows)
        .then(function(response) {

            self.timesheetList = response.data.Timesheets;
        }, function(response){
            //Handle any errors
            self.error.showError = true;
        });
    };
    
    //Staff Autocomplete
    this.autocomplete = function(searchObject) {
        var value = searchObject.val[0];
        var column = 'name';

        return $http.get(staff_apiPath + 'search?' + column + '=' + value)
            .then(function(response) {
            console.log(response);
            self.autocompleteList = response.data.Staffs;
        });
    };
    
    //Staff Search
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
    
    //Claim Autocomplete
    this.claimsAutocomplete = function(searchObject){
        var value = searchObject;
        var column = 'Claims_id';
        
        return $http.get(claim_apiPath + 'search?' + column + '=' + value)
            .then(function(response) {
            console.log(response);
            self.claimsList = response.data;
            self.claimsCount = Object.keys(response.data).length-2;
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
            url: claim_search_apiPath,
            method: 'GET',
            params: config
        })
            .then(function(response) {
            console.log(response);
            //self.claimResults = response.data.Staffs;
            //self.searchResultsCount = response.data.Staffs.length;
        });
    };
    
    
    //Save a Timesheet
    this.saveTimesheet = function(timesheet, timesheetItems, tolls, formToken){
        
        var data = {};
        data.timesheet = timesheet;
        data.timesheetItems = timesheetItems;
        data.tolls = tolls;
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
    
    //Get vehicle tolls
    this.getTolls = function(vehicleID){
        return $http.get(vehicle_toll_apiPath + vehicleID)
            .then(function(response) {
            console.log('Vehicle Tolls:');
            console.log(response);
            self.vehicleTolls = response.data.VehicleTolls;
            //self.claimsCount = Object.keys(response.data).length-2;
        });
    };
});