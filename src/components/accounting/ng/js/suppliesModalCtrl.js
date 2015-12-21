module.controller('suppliesModalCtrl', function ($uibModalInstance, $scope, suppliesModalSrv, $filter, $timeout, suppliesUsed) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = false;

    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    //Modal Controls
    $scope.confirm = function () {
        $uibModalInstance.close();
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    //Set up the objects
    var headingsTemplate = {
        //$scope.headings = {
        staffName: '',
        Staff_id: '',
        Claims_id: '',
        ClaimPhases_id: '',
        dateUsed: '',
        ClaimsLocations_id: '',
        Departments_id: ''
    };

    var lineItemsTemplate = {
        SuppliesUsedInventoryItems_id: '',
        isSelected: false,
        productCode: '',
        InventoryItems_id: '',
        name: '',
        PackageTypes_id: '',
        unitPrice: '',
        quantity: '',
        cost: '',
        chargeOut: ''
    };

    $scope.total = {
        cost: 0,
        chargeOut: 0
    };

    //Get the claims locations
    $scope.getClaimsLocations = function (Claims_id) {
        suppliesModalSrv.getClaimsLocations($scope.headings.Claims_id).then(function (locations) {
            $scope.claimsLocations = locations;
        });
    };

    //Check and see if you're editing an item or creating a new one...
    if (suppliesUsed) {
        $scope.loading = true;
        suppliesUsed.dateUsed = new Date(suppliesUsed.dateUsed);
        $scope.headings = suppliesUsed;
        $scope.headings.staffName = $scope.headings.firstname + ' ' + $scope.headings.lastname;
        $scope.getClaimsLocations($scope.headings.ClaimsLocations_id);
        suppliesModalSrv.getItems(row, numRows, suppliesUsed.id)
                .then(function () {
                    if(suppliesModalSrv.lineItems[0].length === 0){
                        $scope.lineItems = angular.copy([lineItemsTemplate]);
                    } else {
                        var lineItems = suppliesModalSrv.lineItems;
                        for (var i in lineItems) {
                            lineItems[i].cost = parseFloat(lineItems[i].cost);
                            lineItems[i].chargeOut = parseFloat(lineItems[i].chargeOut);
                            lineItems[i].quantity = parseFloat(lineItems[i].quantity);
                            lineItems[i].unitPrice = parseFloat(lineItems[i].purchaseCost);
                        }
                        $scope.lineItems = suppliesModalSrv.lineItems;
                    }                    
                    //$scope.lineItems = lineItems;
                    $scope.updateTotal();
                    $scope.loading = false;
                });
    } else {
        $scope.loading = false;
        $scope.headings = angular.copy(headingsTemplate);
        $scope.lineItems = angular.copy([lineItemsTemplate]);
    }


    //Get Staff ID from autocomplete list
    $scope.getStaffID = function (staff) {
        $scope.headings.Staff_id = staff.id;
    };

    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function (claim) {
        $scope.headings.Claims_id = claim.id;
        $scope.headings.jobNumber = claim.jobNumber;
        $scope.getClaimsLocations($scope.headings.Claims_id);
    };
    
    //---Table Controls---
    //Add a row    
    $scope.addRow = function () {
        $scope.lineItems.push(angular.copy(lineItemsTemplate));
    };

    //Insert rows below currently selected items
    $scope.insertRows = function () {
        for (var i in $scope.lineItems) {
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i) + 1, 0, angular.copy(lineItemsTemplate));
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeRows = function () {
        for (var i = $scope.lineItems.length - 1; i >= 0; i--) {
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i), 1);
            }
        }
    };

    //Check selected
    $scope.checkSelected = function () {
        $scope.rowSelected = true;
        for (var index in $scope.lineItems) {
            if ($scope.lineItems[index].isSelected === true) {
                $scope.rowSelected = true;
            }
        }
    };

    //Select All
    $scope.selectAllToggle = function (value) {
        for (var i in $scope.lineItems) {
            if (value === true) {
                $scope.lineItems[i].isSelected = true;
            } else {
                $scope.lineItems[i].isSelected = false;
            }
        }
    };

    //Staff Typeahead
    $scope.fetchStaffAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return suppliesModalSrv.fetchStaffAutocomplete(searchObject);
    };

    //Claim Typeahead
    $scope.fetchClaimAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return suppliesModalSrv.fetchClaimsAutocomplete(searchObject);
    };

    //Materials Typeahead
    $scope.fetchMaterialsAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return suppliesModalSrv.fetchMaterialNameAutocomplete(searchObject);
    };

    //Product Code Typeahead
    $scope.fetchProductCodeAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.productCode = viewVal;
        return suppliesModalSrv.fetchProductCodeAutocomplete(searchObject);
    };

    //Get Material info from material name
    $scope.getMaterialNameInfo = function (row, item) {
        row.productCode = item.productCode;
        row.name = item.name;
        row.unitPrice = parseFloat(item.unitPrice);
        row.PackageTypes_id = item.PackageTypes_id;
        row.InventoryItems_id = item.InventoryItems_id;
//        for (var j in suppliesModalSrv.materialsAutocomplete) {
//            if (suppliesModalSrv.materialsAutocomplete[j].name === value) {
//                row.productCode = suppliesModalSrv.materialsAutocomplete[j].productCode;
//                row.unitPrice = suppliesModalSrv.materialsAutocomplete[j].purchaseCost;
//                row.PackageTypes_id = suppliesModalSrv.materialsAutocomplete[j].PackageTypes_id;
//            }
//        }
    };

    //Get Material info from product code
    $scope.getProductCodeInfo = function (row, item) {
        row.name = item.name;
        row.productCode = item.productCode;
        row.unitPrice = parseFloat(item.unitPrice);
        row.PackageTypes_id = item.PackageTypes_id;
        row.InventoryItems_id = item.id;
        
//        for (var i in suppliesModalSrv.productCodeAutocomplete) {
//            if (suppliesModalSrv.productCodeAutocomplete[i].productCode === value) {
//                row.name = suppliesModalSrv.productCodeAutocomplete[i].name;
//                row.unitPrice = suppliesModalSrv.productCodeAutocomplete[i].purchaseCost;
//                row.PackageTypes_id = suppliesModalSrv.productCodeAutocomplete[i].PackageTypes_id;
//                row.InventoryItems_id = suppliesModalSrv.productCodeAutocomplete[i].id;
//            }
//        }
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event, index) {
        $scope.isOpen.datepicker = true;
    };


    //Update cost based on item quantity and price
    $scope.updateCost = function (row) {
        if (row.quantity === null || row.unitPrice === null) {
            row.cost = '';
            return;
        }
        if (row.quantity && row.unitPrice) {
            row.cost = row.quantity * row.unitPrice;
        }
    };

    //Update totals
    $scope.updateTotal = function () {
        $scope.total = {
            cost: 0,
            chargeOut: 0
        };
        for (var i in $scope.lineItems) {
            if (isNaN($scope.lineItems[i].cost)) {
                $scope.lineItems[i].cost = 0;
            }
            if (isNaN($scope.lineItems[i].chargeOut)) {
                $scope.lineItems[i].chargeOut = 0;
            }
            $scope.total.cost += $scope.lineItems[i].cost;
            $scope.total.chargeOut += $scope.lineItems[i].chargeOut;
        }
    };

    //Saving Items    
    $scope.save = function () {
        var headings = angular.copy($scope.headings);
        var lineItems = angular.copy($scope.lineItems);
        headings.dateUsed = $filter('date')(headings.dateUsed, 'yyyy-MM-dd');
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        suppliesModalSrv.save(headings, lineItems, formToken);

    };

    $scope.clearModal = function () {
        $scope.headings = angular.copy(headingsTemplate);
        $scope.lineItems = angular.copy([lineItemsTemplate]);
    };
});