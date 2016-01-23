module.directive('columnSortable', function($compile, $location) {
    return {
        restricted: 'A',
        scope: false,
        link: function(scope, element, attrs) {
            var a = document.createElement('a');
            a.setAttribute('ng-click', 'sortByColumn($event)');
            a.setAttribute('href', '');
            a.setAttribute('class', 'table-header-sortable');
            a.setAttribute('ng-class', "{'underlined':sortedBy === '" + element[0].dataset.column + "'}");
            a.appendChild(document.createElement('span'));
            a.children[0].textContent = element[0].textContent + ' ';
            a.appendChild(document.createElement('span'));
            a.children[1].setAttribute('class', 'small glyphicon');
            a.children[1].setAttribute('ng-class',
                "{'glyphicon-sort-by-attributes':sortedBy === '" + element[0].dataset.column +
                "' && sorting['" + element[0].dataset.column + "'] === 'asc', " +
                "'glyphicon-sort-by-attributes-alt':sortedBy === '" + element[0].dataset.column +
                "' && sorting['" + element[0].dataset.column + "'] === 'desc'}");
            element[0].textContent = '';

            var clear = document.createElement('a');
            clear.setAttribute('ng-click', 'clearSort()');
            clear.setAttribute('href', '');
            clear.setAttribute('class', 'pull-right small glyphicon');
            clear.setAttribute('ng-class', "{'glyphicon-remove clear-sort': sortedBy ==='" + element[0].dataset.column + "'}");
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
                column = event.target.parentElement.parentElement.dataset.column;
                $scope.sortedBy = column;
                if (!$scope.sorting[column] || $scope.sorting[column] === 'desc') {
                    $scope.sorting[column] = 'asc';
                } else {
                    $scope.sorting[column] = 'desc';
                }

                var columns = [];
                if ($scope.grouped === true) {
                    columns.push($scope.groupedBy);
                }
                columns.push(column);

                tablesSrv.sortByColumn(apiPath, columns, $scope.sorting[column]);
            };

            $scope.clearSort = function() {
                $scope.loading = true;
                $scope.sorting[$scope.sortedBy] = undefined;
                var groupedBy = $scope.groupedBy;
                $scope.sortedBy = undefined;
                tablesSrv.clearSort(apiPath, $scope.groupedBy);
            };
        }
    };
});
//console.log('this is a test!');
module.directive('groupByButton', function(rootTemplateSrv, $http, $compile) {
    console.log('this is a test!!!!!!');
    return {
        restrict: 'A',
        scope: false,
        transclude: true,
        link: function(scope, element, attrs) {
            console.log('this is a test!');
            var buttonDOM = document.createElement('div');
            buttonDOM.setAttribute('class', 'dropdown');
            buttonDOM.innerHTML = '<button class="btn-default" data-toggle="dropdown"><span class="glyphicon glyphicon-magnet"></span></button>';
            buttonDOM.innerHTML += '<ul class="dropdown-menu pull-right"></ul>';

            var columns = [];
            for (var th in element[0].parentElement.children) {
                console.log(th);
                if (element[0].parentElement.children.hasOwnProperty(th) &&
                    element[0].parentElement.children[th].className.indexOf('cog-col') === -1) {
                    columns.push(element[0].parentElement.children[th]);
                }
            }

            for (var column in columns) {
                if (columns.hasOwnProperty(column)) {
                    var li = document.createElement('li');
                    var a = document.createElement('a');
                    a.setAttribute('ng-click', 'groupBy("' + columns[column].dataset.column + '")');
                    a.textContent = columns[column].textContent;
                    li.appendChild(a);
                    buttonDOM.getElementsByClassName('dropdown-menu')[0].appendChild(li);
                }
            }

            var ul = buttonDOM.getElementsByClassName('dropdown-menu')[0];

            ul.appendChild(document.createElement('li'));
            ul.children[ul.children.length - 1].setAttribute('class', 'divider');
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

            var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
            var numRows = $scope.itemsPerPage;

            $scope.groupBy = function(columnName) {
                $scope.loading = true;
                $scope.groupedBy = columnName;
                tablesSrv.groupBy(apiPath, columnName, row, numRows);
            };

            $scope.clearGrouping = function() {
                $scope.groupedBy = undefined;
                tablesSrv.clearGrouping();
            };
        }
    };
});

module.directive('multiSelect', function($compile) {
    return {
        restrict: 'A',
        scope: false,
        link: function(scope, element, attrs) {
            var checkTd = angular.element(document.createElement('td'));
            checkTd[0].appendChild(document.createElement('input'));
            checkTd[0].children[0].setAttribute('type', 'checkbox');
            checkTd[0].children[0].setAttribute('ng-model', attrs.multiSelect + '.multi');
            checkTd[0].children[0].setAttribute('ng-change', 'toggleMulti(' + attrs.multiSelect + ')');

            element[0].insertBefore(checkTd[0], element[0].firstElementChild);

            $compile(element.contents())(scope);
            if (scope.$last) {
                scope.$parent.repeatWith = attrs.multiSelect;
                scope.$parent.table = element[0].parentElement.parentElement;
                scope.$emit('lastRepeat');
            }
        },
        controller: function($scope, $rootScope, tablesSrv) {
            var pageScope = $scope.$parent.$parent.$parent;
            pageScope.multiSelectArray = [];
            
            //Was causing a th with class 'cog-col' to be inserted every time a call was made
//            $scope.$on('lastRepeat', function() {
//                var table = $scope.table;
//                // Add column to header
//                var theadTr = table.children[0].children[0];
//                var emptyTh = document.createElement('th');
//                emptyTh.setAttribute('class', 'cog-col');
//                theadTr.insertBefore(emptyTh, theadTr.firstElementChild);
//            });

            $scope.toggleMulti = function(object) {
                if (pageScope.multiSelectArray.indexOf(object) === -1) {
                    pageScope.multiSelectArray.push(object);
                } else {
                    pageScope.multiSelectArray.splice(pageScope.multiSelectArray.indexOf(object), 1);
                }
                if (pageScope.multiSelectArray.length) {
                    pageScope.multiSelect = true;
                    pageScope.sidePanelOpen = true;
                    pageScope.previouslyClickedObject = null;
                } else {
                    pageScope.multiSelect = false;
                    if(pageScope.isSearching !== true){
                        if(!pageScope.previouslyClickedObject){
                            pageScope.sidePanelOpen = false;
                        }
                        
//                    } else {
                    }
                    //Was closing the sidepanel when we need it open to view our advanced search
//                    pageScope.sidePanelOpen = false;
                }
            };
        }
    };
});