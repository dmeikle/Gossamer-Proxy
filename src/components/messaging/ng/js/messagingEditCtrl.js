    /* 
     *  This file is part of the Quantum Unit Solutions development package.
     * 
     *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
     * 
     *  For the full copyright and license information, please view the LICENSE
     *  file that was distributed with this source code.
     */
    
    
(function() {
    //'use strict';

    angular
        .module('messagingAdmin')
        .controller('messagingEditCtrl', messagingEditCtrl);

    function messagingEditCtrl($rootScope, $uibModal) {
        var self = this;
        self.messagePanes = [];
        
        $rootScope.$on('PAGE_LOADED', function() {
            loadNewMessages();
        });
        
        self.showMessagePane = function(contact, claim) {
            self.modalLoading = true;
            var template = 'messagePaneModal';
            var modal = $uibModal.open({
                templateUrl: template,
                controller: 'messagingModalCtrl',
                controllerAs: 'modalCtrl',
                size: 'lg',
                resolve: {
                        contact: function() {
                            return contact;
                        },                        
                        claim: function() {
                            return claim;
                        }
                    }
            });
            modal.opened.then(function() {
                self.modalLoading = false;
            });
            modal.result.then(function() {
//                claimsEditSrv.save(claim).then(function () {
//                    getClaimDetails();
//                });
            });
        };
        
        function loadNewMessages() {
            //this will use a websocket connection
        }
    }
})();