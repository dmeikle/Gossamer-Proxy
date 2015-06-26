/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */



(function() {
    
   
  angular.module('claims', [])
    
    .controller('OpenClaimsController', function($scope, $http) {
        
    })
    .controller('NewClaimsController', function($scope, $http) {

    })
    
    .directive('openClaimsCount', function($http) {
      
         return {
            restrict: 'E',
            replace: true,
            template: '<span>{{openCount}}</span>',
                controller:function($scope) {
                    $http.get("/admin/claims/opencount")
                        .success(function(response) {
                            $scope.openCount = response.ClaimsCount[0].rowCount;
                        });           
                }
          };       
    })
    .directive('newClaimsCount', function($http) {
      
         return {
            restrict: 'E',
            replace: true,
            template: '<span>{{newCount}}</span>',
                controller:function($scope) {
                    $http.get("/admin/claims/newcount/3")
                        .success(function(response) {
                            $scope.newCount = response.ClaimsCount[0].rowCount;
                        });             
                }
          };      
    });
    
    

})();