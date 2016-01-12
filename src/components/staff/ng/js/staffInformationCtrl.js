    /* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    (function() {
   
    angular
        .module('staffAdmin')
        .controller('staffInformationCtrl', staffInformationCtrl);

    function staffInformationCtrl(staffSrv, crudSrv, $rootScope, $scope) {
        var self = this;

        self.loading = false;
        self.staff = {};
        
        $scope.$on('STAFF_LOADED', function(event, args) {
            self.loading = false;
            self.staff = args.staff;
        });


        activate();

        function activate() {
            self.loading = true;
            load();
        }
        
        function load() {
            var id = document.getElementById('Staff_id').value;
            staffSrv.getRow(id).then(function (staff) {
                $scope.$broadcast('STAFF_LOADED', {staff: staff});
                $rootScope.$broadcast('STAFF_LOADED', {staff: staff});
            });            
        }
    }
})();