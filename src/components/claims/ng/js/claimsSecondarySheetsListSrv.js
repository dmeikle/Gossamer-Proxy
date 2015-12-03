module.service('secondarySheetsListSrv', function(crudSrv, searchSrv, $http) {
    var objectType = 'Claim';
    var apiPath = '/admin/claims/secondary-sheets/';
    var singleApiPath = '/admin/claim/';
    var projectApiPath = '/admin/projects/';
    var claimLocationsApiPath = '/admin/claimlocations/';

    var self = this;

    this.getSheetsList = function(claimsId, claimsLocationsId) {
        return $http.get(apiPath + 'list/' + claimsId + '/' + claimsLocationsId)
            .then(function(response) {
                self.sheetsList = response.data.SecondarySheets;
                self.sheetsCount = response.data.SecondarySheets[0].rowCount;
                return response;
            });
    };
    
    this.getSheetActions = function(clickedObject) {
        return $http.get(apiPath + 'get/' + clickedObject.Claims_id + '/' + clickedObject.ClaimsLocations_id + '/'+ clickedObject.AffectedAreas_id)
            .then(function(response) {
                self.sheetActionsList = response.data.Actions;
                return response;
            });
    };
});