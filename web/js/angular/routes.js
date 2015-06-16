/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


angular.module('MainApp')
        .config(
        ['$routeProvider', function($routeProvider) {
                $routeProvider.when('/admin/staff', {
                    templateUrl: '/components/staff/views/index.html',
                    action: 'StaffApp.StaffCtrl'
                });
        }]);
    