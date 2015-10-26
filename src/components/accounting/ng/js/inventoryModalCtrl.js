module.controller('inventoryModalCtrl', function ($modalInstance, $scope, inventoryModalSrv, inventoryItem) {
    
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

//    if (generalCost) {
//        $scope.loading = true;
//        generalCostsModalSrv.getGeneralCostItems(row, numRows, generalCost.id)
//                .then(function () {
//                    console.log(generalCostsModalSrv.generalCostItems);
//                    var costItems = generalCostsModalSrv.generalCostItems;
//                    for (var i in costItems) {
//                        //costItems[i].dateEntered = Date.parse((costItems[i].dateEntered.replace(/-/g,"/")));
//                        costItems[i].dateEntered = new Date(costItems[i].dateEntered);
//                        costItems[i].cost = parseFloat(costItems[i].cost);
//                        costItems[i].chargeOut = parseFloat(costItems[i].chargeOut);
//                    }
//                    $scope.AccountingGeneralCost = generalCost;
//                    $scope.generalCostItems = costItems;
//                    console.log($scope.generalCostItems);
//                    $scope.loading = false;
//                });
//    } else {
//        $scope.loading = false;
//        $scope.generalCostItems = angular.copy([generalCostItemsTemplate]);
//    }

    //Get Claims ID from autocomplete list
//    $scope.getClaimsID = function (jobNumber) {
//        for (var i in generalCostsModalSrv.autocomplete) {
//            if (generalCostsModalSrv.autocomplete[i].label === jobNumber) {
//                $scope.AccountingGeneralCost.Claims_id = generalCostsModalSrv.autocomplete[i].id;
//            }
//        }
//    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event, index) {
        $scope.isOpen.datepicker[index] = true;
    };

    //Saving Items    
//    $scope.saveGeneralCostItems = function () {
//        var generalCostItems = angular.copy($scope.generalCostItems);
//        for (var i in generalCostItems) {
//            console.log('filtering date!');
//            generalCostItems[i].dateEntered = $filter('date')(generalCostItems[i].dateEntered, 'yyyy-MM-dd');
//        }
//
//        //$scope.AccountingGeneralCost.AccountingGeneralCostItems = generalCostItems;
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//
//        generalCostsModalSrv.saveGeneralCosts($scope.AccountingGeneralCost, generalCostItems, formToken);
//    };
});