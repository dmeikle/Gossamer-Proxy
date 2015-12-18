
module.controller('photoUploadModalCtrl', function(claim, photoCounts, $scope, $rootScope, $uibModalInstance, photoUploadSrv) {
    $scope.claim = claim;
   // $scope.claimLocations = claimLocations;
    $scope.photoCounts = photoCounts;
    var event = {};
    
    generateDropzoneConfigs();

    function generateDropzoneConfigs() {
        for (var i = photoCounts.length - 1; i >= 0; i--) {
            $scope['dropzoneConfig' + photoCounts[i].id] = photoUploadSrv.generateDropzoneConfig($scope.claim.id, photoCounts[i].id);
        }
    }

    $rootScope.$on('photoCountUpdated', function(event, response) {
        $scope.photoCounts = response.data.folderList.unitNumbers;
    });

    $rootScope.$on('photoUploaded', function(response) {
        $scope.photoCounts = response.data.folderList.unitNumbers;
    });

    $scope.close = function() {
        $uibModalInstance.dismiss('close');
    };
});