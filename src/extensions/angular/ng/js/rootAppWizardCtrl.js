(function() {
    'use strict';

    angular
        .module('rootApp')
        .controller('rootAppWizardCtrl', rootAppWizardCtrl);

    function rootAppWizardCtrl($scope) {
//        var vm = this;
//
//        activate();
//
//        function activate() {
//
//        }
        $scope.wizardLoading = false;
        $scope.currentPage = 0;
        var wizard = document.getElementsByTagName('wizard')[0];

        $scope.nextPage = function() {
            $scope.currentPage = $scope.currentPage + 1;
        };

        $scope.prevPage = function() {
            $scope.currentPage = $scope.currentPage - 1;
        };
    }
})();