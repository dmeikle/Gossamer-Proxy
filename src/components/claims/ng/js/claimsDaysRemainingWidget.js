    /* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    
(function() {
//    'use strict';

    angular
        .module('claimsAdmin')
        .controller('claimsDaysRemainingCtrl', claimsDaysRemainingCtrl);

    function claimsDaysRemainingCtrl(claimsEditSrv, $rootScope) {
        var vm = this;
        vm.claimLoading = true;
        
        $rootScope.$on('claimDetailsLoaded', function() {
            vm.daysRemainingInClaimPhase = Math.abs(claimsEditSrv.claimDetails.phase.numDays); //convert to positive regardless of value
            vm.pastDue = claimsEditSrv.claimDetails.phase.numDays < 0;
            vm.phaseTitle = claimsEditSrv.claimDetails.phase.title;
            vm.startDate = claimsEditSrv.claimDetails.phase.startDate;
            vm.scheduledEndDate = claimsEditSrv.claimDetails.phase.scheduledEndDate;
            vm.claimLoading = false;
        });
    }
})();