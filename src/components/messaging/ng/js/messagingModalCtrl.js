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
        .module('messagingAdmin')
        .controller('messagingModalCtrl', messagingModalCtrl);

    function messagingModalCtrl(contact, claim, messagingSrv) {
        var self = this;

        self.sendMessage = function(message) {
            var package = {};
            package.Message = message;
            package.Contact = contact;
            package.Claim = claim;
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            
            messagingSrv.save(package, formToken);
        };
    }
})();