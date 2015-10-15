module.service('claimsListSrv', function($http, searchSrv) {

  var apiPath = '/admin/claims/';

  var self = this;



  self.advancedSearch = {};

  this.getClaimsList = function(row, numRows) {
    return $http.get(apiPath + row + '/' + numRows)
      .then(function(response) {
        self.claimsList = response.data.Claims;
        self.claimsCount = response.data.ClaimsCount[0].rowCount;
      });
  };

  this.getClaimDetail = function(object) {
    return $http.get(apiPath + object.id)
      .then(function(response) {        
        self.claimDetail = response.data.Claim;
      });
  };
  
  this.getClaimsLocationsList = function(claimId) {
      return $http.get(apiPath + 'locations/' + claimId)
      .then(function(response) {        
        self.claimsLocations = response.data.ClaimsLocations;
      });
  };

  this.fetchAutocomplete = function(searchObject) {
    return searchSrv.fetchAutocomplete(searchObject, apiPath).then(function() {
      self.autocomplete = searchSrv.autocomplete.Claims;
      self.autocompleteCount = searchSrv.autocomplete.ClaimsCount[0].rowCount;
      self.autocompleteValues = [];
      if (searchObject.name) {
        for (var claim in self.autocomplete) {
          if (self.autocomplete.hasOwnProperty(claim) && self.autocomplete.length > 0) {
            self.autocompleteValues.push(self.autocomplete[claim].buildingName + ' ' + self.autocomplete[claim].jobNumber);
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

  this.search = function(searchObject) {    
    return searchSrv.search(searchObject, apiPath).then(function() {
      self.searchResults = searchSrv.searchResults.Claims;
      self.searchResultsCount = searchSrv.searchResultsCount.ClaimsCount[0].rowCount;
    });
  };

  this.getAdvancedSearchFilters = function() {
    return searchSrv.getAdvancedSearchFilters('/render/claims/claimsAdvancedSearchFilters').then(function() {
      self.advancedSearch.fields = searchSrv.advancedSearch.fields;
    });
  };
});
