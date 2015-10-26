var module = angular.module('accountingAdmin', ['ui.bootstrap']);


module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function (data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});

module.controller('costCardItemTypeCtrl', function ($scope, $modal, costCardItemTypeSrv, accountingTemplateSrv) {

    // Stuff to run on controller load
    $scope.rowsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.rowsPerPage);
    var numRows = $scope.rowsPerPage;


    $scope.getList = function (row) {
        costCardItemTypeSrv.getList(row, $scope.itemsPerPage).then(function (response) {
            $scope.costcardItemTypesList = costCardItemTypeSrv.costCardItemTypesList;
            $scope.costcardItemTypesCount = costCardItemTypeSrv.costcardItemTypesCount;

        });
    };

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardItemTypeSrv.create(object, formToken).then(function (response) {
            $scope.getList(row, numRows);
        });
    };

    var openModal = function (object) {
        var template = accountingTemplateSrv.costCardItemTypeModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'costCardItemTypeModalInstanceController',
            size: 'lg',
            resolve: {
                costcardItemType: function () {
                    return object;
                }
            }
        });

        modalInstance.result.then(function (object) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            costCardItemTypeSrv.save(object, formToken)
                    .then(function () {
                        $scope.getList(row, numRows);
                    });
        },
                function () {
                });
    };

    $scope.edit = function (object) {
        openModal(object);
    };

    $scope.addNew = function () {
        openModal();
    };

    $scope.delete = function (object) {
        var confirmed = confirm('Are you sure you want to delete ' + object.name + '?');
        if (confirmed) {
            costCardItemTypeSrv.delete(object).then(function () {
                $scope.getList(row);
            });
        }
    };

    $scope.$watch('currentPage + numPerPage', function () {
        row = (($scope.currentPage - 1) * $scope.rowsPerPage);
        numRows = $scope.rowsPerPage;

        $scope.getList(row, numRows);
    });
});

module.controller('costCardItemTypeModalInstanceController', function ($scope, $modalInstance, object) {
    $scope.costCardItemType = object;

    $scope.confirm = function () {
        $modalInstance.close($scope.costCardItemType);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});



// Pages controller

module.controller('pageTemplatesCtrl', function ($scope, $modal, pageTemplatesSrv, accountingTemplateSrv) {
    function getPageTemplatesList(row, numRows) {
        pageTemplatesSrv.getPageTemplatesList(row, numRows).then(function (response) {
            $scope.pageTemplatesList = pageTemplatesSrv.pageTemplatesList;
            $scope.totalItems = pageTemplatesSrv.pageTemplatesCount.rowCount;
        });
    }

    var openPageTemplateModal = function (pageTemplate) {
        var template = accountingTemplateSrv.pageTemplateModal;
        var modalInstance = $modal.open({
            templateUrl: template,
            controller: 'pageTemplateModalInstanceController',
            size: 'lg',
            resolve: {
                pageTemplate: function () {
                    return pageTemplate;
                }
            }
        });

        modalInstance.result.then(function (pageTemplate) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            pageTemplatesSrv.savePageTemplate(pageTemplate, formToken)
                    .then(function () {
                        getPageTemplatesList(row, numRows);
                    });
        },
                function () {
                });
    };

    $scope.addNewPageTemplate = function () {
        openPageTemplateModal();
    };

    $scope.editPageTemplate = function (pageTemplate) {
        openPageTemplateModal(pageTemplate);
    };

    $scope.deletePageTemplate = function (pageTemplate) {
        var confirmed = confirm('Are you sure you want to delete ' + pageTemplate.name + '?');
        if (confirmed) {
            pageTemplatesSrv.deletePageTemplate(pageTemplate)
                    .then(function () {
                        getPageTemplatesList(row, numRows);
                    });
        }
    };

    $scope.$watch('currentPage + numPerPage', function () {
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getPageTemplatesList(row, numRows);
    });

    $scope.itemsPerPage = 10;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
});

module.controller('pageTemplateModalInstanceController', function ($scope, $modalInstance, pageTemplate, pageTemplatesSrv) {
    $scope.pageTemplate = pageTemplate;

    var getUnusedWidgets = function (pageTemplate) {
        pageTemplatesSrv.getUnusedWidgets(pageTemplate)
                .then(function (response) {
                    $scope.unusedWidgetList = pageTemplatesSrv.unusedWidgetList;
                });
    };

    var getWidgetsOnPageTemplate = function (pageTemplate) {
        if (pageTemplate) {
            pageTemplatesSrv.getWidgetsOnPageTemplate(pageTemplate)
                    .then(function () {
                        $scope.widgetsOnPage = pageTemplatesSrv.widgetsOnPage;
                    });
        }
    };

    $scope.getWidgetByName = function (widgetName) {
        for (var widget in $scope.unusedWidgetList) {
            if ($scope.unusedWidgetList.hasOwnProperty(widget)) {
                if ($scope.unusedWidgetList[widget].name === widgetName) {
                    $scope.widgetObjectToAdd = $scope.unusedWidgetList[widget];
                }
            }
        }
    };

    $scope.addWidgetToPage = function (pageTemplate, object, sectionName, ymlKey) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        pageTemplatesSrv.addWidgetToPage(pageTemplate, object, sectionName, ymlKey, formToken)
                .then(function (response) {
                    $scope.widgetToAdd = undefined;
                    document.getElementById('widgetToAdd').value = '';
                    getWidgetsOnPageTemplate($scope.pageTemplate);
                    getUnusedWidgets();
                });
    };

    $scope.removeWidgetFromPage = function (widget) {
        var confirmed = confirm('Do you want to remove ' + widget.name + '?');
        if (confirmed) {
            pageTemplatesSrv.removeWidgetFromPage($scope.pageTemplate, widget)
                    .then(function (response) {
                        getWidgetsOnPageTemplate($scope.pageTemplate);
                        getUnusedWidgets();
                    });
        }
    };

    $scope.saveAndContinue = function (pageTemplate) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        pageTemplatesSrv.savePageTemplate(pageTemplate, formToken).then(function (response) {
            $scope.pageTemplate = response.data.WidgetPage[0];
        });
    };

    $scope.confirm = function () {
        $modalInstance.close($scope.pageTemplate);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    getWidgetsOnPageTemplate(pageTemplate);
    getUnusedWidgets(pageTemplate);
});

module.service('costCardItemTypeSrv', function ($http) {

    var apiPath = '/super/accounting/costcarditemtypes';

    var self = this;

    this.save = function (object, formToken) {
        var requestPath;
        if (!object.id) {
            requestPath = apiPath + '/0';
        } else {
            requestPath = apiPath + '/' + object.id;
        }
        var data = {};
        data.CostCardItemType = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: requestPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };

    this.toggleEditing = function (object) {
        if (object.editing) {
            object.editing = false;
        } else {
            object.editing = true;
        }
    };

    this.getList = function (row, numRows) {

        return $http.get(apiPath + '/' + row + '/' + numRows)
                .then(function (response) {
                    self.costCardItemTypesList = response.data.CostCardItemTypes;
                    self.costCardItemTypesCount = response.data.CostCardItemTypesCount[0].rowCount;
                    return {
                        pagination: response.data.pagination
                    };
                });
    };

    this.delete = function (object) {
        var requestPath = apiPath + '/remove/' + object.id;
        return $http.delete(requestPath);
    };
});

module.service('accountingTemplateSrv', function () {
    this.costCardItemTypeModal = '/render/accounting/CostCardItemTypeModal';
    //this.widgetModal = '/render/accounting/CostCardItemTypeModal';
});


// Pages service

module.service('pageTemplatesSrv', function ($http) {

    var apiPath = '/super/widgets/pages';

    var self = this;

    this.savePageTemplate = function (object, formToken) {
        var requestPath;
        if (!object.id) {
            requestPath = apiPath + '/0';
        } else {
            requestPath = apiPath + '/' + object.id;
        }
        var data = {};
        object.isSystemPage = 1;
        data.WidgetPage = object;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: requestPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).then(function (response) {
            return response;
        });
    };

    this.getPageTemplatesList = function (row, numRows) {
        return $http.get(apiPath + '/' + row + '/' + numRows)
                .then(function (response) {
                    self.pageTemplatesList = response.data.WidgetPages;
                    self.pageTemplatesCount = response.data.WidgetPagesCount[0];
                });
    };

    this.getWidgetsOnPageTemplate = function (pageTemplate) {
        return $http.get(apiPath + '/widgets/' + pageTemplate.id)
                .then(function (response) {
                    var widgets = [];
                    for (var section in response.data) {
                        if (response.data.hasOwnProperty(section)) {
                            if (section !== "widgets/super_widgetpages_widgets_list" &&
                                    section !== "modules") {
                                for (var widget in response.data[section]) {
                                    if (response.data[section].hasOwnProperty(widget)) {
                                        response.data[section][widget].sectionName = section;
                                        widgets.push(response.data[section][widget]);
                                    }
                                }
                            }
                        }
                    }
                    self.widgetsOnPage = widgets;
                });
    };

    this.getUnusedWidgets = function (pageTemplate) {
        if (!pageTemplate) {
            return $http.get('/super/widgets/unassigned/all/0')
                    .then(function (response) {
                        self.unusedWidgetList = response.data.Widgets;
                    });
        }
        return $http.get('/super/widgets/unassigned/all/' + pageTemplate.id)
                .then(function (response) {
                    self.unusedWidgetList = response.data.Widgets;
                });
    };

    this.addWidgetToPage = function (pageTemplate, object, sectionName, ymlKey, formToken) {
        var requestPath = apiPath + '/widgets/' + pageTemplate.id;
        var data = {};
        data.WidgetPageWidget = {};
        data.WidgetPageWidget.Widgets_id = object.Widgets_id;
        data.WidgetPageWidget.ymlKey = ymlKey;
        data.WidgetPageWidget.sectionName = sectionName;
        data.FORM_SECURITY_TOKEN = formToken;
        return $http({
            method: 'POST',
            url: requestPath,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
    };

    this.removeWidgetFromPage = function (pageTemplate, widget) {
        var requestPath = apiPath + '/widgets/remove/' + pageTemplate.ymlKey + '/' + widget.id;
        return $http.delete(requestPath);
    };

    this.deletePageTemplate = function (pageTemplate) {
        var requestPath = apiPath + '/remove/' + pageTemplate.id;
        return $http.delete(requestPath);
    };

});
module.service('accountingTemplateSrv', function () {
    this.timesheetModal = '/render/accounting/timesheetModal';
    this.generalCostsModal = '/render/accounting/generalCostsModal';
    this.inventoryModal = '/render/accounting/inventoryModal';
});
module.controller('generalCostsModalCtrl', function ($modalInstance, $scope, generalCostsModalSrv, $filter, generalCost) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = [];

    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    //console.log(generalCost);
    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    //Set up the objects
    var generalCostItemsTemplate = {
        isSelected: false,
        id: '',
        name: '',
        description: '',
        dateEntered: '',
        Departments_id: '',
        cost: '',
        chargeOut: '',
        AccountingDebitAccounts_id: '',
        isApproved: '0',
        isCancelled: '0',
        isExported: '0'
    };
    $scope.AccountingGeneralCost = {
        id: '',
        Claims_id: '',
        ClaimPhases_id: '',
        AccountingCreditAccounts_id: '',
        jobNumber: ''
    };

    if (generalCost) {
        $scope.loading = true;
        generalCostsModalSrv.getGeneralCostItems(row, numRows, generalCost.id)
                .then(function () {
                    console.log(generalCostsModalSrv.generalCostItems);
                    var costItems = generalCostsModalSrv.generalCostItems;
                    for (var i in costItems) {
                        //costItems[i].dateEntered = Date.parse((costItems[i].dateEntered.replace(/-/g,"/")));
                        costItems[i].dateEntered = new Date(costItems[i].dateEntered);
                        costItems[i].cost = parseFloat(costItems[i].cost);
                        costItems[i].chargeOut = parseFloat(costItems[i].chargeOut);
                    }
                    $scope.AccountingGeneralCost = generalCost;
                    $scope.generalCostItems = costItems;
                    console.log($scope.generalCostItems);
                    $scope.loading = false;
                });
    } else {
        $scope.loading = false;
        $scope.generalCostItems = angular.copy([generalCostItemsTemplate]);
    }

    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function (jobNumber) {
        for (var i in generalCostsModalSrv.autocomplete) {
            if (generalCostsModalSrv.autocomplete[i].label === jobNumber) {
                $scope.AccountingGeneralCost.Claims_id = generalCostsModalSrv.autocomplete[i].id;
            }
        }
    };

    //---Table Controls---
    //Add a row    
    $scope.addRow = function () {
        $scope.generalCostItems.push(angular.copy(generalCostItemsTemplate));
    };

    //Insert rows below currently selected items
    $scope.insertRows = function () {
        for (var i in $scope.generalCostItems) {
            if ($scope.generalCostItems[i].isSelected === true) {
                $scope.generalCostItems.splice(parseInt(i) + 1, 0, angular.copy(generalCostItemsTemplate));
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeRows = function () {
        for (var i = $scope.generalCostItems.length - 1; i >= 0; i--) {
            if ($scope.generalCostItems[i].isSelected === true) {
                $scope.generalCostItems.splice(parseInt(i), 1);
            }
        }
    };

    //Check selected
    $scope.checkSelected = function () {
        $scope.rowSelected = true;
        for (var index in $scope.generalCostItems) {
            if ($scope.generalCostItems[index].isSelected === true) {
                $scope.rowSelected = true;
            }
        }
    };

    //Select All
    $scope.selectAllToggle = function (value) {
        for (var i in $scope.generalCostItems) {
            if (value === true) {
                $scope.generalCostItems[i].isSelected = true;
            } else {
                $scope.generalCostItems[i].isSelected = false;
            }
        }
    };

    //Typeahead
    $scope.fetchStaffAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return generalCostsModalSrv.fetchAutocomplete(searchObject);
    };

    $scope.fetchClaimAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.Claims_id = viewVal;
        return generalCostsModalSrv.fetchClaimsAutocomplete(searchObject);
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event, index) {
        $scope.isOpen.datepicker[index] = true;
    };

    //Saving Items    
    $scope.saveGeneralCostItems = function () {
        var generalCostItems = angular.copy($scope.generalCostItems);
        for (var i in generalCostItems) {
            console.log('filtering date!');
            generalCostItems[i].dateEntered = $filter('date')(generalCostItems[i].dateEntered, 'yyyy-MM-dd');
        }
        console.log('Saving Items!');

        //$scope.AccountingGeneralCost.AccountingGeneralCostItems = generalCostItems;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        generalCostsModalSrv.saveGeneralCosts($scope.AccountingGeneralCost, generalCostItems, formToken);

        console.log($scope.AccountingGeneralCost);
        console.log($scope.generalCostItems);
    };
});
// General Costs Modal service
module.service('generalCostsModalSrv', function ($http, $filter, searchSrv) {
    var generalCostsPath = '/admin/accounting/generalcosts/';
    var generalCostItemsPath = '/admin/accounting/generalcostitems/';
    var staffPath = '/admin/staff/';
    var claimsPath = '/admin/claims/';
    //Typeahead autocomplete
    var self = this;

    this.fetchAutocomplete = function (searchObject) {
        console.log('fetching typeahead autocomplete...');
        return searchSrv.fetchAutocomplete(searchObject, staffPath).then(function () {
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

    this.fetchClaimsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, claimsPath).then(function () {
            self.autocomplete = searchSrv.autocomplete;
            self.autocompleteValues = [];
            for (var item in self.autocomplete) {
                if (!isNaN(item / 1)) {
                    self.autocompleteValues.push(self.autocomplete[item].label);
                }
            }
            if (self.autocompleteValues.length > 0 && self.autocompleteValues[0] !== 'undefined undefined') {
                return self.autocompleteValues;
            } else if (self.autocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    //Get the list of general cost items
    this.getGeneralCostItems = function (row, numRows, id) {
        return $http.get(generalCostItemsPath + row + '/' + numRows + '/?AccountingGeneralCosts_id=' + id)
                .then(function (response) {
                    self.generalCostItems = response.data.AccountingGeneralCostItems;
                    self.generalCostsCount = response.data.AccountingGeneralCostItemsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    //Save the general cost items
    this.saveGeneralCosts = function (generalCosts, generalCostItems, formToken) {
        console.log('saving general cost items...');
        var generalCostID = '';
        if (generalCosts.id) {
            generalCostID = parseInt(generalCosts.id);
        } else {
            generalCostID = '0';
        }

        //Loop through the objects and delete any null values
        for (var i in generalCosts) {
            if (generalCosts[i] === null) {
                delete generalCosts[i];
            }
        }

        for (var j in generalCostItems) {
            for (var p in generalCostItems[j]) {
                if (generalCostItems[j][p] === null) {
                    console.log(p + ' is null!');
                    delete generalCostItems[j][p];
                }
            }
        }

        var data = {};
        data.GeneralCost = generalCosts;
        data.AccountingGeneralCostItems = generalCostItems;
        data.FORM_SECURITY_TOKEN = formToken;

        console.log(data);

        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: generalCostsPath + generalCostID,
            data: data
        }).then(function (response) {
            console.log(response);
        });
    };
});
// General Costs service
module.service('generalCostsSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/generalcosts/';
    var generalCostItemsPath = '/admin/accounting/generalcostitems/';

    var self = this;

    self.error = {};
    self.error.showError = false;

    //Get the list of general cost items
    this.getGeneralCostsList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    console.log(response);
                    self.generalCostsList = response.data.AccountingGeneralCosts;
                    self.generalCostsCount = response.data.AccountingGeneralCostsCount[0].rowCount;

                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    //Get the list of general cost items
    this.getGeneralCostItems = function (row, numRows, id) {
        return $http.get(generalCostItemsPath + row + '/' + numRows + '/?AccountingGeneralCosts_id=' + id)
                .then(function (response) {
                    self.generalCostItems = response.data.AccountingGeneralCostItems;
                    self.generalCostsCount = response.data.AccountingGeneralCostItemsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    this.search = function (searchObject) {
        var config = {};
        return $http({
            url: apiPath + 'search?name=' + searchObject,
            method: 'GET'
        }).then(function (response) {
            self.searchResults = response.data.AccountingGeneralCosts;
            self.searchResultsCount = response.data.AccountingGeneralCostsCount[0].rowCount;
        });
    };

    this.advancedSearch = function (searchObject) {
        var config = angular.copy(searchObject);
        config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
        config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
        return $http({
            url: apiPath + 'search?',
            method: 'GET',
            params: config
        })
                .then(function (response) {
                    self.advancedSearchResults = response.data.AccountingGeneralCosts;
                    self.advancedSearchResultsCount = response.data.AccountingGeneralCostsCount[0].rowCount;
                });
    };
});
module.controller('generalCostsListCtrl', function ($scope, costCardItemTypeSrv, accountingTemplateSrv, generalCostsSrv, $modal) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.advSearch = {};
    $scope.autocomplete = {};
    $scope.isOpen = {};
    $scope.isOpen.datepicker = {};
    $scope.isOpen.datepicker.fromDate = false;
    $scope.isOpen.datepicker.toDate = false;


    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    function getGeneralCostsList() {
        $scope.loading = true;
        $scope.noSearchResults = false;

        generalCostsSrv.getGeneralCostsList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.generalCostsList = generalCostsSrv.generalCostsList;
                    $scope.totalItems = generalCostsSrv.generalCostsCount;
                    console.log($scope.totalItems);
                    if (generalCostsSrv.error.showError === true) {
                        $scope.error.showError = true;
                        //$scope.error.message = 'Could not reach the database, please try again.';
                    }
                });
    }

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getGeneralCostsList(row, numRows);
    });

    //Select Rows for breakdown view
    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            generalCostsSrv.getGeneralCostItems(row, numRows, clickedObject.id)
                    .then(function () {
                        //                    $scope.sidePanelOpen = true;
                        $scope.selectedRow = clickedObject;
                        $scope.rowBreakdown = generalCostsSrv.generalCostItems;
                        $scope.sidePanelLoading = false;
                    });
        }
    };

    $scope.closeSidePanel = function () {
//        if ($scope.searching) {
//            $scope.searching = false;
//        }
//        if ($scope.selectedStaff) {
//            $scope.selectedStaff = undefined;
//            $scope.previouslyClickedObject = undefined;
//        }
//        if (!$scope.selectedStaff && !$scope.searching) {
//            $scope.sidePanelOpen = false;
//            $scope.previouslyClickedObject = {};
//        }
        $scope.sidePanelOpen = false;
        $scope.isOpen.datepicker.fromDate = false;
        $scope.isOpen.datepicker.toDate = false;
    };

    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            generalCostsSrv.search(copiedObject).then(function () {
                $scope.generalCostsList = generalCostsSrv.searchResults;
                $scope.totalItems = generalCostsSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.advancedSearch = function (searchObject) {
        $scope.loading = true;
        $scope.noSearchResults = false;
        generalCostsSrv.advancedSearch(searchObject).then(function () {
            $scope.generalCostsList = generalCostsSrv.advancedSearchResults;
            $scope.totalItems = generalCostsSrv.advancedSearchResultsCount;
            if ($scope.totalItems === '0') {
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = '';
        getGeneralCostsList();
    };

    $scope.autoSearch = function (searchString) {
        if (searchString.length >= 3) {
            $scope.search(searchString);
        }
    };

    $scope.resetAdvancedSearch = function () {
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getGeneralCostsList();
    };

    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};

    $scope.openDatepicker = function (event, datepicker) {
        $scope.isOpen.datepicker[datepicker] = true;
    };

    //Modal
    $scope.openGeneralCostsModal = function (generalCost) {
        console.log(generalCost);
        $scope.modalLoading = true;
        var template = accountingTemplateSrv.generalCostsModal;
        var modal = $modal.open({
            templateUrl: template,
            controller: 'generalCostsModalCtrl',
            size: 'lg',
            resolve: {
                generalCost: function () {
                    return generalCost;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function () {
            getGeneralCostsList();
        });
    };
});
module.controller('inventoryCtrl', function ($scope, costCardItemTypeSrv, accountingTemplateSrv, inventorySrv, $modal, tablesSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.advSearch = {};
    $scope.isOpen = {};
    $scope.isOpen.datepicker = {};
    $scope.isOpen.datepicker.fromDate = false;
    $scope.isOpen.datepicker.toDate = false;
    $scope.basicSearch.query = '';
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.list = tablesSrv.sortResult.SuppliesUseds;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.SuppliesUseds'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.SuppliesUseds)
                $scope.list = tablesSrv.groupResult.SuppliesUseds;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getList();
        }
    });

    function getList() {
        $scope.loading = true;
        $scope.noSearchResults = false;
        inventorySrv.getList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.list = inventorySrv.list;
                    $scope.totalItems = inventorySrv.listRowCount;
                    if (inventorySrv.error.showError === true) {
                        $scope.error.showError = true;
                    }
                });
    }

    $scope.$watch('basicSearch.query', function () {
        if ($scope.basicSearch.query.length === 0) {
            getList();
        }
    });

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getList(row, numRows);
    });

    //Select Rows for breakdown view
    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            inventorySrv.getBreakdown(row, numRows, clickedObject.id)
                    .then(function () {
                        $scope.selectedRow = clickedObject;
                        $scope.rowBreakdown = inventorySrv.breakdownItems;
                        $scope.sidePanelLoading = false;
                    });
        } else {
            $scope.previouslyClickedObject = '';
            $scope.sidePanelOpen = false;
            $scope.sidePanelLoading = false;
        }
    };

    $scope.closeSidePanel = function () {
        $scope.sidePanelOpen = false;
        $scope.isOpen.datepicker.fromDate = false;
        $scope.isOpen.datepicker.toDate = false;
        $scope.previouslyClickedObject = '';
    };

    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            inventorySrv.search(copiedObject).then(function () {
                $scope.list = inventorySrv.searchResults;
                $scope.totalItems = inventorySrv.searchResultsCount;
                if ($scope.totalItems === 0) {
                    $scope.noSearchResults = true;
                }
                $scope.loading = false;
            });
        }
    };

    $scope.advancedSearch = function (searchObject) {
        $scope.loading = true;
        $scope.noSearchResults = false;
        inventorySrv.advancedSearch(searchObject).then(function () {
            $scope.list = inventorySrv.advancedSearchResults;
            $scope.totalItems = inventorySrv.advancedSearchResultsCount;
            if ($scope.totalItems === 0) {
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.noSearchResults = false;
        $scope.basicSearch.query = '';
        getList();
    };

    $scope.autoSearch = function (searchString) {
        if (searchString.length >= 3) {
            $scope.search(searchString);
        }
    };

    $scope.resetAdvancedSearch = function () {
        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getList();
    };

    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
        $scope.previouslyClickedObject = '';
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};

    $scope.openDatepicker = function (event, datepicker) {
        $scope.isOpen.datepicker[datepicker] = true;
    };

    //Modal
    $scope.openModal = function (item) {
        $scope.modalLoading = true;
        var template = accountingTemplateSrv.inventoryModal;
        var modal = $modal.open({
            templateUrl: template,
            controller: 'inventoryModalCtrl',
            size: 'lg',
            resolve: {
                suppliesUsed: function () {
                    return item;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function () {
            getList();
        });
    };
});
module.controller('inventoryModalCtrl', function ($modalInstance, $scope, inventoryModalSrv, $filter, $timeout, suppliesUsed) {
    $scope.isOpen = {};
    $scope.isOpen.datepicker = false;

    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close();
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    //Set up the objects
    var headingsTemplate = {
        //$scope.headings = {
        staffName: '',
        Staff_id: '',
        Claims_id: '',
        ClaimPhases_id: '',
        dateUsed: '',
        ClaimsLocations_id: '',
        Departments_id: ''
    };

    var lineItemsTemplate = {
        SuppliesUsedInventoryItems_id: '',
        isSelected: false,
        productCode: '',
        InventoryItems_id: '',
        name: '',
        PackageTypes_id: '',
        unitPrice: '',
        quantity: '',
        cost: '',
        chargeOut: ''
    };

    $scope.total = {
        cost: 0,
        chargeOut: 0
    };

    //Get the claims locations
    $scope.getClaimsLocations = function (Claims_id) {
        inventoryModalSrv.getClaimsLocations($scope.headings.Claims_id).then(function (locations) {
            $scope.claimsLocations = locations;
        });
    };

    //Check and see if you're editing an item or creating a new one...
    if (suppliesUsed) {
        $scope.loading = true;
        suppliesUsed.dateUsed = new Date(suppliesUsed.dateUsed);
        $scope.headings = suppliesUsed;
        $scope.headings.staffName = $scope.headings.firstname + ' ' + $scope.headings.lastname;
        $scope.getClaimsLocations($scope.headings.ClaimsLocations_id);
        inventoryModalSrv.getItems(row, numRows, suppliesUsed.id)
                .then(function () {
                    var lineItems = inventoryModalSrv.lineItems;
                    for (var i in lineItems) {
                        lineItems[i].cost = parseFloat(lineItems[i].cost);
                        lineItems[i].chargeOut = parseFloat(lineItems[i].chargeOut);
                        lineItems[i].quantity = parseFloat(lineItems[i].quantity);
                        lineItems[i].unitPrice = parseFloat(lineItems[i].purchaseCost);
                    }
                    $scope.lineItems = lineItems;
                    $scope.updateTotal();
                    $scope.loading = false;
                });
    } else {
        $scope.loading = false;
        $scope.headings = angular.copy(headingsTemplate);
        $scope.lineItems = angular.copy([lineItemsTemplate]);
    }


    //Get Staff ID from autocomplete list
    $scope.getStaffID = function (name) {
        if (name !== undefined) {
            var splitName = name.split(' ');
            for (var i in inventoryModalSrv.autocomplete) {
                if (splitName[0] === inventoryModalSrv.autocomplete[i].firstname && splitName[1] === inventoryModalSrv.autocomplete[i].lastname) {
                    $scope.headings.Staff_id = inventoryModalSrv.autocomplete[i].id;
                }
            }
        }
    };

    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function (jobNumber) {
        for (var i in inventoryModalSrv.claimsAutocomplete) {
            if (inventoryModalSrv.claimsAutocomplete[i].jobNumber === jobNumber) {
                $scope.headings.Claims_id = inventoryModalSrv.claimsAutocomplete[i].id;
                $scope.getClaimsLocations($scope.headings.Claims_id);
            }
        }
    };

    //---Table Controls---
    //Add a row    
    $scope.addRow = function () {
        $scope.lineItems.push(angular.copy(lineItemsTemplate));
    };

    //Insert rows below currently selected items
    $scope.insertRows = function () {
        for (var i in $scope.lineItems) {
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i) + 1, 0, angular.copy(lineItemsTemplate));
            }
        }
    };

    //Remove Rows from timesheet
    $scope.removeRows = function () {
        for (var i = $scope.lineItems.length - 1; i >= 0; i--) {
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i), 1);
            }
        }
    };

    //Check selected
    $scope.checkSelected = function () {
        $scope.rowSelected = true;
        for (var index in $scope.lineItems) {
            if ($scope.lineItems[index].isSelected === true) {
                $scope.rowSelected = true;
            }
        }
    };

    //Select All
    $scope.selectAllToggle = function (value) {
        for (var i in $scope.lineItems) {
            if (value === true) {
                $scope.lineItems[i].isSelected = true;
            } else {
                $scope.lineItems[i].isSelected = false;
            }
        }
    };

    //Staff Typeahead
    $scope.fetchStaffAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return inventoryModalSrv.fetchStaffAutocomplete(searchObject);
    };

    //Claim Typeahead
    $scope.fetchClaimAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return inventoryModalSrv.fetchClaimsAutocomplete(searchObject);
    };

    //Materials Typeahead
    $scope.fetchMaterialsAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return inventoryModalSrv.fetchMaterialNameAutocomplete(searchObject);
    };

    //Product Code Typeahead
    $scope.fetchProductCodeAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.productCode = viewVal;
        return inventoryModalSrv.fetchProductCodeAutocomplete(searchObject);
    };

    //Get Material info from material name
    $scope.getMaterialNameInfo = function (row, value) {
        for (var j in inventoryModalSrv.materialsAutocomplete) {
            if (inventoryModalSrv.materialsAutocomplete[j].name === value) {
                row.productCode = inventoryModalSrv.materialsAutocomplete[j].productCode;
                row.unitPrice = inventoryModalSrv.materialsAutocomplete[j].purchaseCost;
                row.PackageTypes_id = inventoryModalSrv.materialsAutocomplete[j].PackageTypes_id;
            }
        }
    };

    //Get Material info from product code
    $scope.getProductCodeInfo = function (row, value) {
        for (var i in inventoryModalSrv.productCodeAutocomplete) {
            if (inventoryModalSrv.productCodeAutocomplete[i].productCode === value) {
                row.name = inventoryModalSrv.productCodeAutocomplete[i].name;
                row.unitPrice = inventoryModalSrv.productCodeAutocomplete[i].purchaseCost;
                row.PackageTypes_id = inventoryModalSrv.productCodeAutocomplete[i].PackageTypes_id;
                row.InventoryItems_id = inventoryModalSrv.productCodeAutocomplete[i].id;
            }
        }
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event, index) {
        $scope.isOpen.datepicker = true;
    };


    //Update cost based on item quantity and price
    $scope.updateCost = function (row) {
        if (row.quantity === null || row.unitPrice === null) {
            row.cost = '';
            return;
        }
        if (row.quantity && row.unitPrice) {
            row.cost = row.quantity * row.unitPrice;
        }
    };

    //Update totals
    $scope.updateTotal = function () {
        $scope.total = {
            cost: 0,
            chargeOut: 0
        };
        for (var i in $scope.lineItems) {
            if (isNaN($scope.lineItems[i].cost)) {
                $scope.lineItems[i].cost = 0;
            }
            if (isNaN($scope.lineItems[i].chargeOut)) {
                $scope.lineItems[i].chargeOut = 0;
            }
            $scope.total.cost += $scope.lineItems[i].cost;
            $scope.total.chargeOut += $scope.lineItems[i].chargeOut;
        }
    };

    //Saving Items    
    $scope.save = function () {
        var headings = angular.copy($scope.headings);
        var lineItems = angular.copy($scope.lineItems);
        headings.dateUsed = $filter('date')(headings.dateUsed, 'yyyy-MM-dd');
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryModalSrv.save(headings, lineItems, formToken);

    };

    $scope.clearModal = function () {
        $scope.headings = angular.copy(headingsTemplate);
        $scope.lineItems = angular.copy([lineItemsTemplate]);
    };
});
// General Costs service
module.service('inventoryModalSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/supplies/';
    var staffPath = '/admin/staff/';
    var claimsPath = '/admin/claims/';
    var materialsPath = '/admin/inventory/materials';
    var autocompletePath = '/admin/inventory/items/autocomplete';
    var claimsLocationsPath = '/admin/claims/locations/';
    var suppliesUsedPath = '/admin/accounting/suppliesused/';

    var self = this;

    this.getItems = function (row, numRows, id) {
        return $http.get(suppliesUsedPath + id)
                .then(function (response) {
                    self.lineItems = response.data.SuppliesUsedInventoryItems;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    this.fetchStaffAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, staffPath).then(function () {
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

    this.fetchClaimsAutocomplete = function (searchObject) {
        return searchSrv.fetchAutocomplete(searchObject, claimsPath).then(function () {
            self.claimsAutocomplete = searchSrv.autocomplete.Claims;
            self.claimsAutocompleteValues = [];
            for (var item in self.claimsAutocomplete) {
                if (!isNaN(item / 1)) {
                    self.claimsAutocompleteValues.push(self.claimsAutocomplete[item].jobNumber);
                }
            }
            if (self.claimsAutocompleteValues.length > 0 && self.claimsAutocompleteValues[0] !== 'undefined undefined') {
                return self.claimsAutocompleteValues;
            } else if (self.claimsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    this.fetchMaterialNameAutocomplete = function (searchObject) {
        var config = {};
        config.name = searchObject.name;
        return $http({
            method: 'GET',
            url: autocompletePath,
            params: config
        }).then(function (response) {
            self.materialsAutocompleteValues = [];
            self.materialsAutocomplete = response.data.InventoryItems;
            for (var i in response.data.InventoryItems) {
                self.materialsAutocompleteValues.push(response.data.InventoryItems[i].name);
            }
            if (self.materialsAutocompleteValues.length > 0 && self.materialsAutocompleteValues[0] !== 'undefined undefined') {
                return self.materialsAutocompleteValues;
            } else if (self.materialsAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    this.fetchProductCodeAutocomplete = function (searchObject) {
        var config = {};
        config.productCode = searchObject.productCode;
        return $http({
            method: 'GET',
            url: autocompletePath,
            params: config
        }).then(function (response) {
            self.productCodeAutocompleteValues = [];
            self.productCodeAutocomplete = response.data.InventoryItems;
            for (var i in response.data.InventoryItems) {
                self.productCodeAutocompleteValues.push(response.data.InventoryItems[i].productCode);
            }
            if (self.productCodeAutocompleteValues.length > 0 && self.productCodeAutocompleteValues[0] !== 'undefined undefined') {
                return self.productCodeAutocompleteValues;
            } else if (self.productCodeAutocompleteValues[0] === 'undefined undefined') {
                return undefined;
            }
        });
    };

    this.getClaimsLocations = function (Claims_id) {
        return $http({
            method: 'GET',
            url: claimsLocationsPath + Claims_id
        }).then(function (response) {
            return response.data.ClaimsLocations;
        });
    };

    //Save the general cost items
    this.save = function (headings, lineItems, formToken) {
        var itemID = '';
        if (headings.id) {
            itemID = parseInt(headings.id);
        } else {
            itemID = '0';
        }

        for (var i in headings) {
            if (headings[i] === null) {
                delete headings[i];
            }
        }

        var data = {};
        data.SuppliesUsed = headings;
        data.InventoryItems = lineItems;
        data.FORM_SECURITY_TOKEN = formToken;

        return $http({
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + itemID,
            data: data
        }).then(function (response) {
            //console.log(response);
        });
    };
});
// General Costs service
module.service('inventorySrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/supplies/';

    var self = this;

    self.error = {};
    self.error.showError = false;

    //Get the list of inventory items
    this.getList = function (row, numRows) {
        return $http.get(apiPath + row + '/' + numRows)
                .then(function (response) {
                    self.list = response.data.SuppliesUseds;
                    self.listRowCount = response.data.SuppliesUsedsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    //Get the breakdown of the selected item
    this.getBreakdown = function (row, numRows, id) {
        return $http.get(apiPath + id)
                .then(function (response) {
                    self.breakdownItems = response.data.InventoryItems;
                    self.generalCostsCount = response.data.InventoryItemsCount[0].rowCount;
                }, function (response) {
                    //Handle any errors
                    self.error.showError = true;
                });
    };

    this.search = function (searchObject) {
        var config = {};
        return $http({
            url: apiPath + 'search?name=' + searchObject,
            method: 'GET'
        }).then(function (response) {
            self.searchResults = response.data.SuppliesUseds;
            self.searchResultsCount = response.data.SuppliesUsedsCount[0].rowCount;
        });
    };

    this.advancedSearch = function (searchObject) {
        var config = angular.copy(searchObject);
        for (var i in config) {
            if (config[i] === null || config[i] === '') {
                delete config[i];
            }
        }
        config.toDate = $filter('date')(config.toDate, 'yyyy-MM-dd', '+0000');
        config.fromDate = $filter('date')(config.fromDate, 'yyyy-MM-dd', '+0000');
        return $http({
            url: apiPath + 'search?',
            method: 'GET',
            params: config
        })
                .then(function (response) {
                    self.advancedSearchResults = response.data.SuppliesUseds;
                    self.advancedSearchResultsCount = response.data.SuppliesUsedsCount[0].rowCount;
                });
    };
});
module.controller('timesheetListCtrl', function ($scope, $modal, costCardItemTypeSrv, accountingTemplateSrv, timesheetSrv) {
    // Stuff to run on controller load
    //$scope.rowsPerPage = 20;
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.isOpen = {};

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    function getTimesheetList() {
        $scope.loading = true;
        $scope.noSearchResults = false;

        timesheetSrv.getTimesheetList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.timesheetList = timesheetSrv.timesheetList;
                    $scope.totalItems = timesheetSrv.timesheetCount;

                    if (timesheetSrv.error.showError === true) {
                        $scope.error.showError = true;
                        //$scope.error.message = 'Could not reach the database, please try again.';
                    }
                });
    }

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        getTimesheetList(row, numRows);
    });

    //Modals
    $scope.openTimesheetModal = function (timesheet) {
        $scope.modalLoading = true;

        var template = accountingTemplateSrv.timesheetModal;

        var modal = $modal.open({
            templateUrl: template,
            controller: 'timesheetModalCtrl',
            size: 'lg',
            resolve: {
                timesheet: function () {
                    return timesheet;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function (timesheet) {
            getTimesheetList();
        });
    };

    //Select Rows for breakdown view
    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelOpen = true;
            $scope.sidePanelLoading = true;
            timesheetSrv.getTimesheetDetail(clickedObject)
                    .then(function () {
//                    $scope.sidePanelOpen = true;
                        $scope.selectedTimesheet = clickedObject;
                        $scope.timesheetBreakdown = timesheetSrv.timesheetBreakdown;
                        $scope.sidePanelLoading = false;
                    });
        }
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
            $scope.previouslyClickedObject = {};
        }
        $scope.isOpen.datepicker = false;
    };

    //Typeahead
    $scope.fetchAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return timesheetSrv.fetchAutocomplete(searchObject);
    };

    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            timesheetSrv.search(copiedObject).then(function () {
                $scope.timesheetList = timesheetSrv.searchResults;
                $scope.totalItems = timesheetSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.advancedSearch = function (searchObject) {
        $scope.loading = true;
        $scope.noSearchResults = false;
        timesheetSrv.advancedSearch(searchObject).then(function () {
            $scope.timesheetList = timesheetSrv.advancedSearchResults;
            $scope.totalItems = timesheetSrv.advancedSearchResultsCount;
            if ($scope.totalItems === '0') {
                $scope.noSearchResults = true;
            }
            $scope.loading = false;
        });
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getTimesheetList();
    };

    $scope.resetAdvancedSearch = function () {

        $scope.searchSubmitted = false;
        $scope.advSearch = {};
        getTimesheetList();
    };

    $scope.openTimesheetAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedTimesheet = undefined;
        $scope.searching = true;
    };

    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (eventz) {
        $scope.isOpen.datepicker = true;
    };
});

module.controller('timesheetModalCtrl', function ($modalInstance, $scope, timesheetSrv, $filter, timesheet) {
    $scope.basicSearch = {};
    $scope.autocomplete = {};
    $scope.autocomplete.loading = false;
    $scope.hourlyRate = 0;
    $scope.timesheetItems = [];
    $scope.timesheetSelected = false;
    //Modal Controls
    $scope.confirm = function () {
        $modalInstance.close($scope.timesheet);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    //Get the dates
    $scope.getDates = function () {
        var date = new Date();
        $scope.yesterday = date;
    };

    //Call getDates
    $scope.getDates();

    //Laborer Autocomplete
    function fetchAutocomplete() {
        if ($scope.laborer.search(' ') === -1) {
            timesheetSrv.staffAutocomplete($scope.laborer)
                    .then(function () {
                        $scope.autocomplete = timesheetSrv.autocompleteList;
                    });
        }
    }

    $scope.$watch('laborer', function () {
        //$scope.autocomplete = {};
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
        var date = $filter('date')(workDate, 'yyyy-MM-dd');
        if (name && workDate) {
            if (name !== $scope.prevName || date !== $scope.prevDate) {
                $scope.findExisting = true;
                $scope.loading = true;

                timesheetSrv.searchTimesheets(name, date)
                        .then(function () {
                            if (timesheetSrv.timesheetSearchResults) {
                                var timesheet = timesheetSrv.timesheetSearchResults;
                                $scope.loadTimesheetItems(timesheet);
                                $scope.hourlyRate = parseFloat(timesheet.hourlyRate);
                                timesheetTemplate.hourlyRate = $scope.hourlyRate;
                            } else {
                                $scope.loadTimesheetItems('');
                                $scope.findExisting = false;
                            }
                        });
            }
        }
        $scope.prevName = name;
        $scope.prevDate = date;
    };

    //Claims Autocomplete
    //Fetch claims
    function fetchClaims(search, row) {
        timesheetSrv.claimsAutocomplete(search)
                .then(function () {
                    if (timesheetSrv.claimsCount > 0) {
                        $scope.claimsAutocomplete = timesheetSrv.claimsList;
                        if (timesheetSrv.claimsCount === 1) {
                            row.Claims_id = $scope.claimsAutocomplete[0].id;
                        }
                    }
                });
    }

    //Clear the Claims list
    $scope.clearClaimsList = function (row) {
        for (var i in $scope.claimsAutocomplete) {
            if ($scope.claimsAutocomplete[i].label === row.jobNumber) {
                row.Claims_id = $scope.claimsAutocomplete[i].id;
            }
        }
        $scope.claimsAutocomplete = {};
    };

    $scope.watchClaims = function (row) {
        fetchClaims(row.jobNumber, row);
    };

    //Rate Variance (phase)
    $scope.getRateVarianceOptions = function (event) {
        $scope.rateVarianceList = $(event.target).find('option');
    };

    $scope.getRateVariance = function (row, phaseID) {
        for (var i = 0; i < $scope.rateVarianceList.length; i++) {
            if ($scope.rateVarianceList[i].attributes.value.nodeValue === phaseID) {

                row.rateVariance = $scope.rateVarianceList[i].attributes['data-ratevariance'].nodeValue;
                row.ClaimPhases_id = $scope.rateVarianceList[i].attributes['data-claimphase_id'].nodeValue;

                row.hourlyRate = parseFloat($scope.hourlyRate * row.rateVariance);
            }
        }
    };

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

    //Timesheet template
    var timesheetTemplate = {
        isSelected: false,
        Claims_id: '',
        jobNumber: '',
        AccountingPhaseCodes_id: '',
        StaffTypes_id: '',
        hourlyRate: $scope.hourlyRate,
        rateVariance: '1',
        ClaimPhases_id: '',
        description: '',
        toll1: '',
        toll2: '',
        regularHours: 0,
        overtimeHours: 0,
        doubleOTHours: 0,
        statRegularHours: 0,
        statOTHours: 0,
        statDoubleOTHours: 0,
        totalHours: 0
    };

    //Check to see if a timesheet ID exists
    $scope.loadTimesheetItems = function (timesheet) {
        $scope.loading = true;
        if (timesheet.id) {
            $scope.timesheetID = timesheet.id;
            $scope.staffID = timesheet.Staff_id;
            $scope.laborer = timesheet.firstname + ' ' + timesheet.lastname;
            $scope.hourlyRate = timesheet.hourlyRate;
            var workDate = Date.parse((timesheet.workDate.replace(/-/g, "/")));
            $scope.timesheetDate = new Date(workDate);
            timesheetSrv.getTimesheet(timesheet.id)
                    .then(function () {
                        //if timesheet items exists, populate the timesheet
                        if (timesheetSrv.timesheetItems) {
                            $scope.timesheetItems = timesheetSrv.timesheetItems;
                            //Get the vehicle IDs and tolls   
                            $scope.vehicleID = timesheet.Vehicles_id;
                            $scope.getVehicleTolls($scope.vehicleID, $scope.timesheetItems);
                            $scope.updateTotalSum();
                            $scope.loading = false;
                            $scope.findExisting = false;
                        }
                    });
        } else {
            //Create a blank Timesheet
            $scope.loading = false;
            $scope.findExisting = false;
            $scope.timesheetID = null;
            $scope.timesheetItems = [angular.extend({}, timesheetTemplate)];
            $scope.timesheetDate = $scope.yesterday;
        }
    };

    $scope.loadTimesheetItems(timesheet);

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
            var totalRow = parseInt($scope.timesheetItems[p].totalHours);
            $scope.sumTotal.totalHours += totalRow;
        }
    };

    //Add a row to the bottom of the timesheet
    $scope.addTimesheetRow = function () {
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        $scope.timesheetItems.push(angular.extend({}, timesheetTemplate));
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
        timesheetSrv.getTolls(vehicleID)
                .then(function () {
                    $scope.tolls = timesheetSrv.vehicleTolls;
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

    //Remove Tolls
    $scope.removeTolls = function (object) {
        var newObj = object;
        for (var i in newObj) {
            delete newObj[i].toll1;
            delete newObj[i].toll2;
            newObj[i].Timesheet_id = $scope.timesheetID;
        }
        return newObj;
    };

    //Get Tolls
    $scope.getTolls = function (object, date) {
        var newObj = [];
        for (var i in object) {
            newObj = [];
            newObj.push({Claims_id: object[i].Claims_id,
                workDate: date,
                cost: object[i].toll1
            });

            newObj.push({Claims_id: object[i].Claims_id,
                workDate: date,
                cost: object[i].toll2
            });
            object[i].tolls = newObj;
        }
        return newObj;
    };

    //Save timesheet
    $scope.saveTimesheet = function (object) {
        var date = $filter('date')($scope.timesheetDate, 'yyyy-MM-dd');

        $scope.timesheet = {
            Timesheet_id: $scope.timesheetID,
            staffID: $scope.staffID,
            workDate: date,
            Vehicles_id: $scope.vehicleID,
            hourlyRate: $scope.hourlyRate,
            totalHours: $scope.sumTotal.totalHours
        };

        var tolls = $scope.getTolls(object, date);
        var timesheetItems = $scope.removeTolls(object);
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        timesheetSrv.saveTimesheet($scope.timesheet, timesheetItems, formToken);
    };

    //Clear timesheet
    $scope.clearTimesheet = function () {
        $scope.laborer = '';
        $scope.vehicleID = '';
        $scope.hourlyRate = 0;
        $scope.prevName = '';
        $scope.prevDate = '';
        timesheetTemplate.hourlyRate = $scope.hourlyRate;
        $scope.timesheetItems = angular.extend({}, [timesheetTemplate]);
        $scope.updateTotalSum();
    };

});

// Timesheet service
module.service('timesheetSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/timesheets/';
    var timesheetItemsPath = '/admin/accounting/timesheetitems/';
    var staffPath = '/admin/staff/';
    var staffSearchPath = '/admin/staff/search';
    var claimsPath = '/admin/claims/';
    var claimsSearchPath = '/admin/claims/search';
    var vehicleTollPath = '/admin/vehicles/tolls/';

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

    //Get details for the breakdown view
    this.getTimesheetDetail = function (object) {
        console.log('getting breakdown...');
        return $http.get(apiPath + 'breakdown/' + object.id)
                .then(function (response) {
                    self.timesheetBreakdown = response.data.TimesheetBreakdowns;
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
                    console.log(response);
                    self.timesheetSearchCount = response.data.TimesheetsCount[0].rowCount;
                    self.timesheetSearchResults = response.data.Timesheets[0];
                    console.log(response.data.Timesheets[0]);
                });
    };

    //Staff Autocomplete
    this.staffAutocomplete = function (searchObject) {
        var config = {};
        config.name = searchObject;
        return $http({
            url: staffPath + 'search?',
            method: 'GET',
            params: config
        })
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
                    self.claimsList = response.data;
                    self.claimsCount = Object.keys(response.data).length - 2;
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
            url: claimsSearchPath,
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
            url: apiPath + timesheetID,
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

    //Typeahead autocomplete
    this.fetchAutocomplete = function (searchObject) {
        console.log('fetching typeahead autocomplete...');
        return searchSrv.fetchAutocomplete(searchObject, staffPath).then(function () {
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
            self.searchResults = searchSrv.searchResults.Timesheets;
            self.searchResultsCount = searchSrv.searchResults.TimesheetsCount[0].rowCount;
        });
    };

    this.advancedSearch = function (searchObject) {
        var config = angular.copy(searchObject);
        config.workDate = $filter('date')(config.workDate, 'yyyy-MM-dd', '+0000');
        return $http({
            url: apiPath + 'search?',
            method: 'GET',
            params: config
        })
                .then(function (response) {
                    console.log(response);
                    self.advancedSearchResults = response.data.Timesheets;
                    self.advancedSearchResultsCount = response.data.TimesheetsCount[0].rowCount;
                });
    };
});