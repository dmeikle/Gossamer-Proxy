(function() {
    'use strict';

    angular
        .module('rootApp')
        .directive('loadingSpinner', loadingSpinner);

    /* @ngInject */
    function loadingSpinner() {

        var directive = {
            bindToController: true,
            template: '<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/></svg></div>',
            controller: controller,
            controllerAs: 'vm',
//            link: link,
            restrict: 'E',
            scope: {
            }
        };
        
        return directive;

//          
    }

    /* @ngInject */
    function controller() {

    }
})();

