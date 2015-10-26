
var module = angular.module('claimsAdmin', ['ui.bootstrap', 'dropzone']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function (data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});


module.controller('claimsContactsList', function ($scope, claimsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.contacts = [];

    listContactsByClaim();


    function listContactsByClaim() {
        var jobNumber = document.getElementById('Claim_jobNumberHidden').value;

        claimsEditSrv.getContacts(jobNumber).then(function () {
            $scope.contacts = claimsEditSrv.contacts;
            $scope.loading = false;
        });
    }

});

module.controller('claimsEditCtrl', function ($scope, $modal, claimsEditSrv, claimsTemplateSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    $scope.contacts = [];

    getProjectAddress();
    getClaimDetails();

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getClaimDetails() {

        var claimId = document.getElementById('Claim_id').value;

        claimsEditSrv.getClaimDetails(claimId).then(function () {
            $scope.claim = claimsEditSrv.claimDetails;
            $scope.loading = false;

        });
    }

    function getProjectAddress() {

        var addressId = document.getElementById('Claim_ProjectAddresses_id').value;

        claimsEditSrv.getProjectAddress(addressId).then(function () {
            $scope.projectAddress = claimsEditSrv.projectAddress;
            $scope.loading = false;
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = object.claimsId;
        claimsEditSrv.save(object, formToken).then(function () {
            getClaimDetails();
        });
    };

    $scope.discardChanges = function () {
        getClaimDetails();
    };



    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };

    $scope.openEditModal = function (claim) {
        $scope.modalLoading = true;
        var template = claimsTemplateSrv.claimEditModal;
        var modal = $modal.open({
            templateUrl: template,
            controller: 'claimsModalCtrl',
            size: 'xl',
            resolve: {
                claim: function () {
                    return claim;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function () {

        });
    };

});

module.service('claimsEditSrv', function (crudSrv, searchSrv) {
    var objectType = 'Claim';
    var apiPath = '/admin/claims/';
    var singleApiPath = '/admin/claim/';
    var projectApiPath = '/admin/projects/';

    var self = this;



    this.save = function (object, formToken, page) {
        var requestPath = singleApiPath + page + '/';
        var copiedObject = angular.copy(object);
        copiedObject.date = object.date.toISOString().substring(0, 10);
        return crudSrv.save(copiedObject, objectType, formToken, requestPath);
    };


    this.getClaimDetails = function (id) {

        return crudSrv.getDetails(apiPath, id).then(function (response) {
            self.claimDetails = response.data.Claim;
        });

    };

    this.autocomplete = function (value, type) {
        var config = {};
        config[type] = value;
        return searchSrv.fetchAutocomplete(config, apiPath + 'projectaddresses/').then(function () {
            return searchSrv.autocomplete.ProjectAddresss;
        });
    };

    this.saveProjectAddress = function (object, formToken) {
        return crudSrv.save(object, 'ProjectAddress', formToken, '/admin/projects/');
    };

    this.getProjectAddress = function (id) {
        return crudSrv.getDetails(projectApiPath, id).then(function (response) {
            self.projectAddress = response.data.ProjectAddress;
        });
    };

    this.getContacts = function (jobNumber) {
        return crudSrv.getDetails('/admin/contacts/claim/', jobNumber).then(function (response) {
            self.contacts = response.data.ClaimContacts;
        });
    };
});

module.service('claimsInitialJobsheetSrv', function (crudSrv) {
    var apiPathSave = '/admin/claim/initial-jobsheet/save/';
    this.save = function (object, objectType, formToken, ids) {
        return crudSrv.save(object, objectType, formToken, apiPathSave + ids);
    };
});

module.controller('initialJobsheetCtrl', function ($scope, $location, claimsInitialJobsheetSrv, claimsEditSrv) {
    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }

    var claimId = apiPath.slice(apiPath.indexOf('jobsheet') + 9, apiPath.lastIndexOf('/') + 1);
    var claimLocationId = apiPath.slice(apiPath.lastIndexOf('/') + 1);

    $scope.loading = true;
    $scope.jobSheet = new AngularQueryObject();
    $scope.jobSheet.query.contacts = [];
    $scope.jobSheet.query.contacts.push({});

    $scope.getClaimDetails = function () {
        claimsEditSrv.getClaimDetails(claimId).then(function (response) {
            $scope.claim = response.data.claim;
            claimsEditSrv.getProjectAddress($scope.claim.ProjectAddresses_id).then(function (response) {
                $scope.projectAddress = response.data.ProjectAddress;
                $scope.loading = false;
            });
        });
    };
    $scope.getClaimDetails();

    $scope.addOwnerTenant = function () {
        $scope.jobSheet.query.contacts.push({});
    };

    $scope.removeOwnerTenant = function (e, index) {
        e.preventDefault();
        $scope.jobSheet.query.contacts.splice(index, 1);
    };

    function save(object, objectType, formToken) {
        return claimsInitialJobsheetSrv.save(object, objectType, formToken, claimId + claimLocationId);
    }

    $scope.saveClaimLocation = function (object) {
        var objectType = 'ClaimLocation';
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        save(object, objectType, formToken).then(function () {
            $scope.nextPage();
        });
    };

    $scope.saveContacts = function (object) {
        var objectType = 'Contacts';
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        save(object, objectType, formToken).then(function () {
            $scope.nextPage();
        });
    };

    $scope.saveAffectedAreas = function (object) {
        var objectType = 'AffectedAreas';
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        save(object, objectType, formToken).then(function () {
            $scope.nextPage();
        });
    };

    $scope.finish = function () {
        var uri = '/admin/claim/initial-jobsheet/get/' + claimId + claimLocationId;
        window.location.pathname = uri;
    };
});

module.controller('claimsListCtrl', function ($scope, $location, $modal, claimsEditSrv, claimsListSrv, tablesSrv, searchSrv) {
    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }
    var row = 0;
    var numRows = 20;
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.selectedClaim = {};

    $scope.tablesSrv = tablesSrv;

    getClaimsList();

    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
        }
    });

    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.selectedClaim = clickedObject;
            $scope.sidePanelLoading = true;
            $scope.sidePanelOpen = true;
            claimsListSrv.getClaimLocations(clickedObject.id)
                    .then(function () {
                        $scope.selectedClaim.locations = claimsListSrv.claimsLocations;
                    });
            claimsListSrv.getClaimContacts(clickedObject)
                    .then(function () {
                        $scope.selectedClaim.contacts = claimsListSrv.claimContacts;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.openAddNewWizard = function () {
        var modalInstance = $modal.open({
            templateUrl: '/render/claims/claimsAddNewModal',
            controller: 'claimsModalCtrl',
            size: 'lg',
            keyboard: false,
            backdrop: "static"
        });
    };


    function getClaimsList() {
        $scope.loading = true;
        claimsListSrv.getClaimsList(row, numRows).then(function (response) {
            $scope.claimsList = claimsListSrv.claimsList;
            $scope.totalItems = claimsListSrv.claimsCount;
        }).then(function () {
            $scope.loading = false;
        });
    }


    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            claimsListSrv.search(copiedObject).then(function () {
                $scope.claimsList = claimsListSrv.searchResults;
                $scope.totalItems = claimsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getStaffList();
    };
});

module.controller('claimsModalCtrl', function ($modalInstance, $scope, claimsEditSrv) {
    $scope.addNewClient = false;

    $scope.project = {};
    $scope.claim = {};
    $scope.claim.query = {};


    // datepicker stuffs
    $scope.isOpen = {};
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    var autocomplete = function (value, type) {
        return claimsEditSrv.autocompleteProjectAddress(value, type);
    };

    $scope.autocompleteBuilding = function (value) {
        return autocomplete(value, 'buildingName');
    };

    $scope.autocompleteStrata = function (value) {
        return autocomplete(value, 'stratanumber');
    };

    $scope.autocompleteAddress = function (value) {
        return autocomplete(value, 'address');
    };

    $scope.selectAddress = function (item, model, label) {
        $scope.claim.ProjectAddress = item;
        $scope.claim.query.ProjectAddresses_id = item.id;
        if (item.buildingYear.parseInt <= 1980) {
            $scope.claim.query.asbestosTestRequired = 'true';
        } else {
            $scope.claim.query.asbestosTestRequired = 'false';
        }
    };

    $scope.saveProjectAddress = function (project) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        claimsEditSrv.saveProjectAddress(project, formToken).then(function (response) {
            $scope.claim.ProjectAddress = response.data.ProjectAddress[0];
            $scope.claim.query.ProjectAddresses_id = response.data.ProjectAddress[0].id;
            $scope.toggleAdding();
            $scope.nextPage();
        });
    };

    $scope.save = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        return claimsEditSrv.save($scope.claim.query, formToken, $scope.currentPage + 1);
    };

    $scope.saveAndNext = function () {
        $scope.save().then(function (response) {
            $scope.claim.query.id = response.data.Claim[0].id;
            $scope.nextPage();
        });
    };

    $scope.toggleAdding = function () {
        $scope.addNewClient = !$scope.addNewClient;
    };

    $scope.confirm = function () {
        $modalInstance.close($scope.claim.query);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});

module.service('claimsListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/claims/';
    var apiPathClaimLocation = '/admin/claimlocations/claim/';
    var apiPathClaimContacts = '/admin/claim/contacts/';

    var self = this;



    self.advancedSearch = {};

    this.getClaimsList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.claimsList = response.data.Claims;
                    self.claimsCount = response.data.ClaimsCount[0].rowCount;
                });
    };

    this.getClaimDetail = function (object) {
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    self.claimDetail = response.data.Claim;
                });
    };



    this.getClaimsLocationsList = function (claimId) {
        return $http.get(apiPath + 'locations/' + claimId)
                .then(function (response) {
                    self.claimsLocations = response.data.ClaimsLocations;

                });
    };



    this.getClaimLocations = function (claimId) {
        return $http.get(apiPathClaimLocation + claimId)
                .then(function (response) {
                    self.claimsLocations = response.data.ClaimsLocations;
                });
    };


    this.getClaimContacts = function (object) {
        return $http.get(apiPathClaimContacts + object.id)
                .then(function (response) {
                    self.claimContacts = response.data.ClaimContacts;
                });
    };



    this.fetchAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, apiPath).then(function () {
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

    this.search = function (searchObject) {
        return searchSrv.search(searchObject, apiPath).then(function () {
            self.searchResults = searchSrv.searchResults.Claims;
            self.searchResultsCount = searchSrv.searchResultsCount.ClaimsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function () {
        return searchSrv.getAdvancedSearchFilters('/render/claims/claimsAdvancedSearchFilters').then(function () {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});

module.controller('claimsLocationsListCtrl', function ($scope, $location, $modal, claimsListSrv, tablesSrv, searchSrv) {

    var row = 0;
    var numRows = 20;


    $scope.tablesSrv = tablesSrv;

    getClaimsLocationsList();

    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
        }
    });


    $scope.openAddNewWizard = function () {
        var modalInstance = $modal.open({
            templateUrl: '/render/claims/claimsAddNewModal',
            controller: 'claimsModalCtrl',
            size: 'lg',
            keyboard: false,
            backdrop: "static"
        });

        modalInstance.result.then(function (claim) {
            claimsEditSrv.save(claim).then(function () {
                getClaimsList();
            });
        });
    };


    function getClaimsLocationsList() {
        $scope.loading = true;
        var claimId = document.getElementById('Claim_id').value;

        claimsListSrv.getClaimLocations(claimId).then(function (response) {
            $scope.claimsLocations = claimsListSrv.claimsLocations;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.getStatusColor = function (item) {
        if (item.WorkStatus_id == 1) {
            return 'warning';
        } else if (item.WorkStatus_id == 2) {
            return 'success';
        } else {
            return 'danger';
        }
    };

});

/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


module.service('claimsTemplateSrv', function () {
    this.claimEditModal = '/render/claims/claimEditModal';
});