/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

(function () {


    angular.module('tickets', [])
            .controller('ticketsCtrl', function ($scope, $http) {
                $http.get("/admin/tickets/opencount")
                        .success(function (response) {
                            $scope.count = response.numRows;
                        });
            });

})();