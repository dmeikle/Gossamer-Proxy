module.service('variantOptionsListSrv', function(crudSrv, searchSrv) {
    var self = this;

    var objectType = 'VariantOption';

    this.getList = function(apiPath, row, numRows) {
        return crudSrv.getList(apiPath, row, numRows).then(function(response) {
            return response.data;
        });
    };

    this.search = function(apiPath, searchObject) {
        return searchSrv.search(searchObject, apiPath).then(function() {
            self.searchResults = searchSrv.searchResults.VariantOptions;
            self.searchResultsCount = searchSrv.searchResultsCount.VariantOptions[0].rowCount;
        });
    };

    this.delete = function(apiPath, object, formToken) {
        var postObject = {};
        postObject.id = object.id;
        postObject.isActive = 0;
        return crudSrv.save(postObject, objectType, formToken, apiPath + object.id);
    };
});