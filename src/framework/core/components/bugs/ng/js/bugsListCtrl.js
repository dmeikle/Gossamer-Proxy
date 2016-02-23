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
        .module('bugsAdmin')
        .controller('bugsListCtrl', bugsListCtrl);

    function bugsListCtrl($rootScope, $scope, bugsSrv, $log, tablesSrv) {
        var self = this;
        
        // Stuff to run on controller load
        self.itemsPerPage = 20;
        self.currentPage = 1;
        self.sidePanelOpen = false;
        self.loading = false;
        
        row = ((self.currentPage - 1) * self.itemsPerPage);
        var numRows = self.itemsPerPage;
        
        $rootScope.$on('INVALIDATE_BUGS_LIST', function() {
            activate();
        });
        
        // Load up the table service so we can watch it!
        $scope.tablesSrv = tablesSrv;

        $scope.$watch('tablesSrv.sortResult', function () {
            if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
//                console.log(tablesSrv.sortResult);
//                self.bugList = angular.copy(tablesSrv.sortResult.Bugs);
//                self.loading = false;
//                self.test = 'lol';
//                $scope.$digest();
            }
        });
        
//        $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.AccountingCashReceipts'], function () {
//            self.grouped = tablesSrv.grouped;
//            if (self.grouped === true) {
//                if (tablesSrv.groupResult && tablesSrv.groupResult.Bugs)
//                    self.bugList = tablesSrv.sortResult.Bugs;
//                    self.loading = false;
//            } else if (self.grouped === false) {
//                activate();
//            }
//        });
        
        activate();

        function activate() {
            self.loading = true;
            bugsSrv.getList(row, numRows).then(function(response) {
                self.bugList = response.data.Bugs;
                self.bugListCount = response.data.Bugs[0].rowCount;
                self.loading = false;
            });
        }
        
        self.search = function(keywords) {
            self.loading = true;
            bugsSrv.search(keywords).then(function(response) {
                self.bugList = response.data.Bugs;
                self.bugListCount = response.data.Bugs[0].rowCount;
                self.loading = false;
            });
        };
        
        self.openAdvancedSearch = function() {
            self.sidePanelOpen = true;
        };
        
        self.closeSidePanel = function() {
            self.sidePanelOpen = false;
        };
        
        self.selectRow = function(bug) {
//            $log.log(bug);
            self.selectedRow = bug;
            self.sidePanelOpen = true;
            self.selectedBug = bug;
        };
    }
})();