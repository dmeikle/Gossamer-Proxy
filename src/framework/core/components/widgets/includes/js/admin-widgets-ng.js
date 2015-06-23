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
    angular.module('widgets', [])
        .controller('WidgetsController', function($scope, $http) {
            var widgets = this;
            widgets.items = [];
            $scope.editingData = [];
            
            $http.get("/super/widgets/" + page + "/" + rows).success(function(response) {
                widgets.items = response.Widgets;
            });

            $scope.loadPage = function(selectedPage) {
                page = selectedPage;
                $http.get("/super/widgets/" + page + "/" + rows).success(function(response) {
                widgets.items = response.Widgets;
            });
            }
            
            $scope.modify = function(widget){
                $scope.editingData[widget.id] = true;
            };
            
            $scope.update = function(widget){
                console.log(widget);


            var data ={};
            data.Widget = widget;
            data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;

            $.post('/super/widgets/' + widget.id, data);
                    $scope.editingData[widget.id] = false;

                };
        });


        
})();