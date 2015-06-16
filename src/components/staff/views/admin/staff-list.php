
<!--- javascript start --->
    
    @components/staff/includes/js/admin-staff-list-ng.js

<!--- javascript end --->


<div class="block">
    <div class="block-heading">
        <div class="main-text h2">
            Staff List
        </div>
        <div class="block-controls">
            <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
            <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
        </div>
    </div>
    <div class="block-content-outer" style="display: block">
        <div class="block-content-inner">
            <div class="table-responsive">
                <table ng-controller="StaffController as manager" cstalass="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</div>
                            <th>Title</div>
                            <th>Ext</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Last Login</th> 
                            <th>cog</th>    
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="staff in manager.items" >
                            <td class="col-xs-2 col-md-2 col-lg-2"><a href="mailto:{{staff.email}}">{{staff.lastname}}, {{staff.firstname}}</a></td>
                            <td class="col-xs-2 col-md-2 col-lg-2">{{staff.title}}</td> 
                            <td class="col-xs-1 col-md-1 col-lg-1">{{staff.telephone}}</td>  
                            <td class="col-xs-2 col-md-2 col-lg-2">{{staff.mobile}}</td>  
                            <td class="col-xs-1 col-md-1 col-lg-1">{{staff.status}}</td>     
                            <td class="col-xs-2 col-md-2 col-lg-2">{{staff.lastLogin}}</td>  
                            <td><button ng-show="staff.editable">Edit</button> </td>
                        </tr>
                    </tbody>
                </table>
                

                    <ul class="pagination" ng-controller="PaginationController as paginator" style="margin: 0">
                        <li pagination-start></li>
                        <li ng-repeat="row in paginator.rows"> 
                            <a ng-click="manager.loadPage(2)" class=" {{ row.current}}" data-limit="{{ row.limit}}" data-offset="{{ row.offset}}" data-url="/admin/staff/rest/{{$index}}/{{ paginator.rowsPerPage}}">{{ $index + 1}}</a>
                        </li>  
                        <li pagination-end></li>
                    </ul>
                    <dir-pagination-controls on-page-change="paginator.pageChanged(newPageNumber)"></dir-pagination-controls>
                
            </div>
        </div>
    </div>

</div>

<script language="javascript">
    
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
    
    </script>
    