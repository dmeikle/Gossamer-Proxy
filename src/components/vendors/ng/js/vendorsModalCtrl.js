module.controller('vendorModalController', function($scope, $uibModalInstance, vendor, vendorsEditSrv) {

    $scope.loading = true;
    $scope.vendor = vendor;


    $scope.confirm = function(item) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        vendorsEditSrv.save(item, formToken);

        $uibModalInstance.close(item);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

module.controller('purchaseOrdersModalController', function($scope, $uibModalInstance, vendor, purchaseOrders) {
    $scope.itemsPerPage = 10;
    $scope.currentPage = 1;
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    $scope.purchaseOrdersList = purchaseOrders.data.PurchaseOrders;
    $scope.itemsPerPage = purchaseOrders.data.PurchaseOrdersCount;

    $scope.vendor = vendor;
    $scope.vendorLocation = vendorLocation;

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

module.controller('vendorLocationModalController', function($scope, $rootScope, $uibModalInstance,
    vendor, vendorLocation, purchaseOrders, vendorLocationEditSrv) {
    $scope.itemsPerPage = 10;
    $scope.currentPage = 1;
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    $scope.purchaseOrdersList = purchaseOrders.data.PurchaseOrders;
    $scope.itemsPerPage = purchaseOrders.data.PurchaseOrdersCount;

    $scope.vendor = vendor;
    $scope.vendorLocation = vendorLocation;

    $scope.deleteLocation = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        $scope.vendorLocation.isActive = '0';
        vendorLocationEditSrv.delete($scope.vendorLocation, formToken).then(function() {
            $rootScope.$broadcast('vendorLocationSaved');
            $scope.close();
        });
    };

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

module.controller('addVendorLocationModalCtrl', function($scope, $uibModalInstance, vendor) {
    $scope.vendor = vendor;
    $scope.vendorLocation = {};

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };

    $scope.submit = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        for (var property in $scope.vendorLocation) {
            if ($scope.vendorLocation.hasOwnProperty(property) &&
                !$scope.vendorLocation[property]) {
                delete $scope.vendorLocation[property];
            }
        }
        var data = $scope.vendorLocation;
        data.FORM_SECURITY_TOKEN = formToken;
        $uibModalInstance.close(data);
    };
});