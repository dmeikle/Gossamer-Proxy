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
    .controller('ClaimLocationCommentsController', function($scope, $http) {
        var jobNumber = document.getElementById('claim_jobNumber').value;
        $scope.comments = {};
        
        $http.get("/admin/claims/locations/comments/" + jobNumber)
                     .success(function(response) {
                         $scope.comments = response.Comments;
                     });
                     
         ****************need to create object, add form values and token here **********************            
       $scope.saveComment = function(comment) {
           $http.post("/admin/claims/locations/comments/" + jobNumber, comment);
       };

    }) 
    .controller('OpenClaimsController', function($scope, $http) {
        
    }) 
    .controller('ClaimsController', function($scope, $http) {
       
        var offset = 0;
        var limit = 20;
        
        var claims = this;
        claims.claimsList = [];
           
        $http.get("/admin/claims/" + offset + '/' + limit)
                     .success(function(response) {
                         $scope.claimsList = response.Claims;
                     });
       

       
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