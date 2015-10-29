var module = angular.module('staffAdmin', ['ui.bootstrap', 'dropzone']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function (data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});
module.controller('staffBenefitsCtrl', function ($scope, $location, $modal, staffBenefitsSrv, staffTemplateSrv) {
    // stuff to run on controller load
    $scope.staffBenefitsLoading = true;
    getStaffBenefits();

    function getStaffBenefits() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        staffBenefitsSrv.getStaffBenefits(object).then(function () {
            $scope.staffBenefits = staffBenefitsSrv.staffBenefits;
            $scope.staffBenefitsLoading = false;
        });
    }

    $scope.openStaffBenefitsHistoryModal = function () {
        var template = staffTemplateSrv.staffBenefitsHistoryModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'staffBenefitsHistoryModalCtrl',
            size: 'lg',
            resolve: {
                staffBenefits: function () {
                    return $scope.staffBenefits;
                }
            }
        });

        modalInstance.result.then(function () {
            getStaffBenefits();
        });
    };
});

module.controller('staffBenefitsHistoryModalCtrl', function ($modalInstance, $scope, $location, staffBenefits, staffBenefitsSrv) {
    $scope.staffBenefits = staffBenefits;
    $scope.staff = {};
    $scope.isOpen = {};
    $scope.addingNew = false;

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    $scope.toggleAddNewBenefits = function () {
        if ($scope.addingNew === true) {
            $scope.addingNew = false;
        } else {
            $scope.addingNew = true;
        }
    };

    $scope.saveNewBenefits = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        staffBenefitsSrv.save(object, formToken).then(function () {
            $scope.addingNew = false;
            var object = {};
            object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

            staffBenefitsSrv.getStaffBenefits(object).then(function () {
                $scope.staffBenefits = staffBenefitsSrv.staffBenefits;
            });
        });
    };

    $scope.close = function () {
        $modalInstance.close();
    };
});

module.service('staffBenefitsSrv', function ($http) {
    var self = this;

    var apiPath = '/admin/staff/benefits/';

    this.getStaffBenefits = function (object) {
        return $http.get(apiPath + object.id).then(function (response) {
            if (response.data.StaffBenefits[0].length > 0) {
                for (var benefits in response.data.StaffBenefits) {
                    if (response.data.StaffBenefits.hasOwnProperty(benefits)) {
                        response.data.StaffBenefits[benefits].startDate = new Date(response.data.StaffBenefits[benefits].startDate);
                    }
                }
                self.staffBenefits = response.data.StaffBenefits;
            }
        });
    };

    this.save = function (object, formToken) {
        var copiedObject = jQuery.extend(true, {}, object);

        copiedObject.startDate = object.startDate.toISOString().substring(0, 10);

        var data = {};
        data.StaffBenefit = copiedObject;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + copiedObject.id,
            data: data
        });
    };
});

module.directive('getDepartment', function () {
    var departments = [{
            "id": "1",
            "name": "Accounting",
            "isActive": "1",
            "Departments_id": "1"
        }, {
            "id": "2",
            "name": "Administration",
            "isActive": "1",
            "Departments_id": "2"
        }, {
            "id": "3",
            "name": "Content Processing",
            "isActive": "1",
            "Departments_id": "3"
        }, {
            "id": "4",
            "name": "Construction",
            "isActive": "1",
            "Departments_id": "4"
        }, {
            "id": "5",
            "name": "Emergency",
            "isActive": "1",
            "Departments_id": "5"
        }, {
            "id": "6",
            "name": "Scoping",
            "isActive": "1",
            "Departments_id": "6"
        }];

    return {
        restrict: 'A',
        transclude: true,
        scope: false,
        replace: true,
        link: function (scope, element, attrs) {
            for (var department in departments) {
                if (departments.hasOwnProperty(department) && scope.$parent.staff) {
                    if (departments[department].id === scope.$parent.staff.Departments_id) {
                        element.text(departments[department].name);
                    }
                }
            }
        }
    };
});

module.directive('checkUsernameExists', function (staffEditSrv, $q) {
    return {
        restrict: 'A',
        scope: false,
        require: ['ngModel'],
        link: function (scope, element, attrs, ctrl) {
            if (scope.$parent && scope.$parent.staff) {
                var object = scope.$parent.staff;
                ctrl[0].$asyncValidators.usernameExists = function (modelValue, viewValue) {
                    object.username = modelValue;
                    return staffEditSrv.checkUsernameExists(object).then(function () {
                        if (staffEditSrv.usernameExists === "true") {
                            object.usernamValid = false;
                            return $q.reject('Username Exists');
                        } else {
                            object.usernameValid = true;
                            return true;
                        }
                    });
                };
            }
        }
    };
});

module.directive('boolToString', function () {
    return {
        restrict: 'A',
        replace: true,
        scope: false,
        link: function (scope, element, attrs) {
            switch (attrs.value) {
                case '0':
                    element[0].textContent = 'No';
                    break;
                default:
                    element[0].textContent = 'Yes';

            }
        }
    };
});

module.directive('staffAdvancedSearchFilters', function (staffListSrv, $compile) {
    return {
        restrict: 'E',
        replace: true,
        scope: false,
        link: function (scope, element, attrs) {
            var fields = staffListSrv.advancedSearch.fields;
            for (var filter in fields) {
                if (fields.hasOwnProperty(filter)) {
                    element[0].appendChild(fields[filter]);
                }
            }
            $compile(element.contents())(scope);
        }
    };
});

module.controller('staffEditCtrl', function ($scope, $location, staffEditSrv, staffPhotoSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    getStaffDetail();

    // Load staffPhotoSrv so we can watch it
    $scope.staffPhotoSrv = staffPhotoSrv;
    $scope.$watch('staffPhotoSrv.photo', function () {
        if ($scope.staffPhotoSrv.photo !== undefined && $scope.staff.imageName !== undefined) {
            $scope.staff.imageName = $scope.staffPhotoSrv.photo;
        }
    });

    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getStaffDetail() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        staffEditSrv.getStaffDetail(object).then(function () {
            $scope.staff = staffEditSrv.staffDetail;
            $scope.loading = false;

            staffEditSrv.getStaffCreds(object).then(function () {
                $scope.authorization.username = staffEditSrv.staffCreds.username;
                $scope.authorizationLoading = false;
            });
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        staffEditSrv.save(object, formToken).then(function () {
            if ($location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length) === '0') {
                window.location.pathname = '/admin/staff/edit/' + staffEditSrv.staffDetail.id;
            }
            getStaffDetail();
        });
    };

    $scope.discardChanges = function () {
        getStaffDetail();
    };

    $scope.submitCredentials = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = $scope.staff.id;
        switch (object.emailUser) {
            case true:
                staffEditSrv.generateEmailReset(object, formToken);
                break;
            default:
                staffEditSrv.saveCredentials(object, formToken).then(function () {
                    $scope.credentialStatus = staffEditSrv.credentialStatus;
                });
        }
    };

    $scope.resetCredentials = function () {
        $scope.authorization.username = staffEditSrv.staffCreds.username;
        $scope.authorization.password = undefined;
        $scope.authorization.passwordConfirm = undefined;
    };

    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };
});

module.service('staffEditSrv', function ($http) {
    var apiPath = '/admin/staff/';

    var self = this;

    this.getStaffList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.staffList = response.data.Staffs;
                    self.staffCount = response.data.StaffsCount[0].rowCount;
                });
    };

    this.getStaffDetail = function (object) {
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    if (response.data.Staff) {
                        if (response.data.Staff.dob) {
                            response.data.Staff.dob = new Date(response.data.Staff.dob);
                        }
                        if (response.data.Staff.hireDate) {
                            response.data.Staff.hireDate = new Date(response.data.Staff.hireDate);
                        }
                        if (response.data.Staff.departureDate) {
                            response.data.Staff.departureDate = new Date(response.data.Staff.departureDate);
                        }
                        self.staffDetail = response.data.Staff;
                    }
                });
    };

    this.getStaffCreds = function (object) {
        return $http.get(apiPath + 'credentials/' + object.id)
                .then(function (response) {
                    self.staffCreds = response.data.StaffAuthorization;
                });
    };

    this.save = function (object, formToken) {
        var copiedObject = jQuery.extend(true, {}, object);
        for (var property in copiedObject) {
            if (copiedObject.hasOwnProperty(property)) {
                if (copiedObject[property] === null) {
                    delete copiedObject[property];
                }
            }
        }
        if (copiedObject.dob) {
            copiedObject.dob = object.dob.toISOString().substring(0, 10);
        }
        if (copiedObject.hireDate) {
            copiedObject.hireDate = object.hireDate.toISOString().substring(0, 10);
        }
        if (copiedObject.departureDate) {
            copiedObject.departureDate = object.departureDate.toISOString().substring(0, 10);
        }

        var requestPath;
        if (!copiedObject.id) {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + copiedObject.id;
        }
        var data = {};
        data.Staff = copiedObject;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: requestPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            self.staffDetail = response.data.Staff[0];
        });
    };

    this.checkUsernameExists = function (object) {
        return $http({
            url: apiPath + 'checkusername/' + object.id + '/' + object.username,
            method: 'GET'
        })
                .then(function (response) {
                    self.usernameExists = response.data.exists;
                });
    };

    this.saveCredentials = function (object, formToken) {
        var data = {};
        data.StaffAuthorization = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + 'credentials/' + object.id,
            data: data
        }).then(function (response) {
            self.credentialStatus = response.data;
        });
    };


});

module.controller('staffEmergencyContactsCtrl', function ($scope, $location, $modal, staffEmergencyContactsSrv, staffTemplateSrv) {
    $scope.loading = true;
    getStaffEmergencyInfo();

    function getStaffEmergencyInfo() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

        staffEmergencyContactsSrv.getStaffEmergencyInfo(object).then(function () {
            $scope.staffEmergencyContacts = staffEmergencyContactsSrv.staffEmergencyContacts;
            $scope.loading = false;
        });
    }

    $scope.openEditEmergencyContactModal = function (contact) {
        var template = staffTemplateSrv.editEmergencyContactModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'staffEmergencyContactModalCtrl',
            size: 'md',
            resolve: {
                contact: function () {
                    return contact;
                }
            }
        });

        modalInstance.result.then(function (contact) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            contact.staffId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
            $scope.loading = true;
            staffEmergencyContactsSrv.save(contact, formToken).then(function () {
                getStaffEmergencyInfo();
            });
        });
    };

    $scope.delete = function (contact) {
        var confirmed = confirm('Are you sure you want to delete ' + contact.firstname + ' ' + contact.lastname + '?');
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        if (confirmed) {
            staffEmergencyContactsSrv.delete(contact, formToken).then(function () {
                getStaffEmergencyInfo();
            });
        }
    };
});

module.controller('staffEmergencyContactModalCtrl', function ($scope, $location, $modalInstance, contact) {
    if (contact) {
        $scope.contact = contact;
    } else {
        $scope.contact = {};
    }

    $scope.confirm = function () {
        $modalInstance.close($scope.contact);
    };

    $scope.close = function () {
        $modalInstance.dismiss('close');
    };
});

module.service('staffEmergencyContactsSrv', function ($http) {
    var apiPath = '/admin/staff/emergencycontacts/';
    var self = this;

    this.getStaffEmergencyInfo = function (object) {
        return $http.get(apiPath + object.id).then(function (response) {
            if (response.data.EmergencyContacts[0].length > 0) {
                self.staffEmergencyContacts = response.data.EmergencyContacts;
            }
        });
    };

    this.save = function (object, formToken) {
        var contactId;
        if (!object.id) {
            contactId = '0';
        } else {
            contactId = object.StaffEmergencyContacts_id;
        }
        var data = {};
        data.StaffEmergencyContact = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + object.staffId + '/' + contactId,
            data: data
        });
    };

    this.delete = function (object, formToken) {
        return $http({
            method: 'DELETE',
            url: apiPath + object.Staff_id + '/' + object.StaffEmergencyContacts_id
        });
    };
});


module.controller('staffListCtrl', function ($scope, $modal, $location, staffListSrv, staffEditSrv, staffTemplateSrv, tablesSrv, toastsSrv) {

    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }

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
            $scope.staffList = tablesSrv.sortResult.Staffs;
            $scope.loading = false;
        }
    });
    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.Staffs'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.Staffs)
                $scope.staffList = tablesSrv.groupResult.Staffs;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getStaffList();
        }
    });

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    $scope.setItemsPerPage = function (number) {
        $scope.itemsPerPage = number;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
    };

    function getStaffList() {
        $scope.loading = true;
        staffListSrv.getStaffList(row, numRows).then(function (response) {
            $scope.staffList = staffListSrv.staffList;
            $scope.totalItems = staffListSrv.staffCount;
        }).then(function () {
            $scope.loading = false;
        });
    }

    $scope.fetchAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;

        return staffListSrv.fetchAutocomplete(searchObject);
    };

    $scope.openAddNewStaffModal = function () {
        var template = staffTemplateSrv.staffAddNewModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'staffModalCtrl',
            size: 'xl'
        });

        modalInstance.result.then(function (staff) {
            staffEditSrv.save(staff).then(function () {
                getStaffList();
            });
        });
    };

    $scope.openStaffScheduleModal = function (staff) {
        var template = staffTemplateSrv.staffScheduleModal;
        $modal.open({
            templateUrl: template,
            controller: 'staffModalCtrl',
            size: 'lg',
            resolve: {
                staff: function () {
                    return staff;
                }
            }
        });
    };

    $scope.openStaffAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedStaff = undefined;
        $scope.sidePanelLoading = true;
        staffListSrv.getAdvancedSearchFilters().then(function () {
            $scope.sidePanelLoading = false;
            $scope.searching = true;
        });
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        getStaffList();
    };

    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            staffListSrv.search(copiedObject).then(function () {
                $scope.staffList = staffListSrv.searchResults;
                $scope.totalItems = staffListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getStaffList();
    };

    $scope.closeSidePanel = function () {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedStaff) {
            $scope.selectedStaff = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedStaff && !$scope.searching) {
            $scope.sidePanelOpen = false;
        }
    };

    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        $scope.sidePanelOpen = true;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelLoading = true;
            staffListSrv.getStaffDetail(clickedObject)
                    .then(function () {
                        $scope.selectedStaff = staffListSrv.staffDetail;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.$watchGroup(['currentPage', 'itemsPerPage'], function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        if ($scope.grouped) {
            tablesSrv.groupBy(apiPath, $scope.groupedBy, row, numRows);
        } else {
            getStaffList(row, numRows);
        }
    });
});

module.controller('staffModalCtrl', function ($modalInstance, $scope) {
    $scope.staff = {};

    $scope.confirm = function () {
        $modalInstance.close($scope.staff);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});

module.service('staffListSrv', function ($http, searchSrv) {

    var apiPath = '/admin/staff/';

    var self = this;

    self.advancedSearch = {};

    this.getStaffList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.staffList = response.data.Staffs;
                    self.staffCount = response.data.StaffsCount[0].rowCount;
                });
    };

    this.getStaffDetail = function (object) {
        return $http.get(apiPath + object.id)
                .then(function (response) {
                    if (response.data.Staff.dob) {
                        response.data.Staff.dob = new Date(response.data.Staff.dob);
                    }
                    if (response.data.Staff.hireDate) {
                        response.data.Staff.hireDate = new Date(response.data.Staff.hireDate);
                    }
                    if (response.data.Staff.departureDate) {
                        response.data.Staff.departureDate = new Date(response.data.Staff.departureDate);
                    }
                    self.staffDetail = response.data.Staff;
                });
    };

    this.fetchAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, apiPath).then(function () {
            self.autocomplete = searchSrv.autocomplete.Staffs;
            self.autocompleteValues = [];
            if (searchObject.name) {
                for (var staff in self.autocomplete) {
                    if (self.autocomplete.hasOwnProperty(staff) && self.autocomplete.length > 0) {
                        self.autocompleteValues.push(self.autocomplete[staff].firstname + ' ' + self.autocomplete[staff].lastname);
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
            self.searchResults = searchSrv.searchResults.Staffs;
            self.searchResultsCount = searchSrv.searchResultsCount.StaffsCount[0].rowCount;
        });
    };

    this.getAdvancedSearchFilters = function () {
        return searchSrv.getAdvancedSearchFilters('/render/staff/staffAdvancedSearchFilters').then(function () {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };
});

module.controller('staffPhotoCtrl', function ($scope, $location, staffPhotoSrv) {
    var staffId = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
    $scope.dropzoneConfig = {
        'options': {// passed into the Dropzone constructor
            'url': '/admin/staff/photo/upload/' + staffId,
            'uploadMultiple': false,
            'dictDefaultMessage': ''
        },
        'eventHandlers': {
            'sending': function (file, xhr, formData) {
            },
            'success': function (file, response) {
                getStaffPhoto();
            }
        }
    };

    getStaffPhoto = function () {
        staffPhotoSrv.getStaffPhoto(staffId);
    };
});

module.service('staffPhotoSrv', function (photoSrv) {
    var apiPath = '/admin/staff/';
    var self = this;
    this.getStaffPhoto = function (staffId) {
        return photoSrv.getPhoto(apiPath + staffId).then(function (response) {
            self.photo = response.data.Staff.imageName;
        });
    };
});

module.controller('staffRolesCtrl', function ($scope, $location, staffRolesSrv) {
    // Stuff to run on controller load
    $scope.staffRoles = {};
    $scope.staffRoles.loading = true;
    getStaffRoles();

    function getStaffRoles() {
        var object = {};
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
        staffRolesSrv.getStaffRoles(object).then(function () {
            $scope.staffRoles = staffRolesSrv.staffRoles;
            $scope.staffRoles.loading = false;
        });
    }

    $scope.submitRoles = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
        staffRolesSrv.saveRoles(object, formToken).then(function () {
            getStaffRoles();
        });
    };
});

module.service('staffRolesSrv', function ($http) {
    var apiPath = '/admin/staff/';

    var self = this;

    this.getStaffRoles = function (object) {
        return $http.get(apiPath + 'permissions/' + object.id)
                .then(function (response) {
                    var rolesObject = {};
                    for (var role in response.data.roles) {
                        if (response.data.roles.hasOwnProperty(role)) {
                            rolesObject[response.data.roles[role]] = true;
                        }
                    }
                    self.staffRoles = rolesObject;
                });
    };

    this.saveRoles = function (object, formToken) {
        var id = object.id;
        delete object.loading;
        delete object.id;

        var rolesArray = [];
        for (var role in object) {
            if (object.hasOwnProperty(role) && role.length > 0 && object[role] === true) {
                rolesArray.push(role);
            }
        }

        var data = {};
        data.StaffAuthorization = rolesArray;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + 'permissions/' + id,
            data: data
        });
    };
});

module.service('staffTemplateSrv', function () {
    this.staffScheduleModal = '/render/staff/staffScheduleModal';
    this.staffAddNewModal = '/render/staff/staffAddNewModal';
    this.staffBenefitsHistoryModal = '/render/staff/staffBenefitsHistoryModal';
    this.editEmergencyContactModal = '/render/staff/editEmergencyContactModal';
    this.staffTimesheetModal = '/render/staff/staffTimesheetModal';
});

module.controller('staffTimesheetCtrl', function ($scope, $modal, staffTemplateSrv) {

    //Modals
    $scope.openStaffTimesheetModal = function () {
        $scope.loadingModal = true;
        var template = staffTemplateSrv.staffTimesheetModal;
        $modal.open({
            templateUrl: template,
            controller: 'staffTimesheetModalCtrl',
            size: 'lg',
            windowClass: 'staff-timesheet-modal',
//            resolve: {
//                timesheet: function () {
//                    return timesheet;
//                }
//            }
        }).opened.then(function () {
            $scope.loadingModal = false;
        });
    };
});

module.controller('staffTimesheetModalCtrl', function ($modalInstance, $scope, staffTimesheetSrv, $filter) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};

    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    //Get the dates and Timepicker info
    var date = new Date();
    $scope.today = date;

    //Timepicker
    $scope.mstep = 15;
    $scope.hstep = 1;
    $scope.timeFrom = date.setHours(0, 0, 0, 0);
    $scope.timeTo = date.setHours(0, 0, 0, 0);

    //Laborer Autocomplete
    function fetchAutocomplete() {
        if ($scope.laborer.search(' ') === -1) {
            staffTimesheetSrv.autocomplete($scope.laborer)
                    .then(function () {
                        $scope.autocomplete = staffTimesheetSrv.autocompleteList;
                    });
        }
    }

    $scope.$watch('laborer', function () {
        if ($scope.laborer) {
            $scope.autocomplete.loading = true;
            fetchAutocomplete();
        }
    });

    //Laborer Typeahead
    $scope.fetchLaborerAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return staffListSrv.fetchAutocomplete(searchObject);
    };

    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            staffListSrv.search(copiedObject).then(function () {
                $scope.staffList = staffListSrv.searchResults;
                $scope.totalItems = staffListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getStaffList();
    };

    $scope.hourlyRate = 0;
    //get staff id and hourly rate
    $scope.getStaffInfo = function (name) {
        if (name !== undefined) {
            var splitName = name.split(' ');
            for (var i in $scope.autocomplete) {
                if (splitName[0] === $scope.autocomplete[i].firstname && splitName[1] === $scope.autocomplete[i].lastname) {
                    $scope.staffID = $scope.autocomplete[i].id;
                    $scope.hourlyRate = parseFloat($scope.autocomplete[i].salary);
                    timesheetTemplate.hourlyRate = $scope.hourlyRate;
                }
            }
            //Update the existing timesheet items with the rate
            for (var j in $scope.timesheetItems) {
                $scope.timesheetItems[j].hourlyRate = parseFloat($scope.hourlyRate * $scope.timesheetItems[j].rateVariance);
            }
        }
    };

    //Checks to see if a timesheet already exists
    $scope.findExistingTimesheet = function (name, workDate) {
        if (name && workDate && name !== $scope.prevName && workDate !== $scope.prevDate) {
            $scope.findExisting = true;
            $scope.loading = true;
            var date = $filter('date')(workDate, 'yyyy-MM-dd');
            staffTimesheetSrv.searchTimesheets(name, date)
                    .then(function () {
                        if (staffTimesheetSrv.timesheetSearchCount === '1') {
                            var timesheet = staffTimesheetSrv.timesheetSearchResults;
                            $scope.loadTimesheetItems(timesheet);
                            //$scope.findExisting = false;
                            $scope.hourlyRate = parseFloat(timesheet.hourlyRate);
                            timesheetTemplate.hourlyRate = $scope.hourlyRate;
                        } else {
                            $scope.loadTimesheetItems('');
                            $scope.findExisting = false;
                        }
                    });
        }
        $scope.prevName = name;
        $scope.prevDate = workDate;
    };

    //Fetch claims
    function getClaims(search, row) {
        staffTimesheetSrv.claimsAutocomplete(search)
                .then(function () {
                    if (staffTimesheetSrv.claimsCount > 0) {
                        $scope.claimsAutocomplete = staffTimesheetSrv.claimsList;
                        if (staffTimesheetSrv.claimsCount === 1) {
                            row.Claims_id = $scope.claimsAutocomplete[0].id;
                        }
                    }
                });
    }

    //Clear the Claims list
    $scope.clearClaimsList = function (row) {
        for (var i in $scope.claimsAutocomplete) {
            if ($scope.claimsAutocomplete[i].jobNumber === row.jobNumber) {
                row.Claims_id = $scope.claimsAutocomplete[i].id;
                row.address = $scope.claimsAutocomplete[i].address1;
                row.city = $scope.claimsAutocomplete[i].city;
            }
        }
        //$scope.claimsAutocomplete = {};
    };

    $scope.watchClaims = function (row) {
        getClaims(row.jobNumber, row);
    };

    //Rate Variance (phase)
    $scope.getRateVarianceOptions = function (event) {
        $scope.rateVarianceList = $(event.target).find('option');
    };

    $scope.getRateVariance = function (row, phaseID) {
        for (var i = 0; i < $scope.rateVarianceList.length; i++) {
            if ($scope.rateVarianceList[i].attributes.value.nodeValue === phaseID) {
                row.rateVariance = $scope.rateVarianceList[i].attributes['data-ratevariance'].nodeValue;
                row.hourlyRate = parseFloat($scope.hourlyRate * row.rateVariance);
            }
        }
    };


    $scope.timesheetSelected = false;

    //watch the timesheetItems for updates
    $scope.$watch('timesheetItems', function () {
        for (var i in $scope.timesheetItems) {
            if ($scope.timesheetItems[i].isSelected === true) {
                $scope.timesheetSelected = true;
                return;
            } else {
                $scope.timesheetSelected = false;
            }
        }
    }, true);

    $scope.timesheet = {
        Timesheet_id: '',
        workDate: '',
        Vehicles_id: '',
        totalHours: '0'
    };
    //Timesheet template
    var timesheetTemplate = {
        isSelected: false,
        Claims_id: '',
        jobNumber: '',
        AccountingPhaseCodes_id: '',
        address: '',
        city: '',
        toll1: '',
        toll2: '',
        timeFrom: $scope.timeFrom,
        timeTo: $scope.timeTo,
        regularHours: 0,
        overtimeHours: 0,
        doubleOTHours: 0,
        totalHours: 0
    };
    $scope.timesheetItems = [];

    //Check to see if a timesheet ID exists
    $scope.loadTimesheetItems = function () {
        $scope.loading = true;
        $scope.loading = false;
        $scope.timesheetItems = angular.copy([timesheetTemplate]);
        $scope.timesheetDate = $scope.today;
    };

    $scope.loadTimesheetItems();

    //Summing up the row and column totals
    $scope.sumTotal = {
        regularHours: 0,
        overtimeHours: 0,
        doubleOTHours: 0,
        statRegularHours: 0,
        statOTHours: 0,
        statDOTHours: 0,
        statDoubleOTHours: 0,
        totalHours: 0
    };

    //Update the hour totals
    $scope.updateTotal = function (row, col) {
        row.totalHours = 0;
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDoubleOTHours'];
        var rowHours = {
            regularHours: parseFloat(row.regularHours),
            overtimeHours: parseFloat(row.overtimeHours),
            doubleOTHours: parseFloat(row.doubleOTHours),
            statRegularHours: parseFloat(row.statRegularHours),
            statOTHours: parseFloat(row.statOTHours),
            statDoubleOTHours: parseFloat(row.statDoubleOTHours)
        };

        //Check for null/NaN values and replace them with 0
        for (var i in rowHours) {
            if (isNaN(rowHours[i])) {
                rowHours[i] = 0;
            }
        }
        row.totalHours = rowHours.regularHours + rowHours.overtimeHours + rowHours.doubleOTHours + rowHours.statRegularHours + rowHours.statOTHours + rowHours.statDoubleOTHours;
        $scope.updateTotalSum();
    };

    $scope.updateTotalSum = function () {
        var colValues = ['regularHours', 'overtimeHours', 'doubleOTHours', 'statRegularHours', 'statOTHours', 'statDoubleOTHours'];
        for (var j in colValues) {
            var col = colValues[j];
            $scope.sumTotal[col] = 0;
            for (var i in $scope.timesheetItems) {
                var totalCol = Object.keys($scope.timesheetItems[i]).length - 1;
                if ($scope.timesheetItems[i][col] === null || isNaN($scope.timesheetItems[i][col])) {
                    $scope.sumTotal[col] += 0;
                } else {
                    $scope.sumTotal[col] += parseFloat($scope.timesheetItems[i][col]);
                }
            }
        }

        $scope.sumTotal.totalHours = 0;
        for (var p in $scope.timesheetItems) {
            var totalRow = parseFloat($scope.timesheetItems[p].totalHours);
            $scope.sumTotal.totalHours += totalRow;
        }
        $scope.timesheet.totalHours = $scope.sumTotal.totalHours;
    };

    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function () {
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        $scope.timesheetItems.push(angular.copy(timesheetTemplate));
        if ($scope.laborerPositionID !== '') {
            $scope.timesheetItems[$scope.timesheetItems.length - 1].StaffTypes_id = $scope.laborerPositionID;
        }
    };

    //Insert rows below currently selected items
    $scope.insertTimesheetRows = function () {
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        for (var i in $scope.timesheetItems) {
            if ($scope.timesheetItems[i].isSelected === true) {
                $scope.timesheetItems.splice(parseInt(i) + 1, 0, angular.extend({}, timesheetTemplate));
                if ($scope.laborerPositionID !== '') {
                    $scope.timesheetItems[parseInt(i) + 1].StaffTypes_id = $scope.laborerPositionID;
                }
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeTimesheetRows = function () {
        var timesheet = $scope.timesheetItems;
        var newArray = timesheet;
        for (var i = $scope.timesheetItems.length - 1; i >= 0; i--) {
            if ($scope.timesheetItems[i].isSelected === true) {
                newArray.splice(parseInt(i), 1);
            }
        }

        $scope.updateTotalSum();
        $scope.timesheetItems = newArray;
    };

    //Select All
    $scope.selectAllToggle = function (value) {
        if (value === true) {
            for (var i in $scope.timesheetItems) {
                $scope.timesheetItems[i].isSelected = true;
            }
        } else {
            for (var j in $scope.timesheetItems) {
                $scope.timesheetItems[j].isSelected = false;
            }
        }
    };

    $scope.selectToll1 = [[]];
    $scope.selectToll2 = [[]];

    //Get vehicle ID tolls
    $scope.getVehicleTolls = function (vehicleID, timesheetItems) {
        staffTimesheetSrv.getTolls(vehicleID)
                .then(function () {
                    $scope.tolls = staffTimesheetSrv.vehicleTolls;
                    if (timesheetItems) {
                        for (var i in timesheetItems) {
                            if (i > 0) {
                                $scope.selectToll1.push([]);
                                $scope.selectToll2.push([]);
                            }
                            for (var j in $scope.tolls) {
                                if (timesheetItems[i].toll1 === $scope.tolls[j].cost) {
                                    $scope.timesheetItems[i].toll1 = $scope.tolls[j].cost;
                                    $scope.selectToll1[i][j] = true;
                                }
                                if (timesheetItems[i].toll2 === $scope.tolls[j].cost) {
                                    $scope.timesheetItems[i].toll2 = $scope.tolls[j].cost;
                                    $scope.selectToll2[i][j] = true;
                                }
                            }
                        }
                    }
                });
    };

    //check the selected rows
    $scope.checkSelected = function (value) {
        if (value === false) {
            $scope.selectAll = false;
        }
    };

    $scope.setCategory = function (positionID) {
        if ($scope.timesheetItems.length == 1) {
            $scope.timesheetItems[0].StaffTypes_id = positionID;
        }
    };

    //Check if an hour value is empty, replace it with 0
    $scope.checkEmpty = function (row, col) {
        if (row[col] === null || isNaN(row[col])) {
            row[col] = 0;
        }
    };

    $scope.getHours = function (object) {
        var newObj = angular.copy(object);
        for (var i in object) {
            newObj[i].timeFrom = $filter('date')(newObj[i].timeFrom, 'HH-mm');
            newObj[i].timeTo = $filter('date')(newObj[i].timeTo, 'HH-mm');
        }
        return newObj;
    };

    //Save timesheet
    $scope.saveTimesheet = function () {
        var date = $filter('date')($scope.timesheetDate, 'yyyy-MM-dd');
        $scope.timesheet.workDate = date;
        var timesheetItems = $scope.getHours($scope.timesheetItems);
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        staffTimesheetSrv.saveTimesheet($scope.timesheet, timesheetItems, formToken);
    };

    //Clear timesheet
    $scope.clearTimesheet = function () {
        $scope.timesheet.Vehicles_id = '';
        $scope.timesheetItems = angular.copy([timesheetTemplate]);
    };
});

// Timesheet service
module.service('staffTimesheetSrv', function ($http) {
    var apiPath = '/admin/accounting/timesheets/';
    var timesheetItemsPath = '/admin/accounting/timesheetitems/';
    var staffPath = '/admin/staff/';
    var staffSearchPath = '/admin/staff/search';
    var claimsPath = '/admin/claims/';
    var claimSearchPath = '/admin/claims/search';
    var vehicleTollPath = '/admin/vehicles/tolls/';
    var staffTimesheetPath = '/admin/staff/timesheets/';
    var self = this;

    self.error = {};
    self.error.showError = false;

    //Get the list of timesheets
    this.getTimesheetList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.timesheetList = response.data.Timesheets;
                    self.timesheetCount = response.data.TimesheetsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    //Get the a specific timesheet
    this.getTimesheet = function (id) {
        return $http.get(apiPath + id)
                .then(function (response) {
                    self.timesheetItems = response.data.Timesheet[1].TimesheetItems;
                    console.log(self.timesheetItems);
                    for (var i in self.timesheetItems) {
                        self.timesheetItems[i].regularHours = parseFloat(self.timesheetItems[i].regularHours);
                        self.timesheetItems[i].overtimeHours = parseFloat(self.timesheetItems[i].overtimeHours);
                        self.timesheetItems[i].doubleOTHours = parseFloat(self.timesheetItems[i].doubleOTHours);
                        self.timesheetItems[i].statRegularHours = parseFloat(self.timesheetItems[i].statRegularHours);
                        self.timesheetItems[i].statOTHours = parseFloat(self.timesheetItems[i].statOTHours);
                        self.timesheetItems[i].statDoubleOTHours = parseFloat(self.timesheetItems[i].statDoubleOTHours);
                        self.timesheetItems[i].totalHours = parseFloat(self.timesheetItems[i].totalHours);
                    }
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    //Get timesheet items for an ID
    this.getTimesheetItems = function (id, row, numRows) {
        return $http.get(timesheetItemsPath + id + '/' + row + '/' + numRows)
                .then(function (response) {
                    self.timesheetItems = response.data.Timesheets;
                });
    };

    //Search for a timesheet by name and workdate
    this.searchTimesheets = function (name, workDate) {
        var config = {};
        config.name = name;
        config.workDate = workDate;
        return $http({
            url: apiPath + 'search?',
            method: 'GET',
            params: config
        })
                .then(function (response) {
                    self.timesheetSearchCount = response.data.TimesheetsCount[0].rowCount;
                    self.timesheetSearchResults = response.data.Timesheets[0];
                    console.log(response.data.Timesheets[0]);
                });
    };

    //Staff Autocomplete
    this.autocomplete = function (searchObject) {
        var value = searchObject;
        var column = 'name';
        return $http.get(staffPath + 'search?' + column + '=' + value)
                .then(function (response) {
                    self.autocompleteList = response.data.Staffs;
                });
    };

    //Staff Search
    this.filterListBy = function (row, numRows, object) {
        var config = {};
        if (object) {
            var splitObject = object.split(' ');
            console.log(splitObject);

            if (object || splitObject.length === 1) {
                config.name = object;
            }
        } else {
            config = undefined;
        }

        return $http({
            url: staffSearchPath,
            method: 'GET',
            params: config
        })
                .then(function (response) {
                    self.searchResults = response.data.Staffs;
                    self.searchResultsCount = response.data.Staffs.length;
                });
    };

    //Claim Autocomplete
    this.claimsAutocomplete = function (searchObject) {
        var value = searchObject;
        var column = 'Claims_id';
        return $http.get(claimsPath + 'search?' + column + '=' + value)
                .then(function (response) {
                    self.claimsList = response.data.Claims;
                    self.claimsCount = response.data.ClaimsCount[0].numRows;
                });
    };

    //Claim Search
    this.filterClaims = function (row, numRows, object) {
        console.log(object);
        var config = {};
        if (object.val[0]) {
            config.claim = object.val[0];
        } else {
            config = undefined;
        }
        return $http({
            url: claimSearchPath,
            method: 'GET',
            params: config
        })
                .then(function (response) {
                });
    };


    //Save a Timesheet
    this.saveTimesheet = function (timesheet, timesheetItems, formToken) {
        console.log('saving timesheet...');
        var timesheetID = '';
        if (timesheet.Timesheet_id) {
            timesheetID = parseInt(timesheet.Timesheet_id);
        } else {
            timesheetID = '0';
        }
        var data = {};
        data.timesheet = timesheet;
        data.timesheetItems = timesheetItems;
        //data.tolls = tolls;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: staffTimesheetPath + timesheetID,
            data: data
        }).then(function (response) {
            console.log(response);
        });
    };

    //Get vehicle tolls
    this.getTolls = function (vehicleID) {
        return $http.get(vehicleTollPath + vehicleID)
                .then(function (response) {
                    self.vehicleTolls = response.data.VehicleTolls;
                });
    };

});
