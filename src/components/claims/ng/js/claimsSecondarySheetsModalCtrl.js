
(function() {

    angular
        .module('claimsAdmin')
        .controller('secondarySheetsModalCtrl', secondarySheetsModalCtrl);

    function secondarySheetsModalCtrl($uibModalInstance) {
        var self = this;

	self.save = function(items) {
            $uibModalInstance.close(items);
	};
        
	self.cancel = function() {
            $uibModalInstance.dismiss();
	};
    }
})();