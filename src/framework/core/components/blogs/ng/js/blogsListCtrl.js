
module.controller('blogsListCtrl', function ($scope, $modal, blogsListSrv, blogsEditSrv, templateSrv, tablesSrv, toastsSrv) {

    $scope.newAlert = toastsSrv.newAlert;
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};

    $scope.previouslyClickedObject = {};

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.blogsList = tablesSrv.sortResult.Blogs;
            $scope.loading = false;
        }
    });

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var apiPath = '/admin/blogs/';

    $scope.setItemsPerPage = function (number) {
        $scope.itemsPerPage = number;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getBlogList();
    };

    function getBlogList() {
        $scope.loading = true;
        blogsListSrv.getBlogList(row, numRows).then(function (response) {
            $scope.blogsList = blogsListSrv.blogsList;
            $scope.totalItems = blogsListSrv.blogsCount;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.fetchAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;

        return blogsListSrv.fetchAutocomplete(searchObject);
    };

    $scope.openAddNewBlogModal = function () {
        var template = templateSrv.blogsAddNewModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'blogsModalCtrl',
            size: 'xl'
        });

        modalInstance.result.then(function (blogs) {
            blogsEditSrv.save(blogs).then(function () {
                getBlogList();
            });
        });
    };

    $scope.openBlogScheduleModal = function (blogs) {
        var template = templateSrv.blogsScheduleModal;
        $modal.open({
            templateUrl: template,
            controller: 'blogsModalCtrl',
            size: 'lg',
            resolve: {
                blogs: function () {
                    return blogs;
                }
            }
        });
    };

    $scope.openBlogAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedBlog = undefined;
        $scope.sidePanelLoading = true;
        blogsListSrv.getAdvancedSearchFilters().then(function () {
            $scope.sidePanelLoading = false;
            $scope.searching = true;
        });
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        getBlogList();
    };

    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            blogsListSrv.search(copiedObject).then(function () {
                $scope.blogsList = blogsListSrv.searchResults;
                $scope.totalItems = blogsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getBlogList();
    };

    $scope.closeSidePanel = function () {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedBlog) {
            $scope.selectedBlog = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedBlog && !$scope.searching) {
            $scope.sidePanelOpen = false;
        }
    };

    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelLoading = true;
            blogsListSrv.getBlogDetail(clickedObject)
                    .then(function () {
                        $scope.selectedBlog = blogsListSrv.blogsDetail;
                        $scope.sidePanelOpen = true;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getBlogList(row, numRows);
    });
});

module.controller('blogsModalCtrl', function ($modalInstance, $scope) {
    $scope.blogs = {};

    $scope.confirm = function () {
        $modalInstance.close($scope.blogs);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
