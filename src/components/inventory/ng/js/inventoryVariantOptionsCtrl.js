module.controller('variantOptionsCtrl', function($scope, $uibModal, variantOptionsSrv) {
    $scope.openVariantModal = function(variant) {
        var modalInstance = $uibModal({
            templateUrl: '/render/inventory/variantModal',
            controller: 'variantModalCtrl',
            size: 'md',
            resolve: {
                multiSelectArray: function() {
                    return $scope.multiSelectArray;
                }
            }
        });
    };
});