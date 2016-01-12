module.controller('staffRolesCtrl', function ($rootScope, $scope, $location, staffRolesSrv) {
    // Stuff to run on controller load
    $scope.staffRoles = {};
    $scope.staffRoles.loading = true;
    
    
    $rootScope.$on('STAFF_LOADED', function(event, args) {
        self.loading = false;
        getStaffRoles(args.staff);
    });
        

    function getStaffRoles(object) {
        
        staffRolesSrv.getStaffRoles(object).then(function () {
            $scope.staffRoles = staffRolesSrv.staffRoles;
            $scope.staffRoles.loading = false;
        });
    }

    $scope.submitRoles = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        staffRolesSrv.saveRoles(object, formToken).then(function () {
            getStaffRoles();
        });
    };
});
