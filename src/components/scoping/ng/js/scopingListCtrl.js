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
        .module('scopingAdmin')
        .controller('scopingListCtrl', scopingListCtrl);

    function scopingListCtrl($scope, $uibModal, scopingSrv) {
        var self = this;
        var row = 0;
        var numRows = 20;
        
        self.loading = false;
        self.currentPage = 1;
        self.itemsPerPage = 20;
        self.previouslyClickedObject = {};
        self.selectedClaim = {};
        self.sidePanelLoading = false;
        self.sidePanelOpen = false;
        self.searching = false;
        
        $scope.$on('LOAD_COMPLETE', function() {
            self.loading = false;
            self.sidePanelLoading = false;
            self.searching = false;
        });
        
        activate();

        function activate() {
            getList();
        }
        
        function getList() {
            self.loading = true;
            scopingSrv.getList(row, numRows).then(function(response) {
                self.claimsList = response.data.Claims;
                self.totalItems = response.data.ClaimsCount[0].rowCount;
                self.loading = false;
            });
        }
        
        self.selectRow = function(clickedObject) {
            self.searching = false;
            if (self.previouslyClickedObject !== clickedObject) {
                self.previouslyClickedObject = clickedObject;
                self.selectedClaim = clickedObject;
                self.sidePanelLoading = true;
                self.sidePanelOpen = true;
                scopingSrv.getClaimLocations(clickedObject).then(function(response) {
                   self.selectedClaim.locations = response.data.ClaimsLocations;
                   $scope.$broadcast('LOAD_COMPLETE');
                });
            }
        };
        
        
        self.selectScopeWriter = function(claim) {

            var modalInstance = $uibModal.open({
                templateUrl: 'scopeWriterModal',
                controller: 'scopingWriterModalCtrl',
                size: 'lg',
                keyboard: false,
                backdrop: 'static',
                resolve: {
                    claim: function() {
                        return claim;
                    }
                }
            });
        };
    }
})();