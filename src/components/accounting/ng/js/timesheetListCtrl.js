module.controller('timesheetListCtrl', function($scope, $modal, costCardItemTypeSrv, templateSrv, timesheetSrv) {
    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;
    
    $scope.loading = true;
    
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    
    timesheetSrv.getTimesheetList(0,20).then(function(){
        $scope.loading = false;
        $scope.timesheetList = timesheetSrv.timesheetList;  
    });
    console.log('timesheet List 2!');

    //Get the dates
    $scope.getDates = function(){
        console.log('Getting dates');
        $scope.date = new Date();
        $scope.yesterday = $scope.date.setDate($scope.date.getDate() - 1);
    };
    
    //Autocomplete
    function fetchAutocomplete() {
        //console.log($scope.basicSearch);
        timesheetSrv.autocomplete($scope.basicSearch)
            .then(function() {
            $scope.autocomplete = timesheetSrv.autocompleteList;
            console.log($scope.autocomplete);
        });
    }   
    
    $scope.$watch('basicSearch.val', function() {
        //console.log($scope.basicSearch.val);
        if ($scope.basicSearch.val !== undefined) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });
    
    //Search
    $scope.search = function(searchObject) {
        console.log('Search Object = ' + searchObject);
        if (searchObject.val) {
            timesheetSrv.filterListBy(0, 20, searchObject)
                .then(function() {
                if (timesheetSrv.searchResults) {
                    $scope.staffList = timesheetSrv.searchResults;
                    $scope.totalItems = timesheetSrv.searchResultsCount;
                    console.log($scope.staffList);
                } else {
                    getStaffList();
                }
            });
        } else {
            getStaffList();
        }
    };
    
    
    $scope.timesheetSelected = false;
    
    $scope.$watch('newTimesheet', function() {
        console.log('Time sheet updated!');
        for(var i in $scope.newTimesheet){
            if($scope.newTimesheet[i].selected === true){
                $scope.timesheetSelected = true;
                return;
            } else {
                $scope.timesheetSelected = false;
            }
        }
        //console.log($scope.basicSearch.val);
//        if ($scope.basicSearch.val !== undefined) {
//            $scope.autocomplete.loading = true;
//            fetchAutocomplete();
//        }
    }, true);
    
    //Timesheet template
    var timesheetTemplate = {
        selected: false,
        claim: '',
        phase: '',
        category: 'Manager',
        description: '',
        reg: '0',
        ot: '0',
        dot: '0',
        sreg: '0',
        sot: '0',
        sdot: '0',
        total: '0'
    };
    
    //New Timesheet
    $scope.newTimesheet = [timesheetTemplate];
    
    $scope.updateTotal = function(row){
        row.total = parseInt(row.reg) + parseInt(row.ot) + parseInt(row.dot) + parseInt(row.sreg) + parseInt(row.sot) + parseInt(row.sdot);
    };
    
    $scope.addTimesheetRow = function(){
        $scope.newTimesheet.push({
        selected: false,
        claim: '',
        phase: '',
        category: '',
        description: '',
        reg: '0',
        ot: '0',
        dot: '0',
        sreg: '0',
        sot: '0',
        sdot: '0',
        total: '0'
    });
    };
    
    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function(){
        for (var i in $scope.newTimesheet){
            
            if($scope.newTimesheet[i].selected === true){
                //console.log('selected row = ' + i+1);
                console.log($scope.newTimesheet[i]);
                $scope.newTimesheet.splice(parseInt(i)+1, 0,
                {
                    selected: false,
                    claim: '',
                    phase: '',
                    category: '',
                    description: '',
                    reg: '0',
                    ot: '0',
                    dot: '0',
                    sreg: '0',
                    sot: '0',
                    sdot: '0',
                    total: '0'
                });                
            }            
        }
    };
    
    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function(){
        console.log('--DELETE ROWS---');
        var test = $scope.newTimesheet;
        var newArray = test;
        
        for (var i = $scope.newTimesheet.length-1; i >= 0; i--){
            
            console.log('Timesheet ' + $scope.newTimesheet[i].claim);
            if($scope.newTimesheet[i].selected === true){
                console.log('Timesheet ' + $scope.newTimesheet[i].claim + ' is being deleted!');
                newArray.splice(parseInt(i), 1);                
            }            
        }
        
        $scope.newTimesheet = newArray;
    };
    
    
    //Select All
    $scope.selectAllToggle = function(value){
        if(value === true){
            for(var i in $scope.newTimesheet){
                $scope.newTimesheet[i].selected = true;
            }
        } else {
            for(var j in $scope.newTimesheet){
                $scope.newTimesheet[j].selected = false;
            }
        }
    };
    
    
    //check the selected rows
    $scope.checkSelected = function(value){
        if(value === false){
            $scope.selectAll = false;
        }
    };
    
    //Call the functions
    $scope.getDates();
    
    //Modals
    $scope.openTimesheetModal = function() {
        var template = templateSrv.timesheetModal;
        $modal.open({
          templateUrl: template,
          controller: 'timesheetListCtrl',
          size: 'lg',
//          resolve: {
//            staff: function() {
//              return staff;
//            }
//          }
        });
    };
    
    
    $scope.setCategory = function(value){
        var laborerPos = value.split(' - ');
        console.log(laborerPos[1]);
        $scope.search(laborerPos[0]);
        
        for(var i in $scope.newTimesheet){
            $scope.newTimesheet[i].category = laborerPos[1];
            console.log('added category' + $scope.newTimesheet[i].category);
        }
    };
//  $scope.openStaffAdvancedSearchModal = function() {
//    var template = templateSrv.staffEditModal;
//    var modalInstance = $modal.open({
//      templateUrl: template,
//      controller: 'staffModalCtrl',
//      size: 'lg'
//    });
//
//    modalInstance.result
//      .then(function(staff) {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        staffListSrv.saveStaff(staff, formToken)
//          .then(function() {
//            getStaffList();
//          });
//      });
//  };
    
});