module.controller('staffTimesheetCtrl', function($scope, $modal, templateSrv) {

    //Modals
    $scope.openStaffTimesheetModal = function() {
        var template = templateSrv.staffTimesheetModal;
        $modal.open({
            templateUrl: template,
            controller: 'staffTimesheetModalCtrl',
            size: 'lg',
            windowClass: 'staff-timesheet-modal'
//            resolve: {
//                timesheet: function () {
//                    return timesheet;
//                }
//            }
            //          resolve: {
            //            staff: function() {
            //              return staff;
            //            }
            //          }

            //        })
        });
    };
});
