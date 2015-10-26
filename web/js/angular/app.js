/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

(function () {
    var app = angular.module('staff', []);

    app.controller('StaffController', function () {
        this.items = staff;
    });

    var staff = [
        {
            name: 'Dave Meikle',
            id: '2',
            title: 'Software Architect',
            editable: true
        },
        {
            name: 'Mike Smith',
            id: '3',
            title: 'Designer',
            editable: true
        }
    ];

})();
