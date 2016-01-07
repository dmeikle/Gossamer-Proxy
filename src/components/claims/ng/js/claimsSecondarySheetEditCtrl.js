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
        .module('claimsAdmin')
        .controller('claimsSecondarySheetEditCtrl', claimsSecondarySheetEditCtrl);

    function claimsSecondarySheetEditCtrl($scope, claimsSecondarySheetsSrv) {
        var self = this;
        self.secondarySheet = {};
        self.secondarySheet.item = [];
        self.test = {};
        
        
        $scope.$on('secondary_sheet_loaded', function(event, args) {
            for(var i in args.secondarySheet) {
                self.secondarySheet.item[args.secondarySheet[i].AffectedAreaActions_id] = args.secondarySheet[i];
            }
        });
        
        activate();

        function activate() {
            var secondarySheet = {};
            secondarySheet.Claims_id = document.getElementById('Claims_id').value;
            secondarySheet.ClaimsLocations_id = document.getElementById('ClaimsLocations_id').value;
            secondarySheet.AffectedAreas_id = document.getElementById('AffectedAreas_id').value;
            secondarySheet.SecondarySheets_id = document.getElementById('SecondarySheets_id').value;
            
            claimsSecondarySheetsSrv.getResponses(secondarySheet).then(function(response) {
                $scope.$broadcast('secondary_sheet_loaded', { secondarySheet: response.secondarySheetResponses} );
            });
            
            
        }
        
    }
})();
