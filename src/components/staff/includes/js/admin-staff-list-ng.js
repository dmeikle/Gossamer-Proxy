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
    var rows = 10;
    angular.module('staff', [])
        .controller('CredentialsController', function($scope, $http) {
            $scope.authorization = {};
            $scope.usernameExistsClass = '';
            $scope.isUsernameExists = false;
            
            $scope.checkUsernameExists = function(authorization) {
                
                if(authorization.username.length < 4) {
                    return;
                }
                $.get('/admin/staff/checkusername/0/' + authorization.username).success(function(data) {
                    if(data.exists === "true") {
                        $scope.usernameExistsClass = ' has-feedback has-error';
                        $scope.isUsernameExists = true;
                    } else {
                        $scope.isUsernameExists = '';
                        $scope.isUsernameExists = false;
                    }
                });
            };
            
            $scope.saveCredentials = function(authorization) {
                var id = document.getElementById('Staff_id').value;
                var data ={};
                data.StaffAuthorization = authorization;
                data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
                
                $.post('/admin/staff/credentials/' + id, data).success(function(data) {
                    if('true' != data.success) {
                        //do something
                    }
                });
            };
            
            $scope.clearErrors = function() {
               
                $scope.isUsernameExists = '';
                $scope.isUsernameExists = false;
            }
        })
        
        .directive('ngUnique', ['$http', function (async) {
            return {
                require: 'ngModel',
                link: function (scope, elem, attrs, ctrl) {

                    elem.on('blur', function (evt) {
                        scope.$apply(function () {                   
                            var val = elem.val();
                          
                            var ajaxConfiguration = { method: 'GET', url: '/admin/staff/checkusername/0/' + val };
                            async(ajaxConfiguration)
                                .success(function(data, status, headers, config) { 
                                    if(data.exists === "true") {
                                        ctrl.$setValidity('unique', 'true');
                                    } else {
                                        ctrl.$setValidity('unique', 'false');
                                    }
                                });
                        });
                    });
                }
            }
        }])
        .controller('EditStaffController', function($scope, $http) {
            
            $scope.savePersonal = function(staff) {
                if(staff.id === undefined) {
                    staff.id = 0;
                }
                var data ={};
                data.Staff = staff;
                data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
                $.post('/admin/staff/' + staff.id, data).success(function(data) {
                    console.log(data.Staff);
                document.getElementById('Staff_id').value = data.Staff.Staff[0].id;
                });

            };
            
            $scope.saveEmployment = function(staff) {
                alert('here');
                var id = document.getElementById('Staff_id').value;
                
                var data ={};
                data.Staff = staff;
                data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
                $.post('/admin/staff/' + id, data);
            }
        })
        .controller('StaffRolesController', function($scope, $http) {
            $scope.rolesList = {};
    
            $scope.saveRoles = function(roles) {   
                var id = document.getElementById('Staff_id').value;
                var data = {};
                data.StaffAuthorization = roles;
                data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
                $.post('/admin/staff/permissions/' + id, data);

            };
            
        })
        .controller('StaffController', function($scope, $http) {
            var staff = this;
            staff.items = [];
            staff.user = [];
            
            $http.get("/admin/staff/" + page + "/" + rows).success(function(response) {
                staff.items = response;
            });

            $scope.loadPage = function(selectedPage) {
                page = selectedPage;
                $http.get("/admin/staff/" + page + "/" + rows).success(function(response) {
                    staff.items = response;
                });
            }
            
            $scope.edit = function(id) {
                $http.get("/admin/staff/" + id).success(function(response) {
                    staff.user = response.Staff;
                    console.log(staff.user);
                });
            };
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