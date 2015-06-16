/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

(function() {
  
    var page = 0;
    var rows = 3;
    angular.module('staff', [])
        .controller('StaffController', function($scope, $http) {
            var staff = this;
            staff.items = [];
            $http.get("/admin/staff/rest/" + page + "/" + rows).success(function(response) {
                staff.items = response;
            });

            $scope.loadPage = function(selectedPage) {
                page = selectedPage;
                $http.get("/admin/staff/rest/" + page + "/" + rows).success(function(response) {
                staff.items = response;
            });
            }
        })
        .directive('paginationStart', function() {
            return {
              restrict: 'A',
              template: '<a class="" data-limit="" data-offset="" data-url="/admin/staff/rest/0/' + rows + '">&#171;</a>'
            };       
        })
        .directive('paginationList', function() {
            return {
                restrict: 'E',
                templateUrl: '/web/templates/components/staff/pagination.html',
                controller:function() {
                    var paginator = this;
                    paginator.items = [];
                    $http.get("/admin/staff/pagination/0/" + rows).success(function(response) {
                        staff.items = response;
                    });              
                }
            }
        })
        .directive('paginationEnd', function() {
            return {
              restrict: 'A',
              template: '<a class="" data-limit="" data-offset="" data-url="/admin/staff/rest/' + page + '/' + rows + '">&#187;</a>'
            };
          })
        .controller('PaginationController', function($scope, $http) {
            var pagination = this;
            pagination.rows = [];
            pagination.totalRows = 0;
            pagination.rowsPerPage = rows; // this should match however many results your API puts on one page
            getResultsPage(0);

            $scope.pagination = {
                current: 1
            };

            $scope.pageChanged = function(newPage) {
                getResultsPage(newPage);
            };

            function getResultsPage(pageNumber) {
                $http.get('/admin/staff/pagination/' + + pageNumber + '/' + rows )
                    .then(function(result) {
                        pagination.rows = result.data;
                        pagination.totalRows = result.data.length;
                    });
            }
        });

})();