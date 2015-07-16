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
                     
          
       $scope.saveComment = function(comment) {
           var data = {};
           var jobNumber = document.getElementById('claim_jobNumber').value;
           
           comment.Claims_id = document.getElementById('claim_Claims_id').value;
           comment.ClaimsLocation_id = document.getElementById('claim_ClaimsLocation_id').value;
           
           data.ClaimLocationComment = comment;
           data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
           
           $.post("/admin/claims/locations/comments/" + jobNumber, data);
       };

    }) 
    .controller('ClaimCommentsController', function($scope, $http) {
        var jobNumber = document.getElementById('claim_jobNumber').value;
        $scope.comments = {};
        
        $http.get("/admin/claims/comments/" + jobNumber)
                     .success(function(response) {
                         $scope.comments = response.Comments;
                     });
                     
          
       $scope.saveComment = function(comment) {
           var data = {};
           var jobNumber = document.getElementById('claim_jobNumber').value;
           
           comment.Claims_id = document.getElementById('claim_Claims_id').value;
           
           data.ClaimComment = comment;
           data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
           
           $.post("/admin/claims/comments/" + jobNumber, data);
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
    .controller('ClaimPhotosController', function($scope, $http) {
        var imageList = this;
        imageList.items = [];
        
        $scope.editingData = [];

        var jobNumber = document.getElementById('claim_jobNumber').value;
        
        $http.get("/admin/claim/photos/list/" + jobNumber).success(function(response) {
            imageList.items = response.photos;           
        });


        $scope.modify = function(photo){
            $scope.editingData[photo.id] = true;
        };

        $scope.update = function(photo){
            console.log(photo);

            var data ={};
            data.Photo = photo;
            data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;

            $.post('/super/widgets/' + widget.id, data);
                $scope.editingData[widget.id] = false;
        };
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
    })
    .directive('photosCount', function($http) {
        var jobNumber = document.getElementById('claim_jobNumber').value;

         return {
            restrict: 'E',
            replace: true,
            template: '<a href="/admin/claims/photos/' + jobNumber + '">{{newCount}}</a>',
                controller:function($scope) {
                    $http.get("/admin/claims/photocount/" + jobNumber)
                        .success(function(response) {
                            console.log(response);
                            $scope.newCount = response.ClaimsCount[0].rowCount;
                        });             
                }
          };      
    });
    
    

})();