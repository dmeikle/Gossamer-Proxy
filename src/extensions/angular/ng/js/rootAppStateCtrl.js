(function() {
    /* jshint validthis: true */
    'use strict';

    angular
        .module('rootApp')
        .controller('StateCtrl', StateCtrl);

    function StateCtrl($rootScope) {
        var vm = this;
        vm.test = 'this is a test';
        
        activate();

        function activate() {

        }
        
//        $rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState, fromParams) {
//            console.log('state changed!');
//            vm.loading = true;
//        });
//        
//        $rootScope.$on('$stateChangeSuccess', function(e, toState, toParams, fromState, fromParams) {
//            console.log('state change success!');
//            vm.loading = false;
//        });
    }
})();