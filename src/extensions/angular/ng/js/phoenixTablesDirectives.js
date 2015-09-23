module.directive('columnSortable', function($compile, $location) {
  return {
    restricted:'A',
    scope:false,
    link: function(scope, element, attrs) {
      var a = document.createElement('a');
      a.setAttribute('ng-click', 'sortByColumn($event)');
      a.setAttribute('href', '');
      a.innerText = element[0].innerText;
      element[0].innerHTML = '';

      var clear = document.createElement('a');
      clear.setAttribute('ng-click', 'clearSort()');
      clear.setAttribute('href', '');
      clear.setAttribute('class', 'pull-right glyphicon');
      clear.setAttribute('ng-class', "{'glyphicon-remove': sortedBy ==='" + element[0].dataset.column + "'}");
      element[0].appendChild(a);
      element[0].appendChild(clear);
      $compile(element.contents())(scope);
    },
    controller: function($scope, tablesSrv) {
      $scope.sorting = {};
      $scope.sortedBy = {};

      var a = document.createElement('a');
      a.href = $location.absUrl();
      var apiPath;
      if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
      } else {
        apiPath = a.pathname.slice(0, -1);
      }
      $scope.sortByColumn = function(event) {
        $scope.loading = true;
        var column = event.target.parentElement.dataset.column;
        $scope.sortedBy = column;
        if (!$scope.sorting[column] || $scope.sorting[column] === 'desc') {
          $scope.sorting[column] = 'asc';
        } else {
          $scope.sorting[column] = 'desc';
        }
        tablesSrv.sortByColumn(column, $scope.sorting[column], apiPath);
      };

      $scope.clearSort = function() {
        $scope.loading = true;
        $scope.sortedBy = undefined;
        tablesSrv.clearSort(apiPath);
      };
    }
  };
});
