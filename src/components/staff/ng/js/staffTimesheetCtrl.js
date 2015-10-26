module.controller('staffTimesheetCtrl', function ($scope, $modal, staffTemplateSrv) {

    //Modals
    $scope.openStaffTimesheetModal = function () {
        $scope.loadingModal = true;
        var template = staffTemplateSrv.staffTimesheetModal;
        $modal.open({
            templateUrl: template,
            controller: 'staffTimesheetModalCtrl',
            size: 'lg',
            windowClass: 'staff-timesheet-modal',
//            resolve: {
//                timesheet: function () {
//                    return timesheet;
//                }
//            }
        }).opened.then(function () {
            $scope.loadingModal = false;
        });
    };
});
