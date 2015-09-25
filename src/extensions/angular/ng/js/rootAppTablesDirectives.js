module.directive('columnSortable', function($compile, $location) {
  return {
    restricted: 'A',
    scope: false,
    link: function(scope, element, attrs) {
      var a = document.createElement('a');
      a.setAttribute('ng-click', 'sortByColumn($event)');
      a.setAttribute('href', '');
      a.appendChild(document.createElement('span'));
      a.children[0].innerText = element[0].innerText + ' ';
      a.appendChild(document.createElement('span'));
      a.children[1].setAttribute('class', 'glyphicon glyphicon-sort');
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
        var column = event.target.parentElement.parentElement.dataset.column;
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

module.directive('sortByButton', function(rootTemplateSrv, $http, $compile) {
  return {
    restrict: 'A',
    scope: false,
    transclude: true,
    link: function(scope, element, attrs) {
      var buttonDOM = document.createElement('div');
      buttonDOM.setAttribute('class', 'dropdown');
      buttonDOM.innerHTML = '<button class="btn-default" data-toggle="dropdown"><span class="glyphicon glyphicon-magnet"></span></button>';
      buttonDOM.innerHTML += '<ul class="dropdown-menu pull-right"></ul>';

      var columns = [];
      for (var th in element[0].parentElement.children) {
        if (element[0].parentElement.children.hasOwnProperty(th) &&
          element[0].parentElement.children[th].className.indexOf('cog-col') === -1) {
          columns.push(element[0].parentElement.children[th]);
        }
      }

      for (var column in columns) {
        if (columns.hasOwnProperty(column)) {
          var li = document.createElement('li');
          var a = document.createElement('a');
          a.setAttribute('ng-click', 'groupBy(' + columns[column].dataset.column + ')');
          a.innerText = columns[column].innerText;
          li.appendChild(a);
          buttonDOM.getElementsByClassName('dropdown-menu')[0].appendChild(li);
        }
      }

      var ul = buttonDOM.getElementsByClassName('dropdown-menu')[0];

      ul.appendChild(document.createElement('li'));
      ul.children[ul.children.length - 1].appendChild(document.createElement('a'));
      ul.children[ul.children.length - 1].children[0].setAttribute('ng-click', 'clearGrouping()');
      ul.children[ul.children.length - 1].children[0].appendChild(document.createElement('span'));
      ul.children[ul.children.length - 1].children[0].children[0].setAttribute('class', 'glyphicon glyphicon-remove');

      element[0].appendChild(buttonDOM);
      $compile(element.contents())(scope);
    },
    controller: function($scope, $location, tablesSrv) {
      var a = document.createElement('a');
      a.href = $location.absUrl();
      var apiPath;
      if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
      } else {
        apiPath = a.pathname.slice(0, -1);
      }

      $scope.groupBy = function(columnName) {
        $scope.loading = true;
        tablesSrv.groupBy(apiPath, columnName);
      };

      $scope.clearGrouping = function() {
        tablesSrv.clearGrouping();
      };
    }
  };
});
