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
        
        $scope.$on('secondary_sheet_loaded', function(event, args) {
           for(var index in args.secondarySheet) {
               var userResponse = args.secondarySheet[index];
               console.log(userResponse);
               self.secondarySheet.item[3].isDone = userResponse.isDone;
               self.secondarySheet.item[3].id = userResponse.id;
              // secondarySheet.item[userResponse.AffectedAreaActions_id].
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
