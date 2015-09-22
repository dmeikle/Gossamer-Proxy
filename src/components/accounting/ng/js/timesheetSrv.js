// Timesheet service
module.service('timesheetSrv', function($http) {
    var apiPath = '/admin/accounting/timesheets/';
    var timesheet_items_apiPath = '/admin/accounting/timesheetitems/';
    var staff_apiPath = '/admin/staff/';
    var staff_search_apiPath = '/admin/staff/search';
    var claim_apiPath = '/admin/claims/';
    var claim_search_apiPath = '/admin/claims/search';
    var vehicle_toll_apiPath = '/admin/vehicles/tolls/';
    var self = this;
    
//    var row = 0;
//    var numRows = 20;
    self.error = {};
    self.error.showError = false;
    
    //Get the list of timesheets
    this.getTimesheetList = function(row, numRows){
        return $http.get(apiPath + row + '/' + numRows)
        .then(function(response) {
            //console.log(response.data.TimesheetsCount);
            self.timesheetList = response.data.Timesheets;
            self.timesheetCount = response.data.TimesheetsCount[0].rowCount;
        }, function(response){
            //Handle any errors
            self.error.showError = true;
        });
    };
    
    //Get the a specific timesheet
    this.getTimesheet = function(id){
        console.log('getting timesheet for id: ' + id);
        return $http.get(apiPath + id)
        .then(function(response) {
            //console.log(response);
            self.timesheetItems = response.data.Timesheet[1].TimesheetItems;
            console.log(self.timesheetItems);
            for(var i in self.timesheetItems){
                self.timesheetItems[i].regularHours = parseFloat(self.timesheetItems[i].regularHours);
                self.timesheetItems[i].overtimeHours = parseFloat(self.timesheetItems[i].overtimeHours);
                self.timesheetItems[i].doubleOTHours = parseFloat(self.timesheetItems[i].doubleOTHours);
                self.timesheetItems[i].statRegularHours = parseFloat(self.timesheetItems[i].statRegularHours);
                self.timesheetItems[i].statOTHours = parseFloat(self.timesheetItems[i].statOTHours);
                self.timesheetItems[i].statDoubleOTHours = parseFloat(self.timesheetItems[i].statDoubleOTHours);
                self.timesheetItems[i].totalHours = parseFloat(self.timesheetItems[i].totalHours);
            }
            //self.timesheetItems.
        }, function(response){
            //Handle any errors
            self.error.showError = true;
        });
    };
    
    //Get timesheet items for an ID
    this.getTimesheetItems = function(id, row, numRows){
        console.log('getting timesheet items for id = ' + id);
        //console.log(timesheet_items_apiPath + id + '/' + row + '/' + numRows);

        return $http.get(timesheet_items_apiPath + id + '/' + row + '/' + numRows)
        .then(function(response){
            
            //console.log(response);
            self.timesheetItems = response.data.Timesheets;
        });
    };
    
    //Staff Autocomplete
    this.autocomplete = function(searchObject) {
        //var value = searchObject.val[0];
        var value = searchObject;
        var column = 'name';     
        
        
        
        return $http.get(staff_apiPath + 'search?' + column + '=' + value)
            .then(function(response) {
            //console.log(response);
            self.autocompleteList = response.data.Staffs;
        });
    };
    
    //Staff Search
    this.filterListBy = function(row, numRows, object) {
        var config = {};
//        if (object.val[0]) {
//            
//            var name = object.val[0].split(' ');
//            for (var i = 0; i < Object.keys(object).length; i++) {
//                config.firstname = name[0];
//                config.lastname = name[1];
//            }
//        } else {
//            config = undefined;
//        }
        if(object){            
            var splitObject = object.split(' ');
            console.log(splitObject);
        
            if (object || splitObject.length === 1) {            
                //var name = object.split(' ');
                //for (var i = 0; i < Object.keys(object).length; i++) {
                    config.name = object;
                    //config.lastname = name[1];
                //}
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
            //console.log(response);
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
            //console.log(response);
            self.claimsList = response.data;
            self.claimsCount = Object.keys(response.data).length-2;
        });
    };
    
    //Get Claim label
    
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
            //console.log(response);
            //self.claimResults = response.data.Staffs;
            //self.searchResultsCount = response.data.Staffs.length;
        });
    };
    
    
    //Save a Timesheet
    this.saveTimesheet = function(timesheet, timesheetItems, formToken){
        console.log('saving timesheet...');
        var timesheetID = '';
        if(timesheet.Timesheet_id){
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
      //      self.credentialStatus = response.data;
        });
    };
    
    //Get vehicle tolls
    this.getTolls = function(vehicleID){
        return $http.get(vehicle_toll_apiPath + vehicleID)
            .then(function(response) {
            //console.log('Vehicle Tolls:');
            //console.log(response);
            self.vehicleTolls = response.data.VehicleTolls;
            //self.claimsCount = Object.keys(response.data).length-2;
        });
    };
});