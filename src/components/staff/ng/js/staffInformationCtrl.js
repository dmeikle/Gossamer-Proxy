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

    function staffInformationCtrl($rootScope, $scope, staffSrv, staffPhotoSrv) {
        var self = this;

        self.loading = false;
        self.isOpen = {};
        self.staff = {};
        self.dateOptions = {'starting-day': 1};
    
        $scope.$on('STAFF_LOADED', function(event, args) {
            self.loading = false;
            self.staff = args.staff;
        });

        // Load staffPhotoSrv so we can watch it
        self.staffPhotoSrv = staffPhotoSrv;
        
        $scope.$watch('staffPhotoSrv.photo', function () {
            if (self.staffPhotoSrv.photo !== undefined && $scope.staff.imageName !== undefined) {
                self.staff.imageName = self.staffPhotoSrv.photo;
            }
        });
        activate();

        function activate() {
            self.loading = true;
            load();
        }
        
        //Datepicker testing code
        //Remove this later
        self.popup1 = {};
        self.maxDate = new Date(2020, 5, 22);
        self.minDate = $scope.minDate ? null : new Date();
//        self.dateOptions = {
//            formatYear: 'yy',
//            startingDay: 1
//          };

        self.open1 = function() {
            self.popup1.opened = true;
          };
        
        self.openDatepicker = function (datepicker) {            
            self.isOpen[datepicker] = true;
        };
        //End of test code
        
        function load() {
            var id = document.getElementById('Staff_id').value;
            staffSrv.getRow(id).then(function (staff) {
                $scope.$broadcast('STAFF_LOADED', {staff: staff});
                $rootScope.$broadcast('STAFF_LOADED', {staff: staff});
            });            
        }
        
        self.save = function (object) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            staffSrv.save(object, formToken).then(function (staff) {
                document.getElementById('Staff_id').value = staff.id;
                $rootScope.$broadcast('STAFF_SAVED', {staff: staff});
            });
        };
    }
})();