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
        .controller('bugsEditCtrl', bugsEditCtrl);

    function bugsEditCtrl($rootScope, bugsSrv, dataService) {
        var self = this;
        
        self.bug = angular.copy(dataService.data);
        self.display = false;
        
        self.displayForm = function() {
          self.display = true;  
        };
        
        self.cancel = function() {
            self.display = false;
        };
        
//        self.saveNew = function(bug) {
//            bug.BugTypes_id = 1;
//            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//            self.savingNew = true;
//            self.bugSubmitted = false;
//            bugsSrv.save(bug, formToken).then(function() {
////                init();       
//                self.newBug = {};
//                self.savingNew = false;
//                self.bugSubmitted = true;
//                $rootScope.$broadcast('INVALIDATE_BUGS_LIST');
//            });
//        };
        
        self.save = function(bug) {
            bug.BugTypes_id = 1;
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            self.saving = true;
            bugsSrv.save(bug, formToken).then(function() {
                init();
                $rootScope.$broadcast('INVALIDATE_BUGS_LIST');
            });
        };
        
        self.loadBug = function(id) {
            bugSrv.getRow(id).then(function(response) {
                self.bug = response.data.Bug;
            });
        };
        
        function init() {
            //self.bug = {};  
            self.display = false;
            self.saving = false;
        }
    }
})();