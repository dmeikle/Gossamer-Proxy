module.controller('cashReceiptsModalCtrl', function ($modalInstance, $scope, cashReceiptsModalSrv, invoice, $filter) {
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.item = {};
    $scope.isOpen = {};
    $scope.isOpen.datepicker = false;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    if(invoice){
        $scope.newItem = false;
        $scope.item = invoice;
    } else {
        $scope.newItem = true;
        $scope.item.id = 0;
    }
    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    //Companies Typeahead
    $scope.fetchCompanyAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return cashReceiptsModalSrv.fetchCompanyAutocomplete(searchObject);
    };
    
    //Claims Typeahead
    $scope.fetchClaimsAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return cashReceiptsModalSrv.fetchClaimsAutocomplete(searchObject);
    };
    
//    //Invoices Typeahead
//    $scope.fetchInvoicesAutocomplete = function (viewVal) {
//        var searchObject = {};
//        searchObject.jobNumber = viewVal;
//        return cashReceiptsModalSrv.fetchInvoicesAutocomplete(searchObject);
//    };
    
    //Get company info
    $scope.getCompanyID = function(company){
        $scope.item.Companies_id = company.id;
    };
    
    //Get Claims id
    $scope.getClaimsID = function(claim){
        $scope.item.Claims_id = claim.id;
    };
    
    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event, datepicker) {
        $scope.isOpen.datepicker = true;
    };
    
    //Clear the item
    $scope.clear = function(){
        $scope.item = {};
    };
    
    //Saving Items    
    $scope.save = function () {
        var item = angular.copy($scope.item);
        item.dateReceived = $filter('date')(item.dateReceived, 'yyyy-MM-dd', '+0000');
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        cashReceiptsModalSrv.save(item, formToken);
    };
});