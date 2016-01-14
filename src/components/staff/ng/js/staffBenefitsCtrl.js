


(function () {
    
    angular
            .module('staffAdmin')
            .controller('staffBenefitsCtrl', staffBenefitsCtrl);
    
    function staffBenefitsCtrl($rootScope, $scope, $modal, staffBenefitsSrv) {
        var self = this;
        
        self.staffLoaded = false;
        
        $rootScope.$on('STAFF_LOADED', function(event, args) {
            if(self.staffBenefits === undefined) {
                self.staffLoaded = true;
                loadBenefits(args.staff);
            }
        });
        
        
        $scope.$on('STAFFBENEFITS_LOADED', function(event, args) {
            self.staffBenefits = args.staffBenefits;
        });
        
        function loadBenefits(staff) {
            staffBenefitsSrv.getStaffBenefits(staff).then(function(benefits) {
                $scope.$broadcast('STAFFBENEFITS_LOADED', {staffBenefits: benefits});
            });            
        }
        
      
        self.openAddNewBenefitsModal = function () {
            
            var modalInstance = $modal.open({
                templateUrl: 'addNewBenefit',
                controller: 'staffBenefitsHistoryModalCtrl as ctrl',
                size: 'lg',
                resolve: {
                    staffBenefits: function () {
                        return self.staffBenefits;
                    }
                }
            });

            modalInstance.result.then(function () {
                getStaffBenefits();
            });
        };
    }
})();


//
//
////module.controller('staffBenefitsCtrl', function ($scope, $location, $modal, staffBenefitsSrv, staffTemplateSrv) {
//    // stuff to run on controller load
//    $scope.staffBenefitsLoading = true;
//    getStaffBenefits();
//
//    function getStaffBenefits() {
//        var object = {};
//        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
//
//        staffBenefitsSrv.getStaffBenefits(object).then(function () {
//            $scope.staffBenefits = staffBenefitsSrv.staffBenefits;
//            $scope.staffBenefitsLoading = false;
//        });
//    }
//
//    $scope.openStaffBenefitsHistoryModal = function () {
//        var template = staffTemplateSrv.staffBenefitsHistoryModal;
//        var modalInstance = $modal.open({
//            templateUrl: template,
//            controller: 'staffBenefitsHistoryModalCtrl',
//            size: 'lg',
//            resolve: {
//                staffBenefits: function () {
//                    return $scope.staffBenefits;
//                }
//            }
//        });
//
//        modalInstance.result.then(function () {
//            getStaffBenefits();
//        });
//    };
//});
//
//module.controller('staffBenefitsHistoryModalCtrl', function ($modalInstance, $scope, $location, staffBenefits, staffBenefitsSrv) {
//    $scope.staffBenefits = staffBenefits;
//    $scope.staff = {};
//    $scope.isOpen = {};
//    $scope.addingNew = false;
//
//    // datepicker stuffs
//    $scope.dateOptions = {'starting-day': 1};
//    $scope.openDatepicker = function (event) {
//        var datepicker = event.target.parentElement.dataset.datepickername;
//        $scope.isOpen[datepicker] = true;
//    };
//
//    $scope.toggleAddNewBenefits = function () {
//        if ($scope.addingNew === true) {
//            $scope.addingNew = false;
//        } else {
//            $scope.addingNew = true;
//        }
//    };
//
//    $scope.saveNewBenefits = function (object) {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
//
//        staffBenefitsSrv.save(object, formToken).then(function () {
//            $scope.addingNew = false;
//            var object = {};
//            object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
//
//            staffBenefitsSrv.getStaffBenefits(object).then(function () {
//                $scope.staffBenefits = staffBenefitsSrv.staffBenefits;
//            });
//        });
//    };
//
//    $scope.close = function () {
//        $modalInstance.close();
//    };
//});
