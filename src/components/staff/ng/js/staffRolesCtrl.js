
(function() {
   
    angular
        .module('staffAdmin')
        .controller('staffRolesCtrl', staffRolesCtrl);

    function staffRolesCtrl($rootScope, staffRolesSrv) {
        var self = this;
        
        self.loading = true;
        self.staffLoaded = false;
       
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            self.loading = false;
            self.staffLoaded = true;
            getStaffRoles(args.staff);
        });
        
       function getStaffRoles(object) {        
            staffRolesSrv.getStaffRoles(object).then(function () {
                self.staffRoles = staffRolesSrv.staffRoles;
                self.loading = false;
            });
        }

        self.submitRoles = function (object) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            object.id = document.getElementById('Staff_id').value;
            
            staffRolesSrv.saveRoles(object, formToken).then(function () {
                getStaffRoles();
            });
        };
    }
})();