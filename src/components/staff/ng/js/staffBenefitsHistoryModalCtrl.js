//module.controller('staffBenefitsHistoryModalCtrl', function ($modalInstance,$scope, staffBenefits, staffBenefitsSrv) {
//    var self = this;
//    
//    self.staffBenefits = staffBenefits;
//    self.staff = {};
//    self.isOpen = {};
//    self.addingNew = false;
//
//    // datepicker stuffs
//    self.dateOptions = {'starting-day': 1};
//    
//    $scope.$on('BENEFITS_SAVED', function() {
//        self.addingNew = false;
//        self.close();
//    });
//    
//    self.openDatepicker = function (event) {
//        var datepicker = event.target.parentElement.dataset.datepickername;
//        self.isOpen[datepicker] = true;
//    };
//
//    self.toggleAddNewBenefits = function () {
//        self.addingNew = !self.addingNew;
//    };
//
//    self.saveNewBenefits = function (object) {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        object.Staff_id = document.getElementById('Staff_id').value;
//        
//        staffBenefitsSrv.save(object, formToken).then(function () {
//            $scope.$broadcast('BENEFITS_SAVED');            
//        });
//    };
//
//    self.close = function () {
//        $modalInstance.close();
//    };
//});

(function() {
    angular
        .module('staffAdmin')
        .controller('staffBenefitsHistoryModalCtrl', staffBenefitsHistoryModalCtrl);

    function staffBenefitsHistoryModalCtrl($uibModalInstance, $scope, staffBenefits, staffId, staffBenefitsSrv) {
        var self = this;
    
        self.staffBenefits = staffBenefits;
        self.staff = {};
        self.isOpen = {};
        self.addingNew = false;

        // datepicker stuffs
        self.dateOptions = {'starting-day': 1};

        $scope.$on('BENEFITS_SAVED', function() {
            self.addingNew = false;
            self.close();
        });

        self.openDatepicker = function (datepicker) {
            self.isOpen[datepicker] = true;
        };

        self.toggleAddNewBenefits = function () {
            self.addingNew = !self.addingNew;
        };

        self.save = function (object) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            
            object.id = staffId;
            staffBenefitsSrv.save(object, formToken).then(function () {
                $scope.$broadcast('BENEFITS_SAVED');            
            });
        };

        self.close = function () {
            $uibModalInstance.close();
        };
    }
})();