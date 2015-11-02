module.service('blogsListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/blogs/';

    var self = this;

    self.advancedSearch = {};

    this.getBlogList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.blogsList = response.data.Blogs;
                    self.blogsCount = response.data.BlogsCount[0].rowCount;
                });
    };

    this.getBlogDetail = function (object) {
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    if (response.data.Blog.dob) {
                        response.data.Blog.dob = new Date(response.data.Blog.dob);
                    }
                    if (response.data.Blog.hireDate) {
                        response.data.Blog.hireDate = new Date(response.data.Blog.hireDate);
                    }
                    if (response.data.Blog.departureDate) {
                        response.data.Blog.departureDate = new Date(response.data.Blog.departureDate);
                    }
                    self.blogsDetail = response.data.Blog;
                });
    };

    this.fetchAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, apiPath).then(function () {
            self.autocomplete = searchSrv.autocomplete.Blogs;
            self.autocompleteValues = [];
            if (searchObject.name) {
                for (var blogs in self.autocomplete) {
                    if (self.autocomplete.hasOwnProperty(blogs) && self.autocomplete.length > 0) {
                        self.autocompleteValues.push(self.autocomplete[blogs].firstname + ' ' + self.autocomplete[blogs].lastname);
                    }
                }
            }
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    this.search = function (searchObject) {
        return searchSrv.search(searchObject, apiPath).then(function () {
            self.searchResults = searchSrv.searchResults.Blogs;
            self.searchResultsCount = searchSrv.searchResultsCount.BlogsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function () {
        return searchSrv.getAdvancedSearchFilters('/render/blogs/blogsAdvancedSearchFilters').then(function () {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});
