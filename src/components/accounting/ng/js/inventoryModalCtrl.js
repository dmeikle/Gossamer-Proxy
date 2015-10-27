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

    if (inventoryItem) {       
        $scope.item = inventoryItem;
        $scope.newItem = false;
    } else {
        $scope.newItem = true;
    }
    
    //Clear the item
    $scope.clear = function(){
        $scope.item = {};
    };
    
    //Saving Items    
    $scope.save = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryModalSrv.save($scope.item, formToken);
    };
});