module.directive('columnSortable', function($compile, $location) {
  return {
    restricted:'A',
    scope:false,
    link: function(scope, element, attrs) {
      var a = document.createElement('a');
      a.setAttribute('ng-click', 'sortByColumn($event)');
      a.innerText = element[0].innerText;
      element[0].innerHTML = '';

      var clear = document.createElement('a');
      clear.setAttribute('ng-click', 'clearSort()');
      clear.setAttribute('class', 'clear-sort');
      element[0].appendChild(a);
      element[0].appendChild(clear);
      $compile(element.contents())(scope);
    },
    controller: function($scope, tablesSrv) {
      $scope.sorting = {};

      var a = document.createElement('a');
      a.href = $location.absUrl();
      var apiPath = a.pathname;
      $scope.sortByColumn = function(event) {
        if (!$scope.sorting[event.target.innerText] || $scope.sorting[event.target.innerText] === 'desc') {
          $scope.sorting[event.target.innerText] = 'asc';
        } else if ($scope.sorting[event.target.innerText] === 'asc') {
          $scope.sorting[event.target.innerText] = 'desc';
        }
        tablesSrv.sortByColumn(event.target.innerText, $scope.sorting[event.target.innerText], apiPath);
      };

      $scope.clearSort = function() {
        tablesSrv.clearSort(apiPath);
      };
    }
  };
});
