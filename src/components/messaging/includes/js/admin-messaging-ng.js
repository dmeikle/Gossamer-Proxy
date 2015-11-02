/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

(function () {


    angular.module('messaging', [])
            .controller('MessagingController', function ($scope, $http) {
                var ctrl = this;
                ctrl.messages = [];
                ctrl.rowCount = 0;
                var limit = 20;
                var offset = 0;

                $http.get('/admin/messaging/' + offset + '/' + limit).success(function (data) {
                    $scope.messages = data.Messages;
                    $scope.rowCount = data.MessagesCount[0].rowCount;
                });

                $scope.viewMessage = function (id) {
                    window.location = '/admin/messaging/' + id;
                }

                $scope.rowClass = function (message) {
                    if (message.viewDate == null) {
                        return 'email-status-unread';
                    }
                };
            })
            .controller('FoldersController', function ($scope, $http) {
                var ctrl = this;
                ctrl.inboxCount = '';
                ctrl.starredCount = '';
                ctrl.trashCount = '';

                $http.get('/admin/messaging/folderstats').success(function (data) {
                    $scope.inboxCount = (data.folderCounts[0].inboxCount > 0) ? data.folderCounts[0].inboxCount : '';
                    $scope.starredCount = (data.folderCounts[0].starredCount > 0) ? data.folderCounts[0].starredCount : '';
                    $scope.trashCount = (data.folderCounts[0].trashCount > 0) ? data.folderCounts[0].trashCount : '';
                });
            })
            .controller('ReplyController', function ($scope, $http) {
                $scope.sendReply = function (message) {
                    var data = {};
                    data.Message = message;
                    console.log(message);
                    return;
                    data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;

                    $.post('/admin/messaging/reply', data);
                };

                $scope.sendMessage = function (message) {

                    var data = {};
                    data.Message = message;
                    data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;

                    $.post('/admin/messaging/compose', data);
                };
            })
            .controller('MessageController', function ($scope, $http) {
                var ctrl = this;
                ctrl.message = {};

                $scope.init = function (id) {
                    $http.get('/admin/messaging/view/' + id).success(function (data) {
                        $scope.message = data.Message[0];
                    });
                };
            });

})();