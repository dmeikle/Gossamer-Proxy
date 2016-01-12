(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffGeneralInfoCtrl', staffGeneralInfoCtrl);
    
    function staffGeneralInfoCtrl(staffSrv, $rootScope) {
        var self = this;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            self.staff = args.staff;
        });
        
    }
})();