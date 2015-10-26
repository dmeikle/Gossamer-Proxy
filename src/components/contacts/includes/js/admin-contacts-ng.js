/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


(function () {


    angular.module('contacts', [])
            .controller('ContactsController', function ($scope, $http) {

            })
            .controller('ClaimContactsController', function ($scope, $http) {
                var jobNumber = document.getElementById('claim_jobNumber').value;
                var claimContacts = this;
                claimContacts.contacts = [];


                $.get("/admin/contacts/claim/" + jobNumber)
                        .success(function (response) {
                            claimContacts.contacts = response.ClaimContacts;
                        });


            })
            ;
})();