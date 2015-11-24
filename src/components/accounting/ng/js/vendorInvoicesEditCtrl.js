module.controller('vendorInvoicesEditCtrl', function ($scope, vendorInvoicesEditSrv, $location, $filter, notesSrv, $window) {
    
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    
    $scope.isOpen = {};
    $scope.isOpen.datepicker = false;
    $scope.loading = false;
    $scope.lineItems = [];
    $scope.item = {};
    $scope.item.subtotal = 0;
    $scope.item.total = 0;
    $scope.item.taxTypes = [];
    $scope.loading = true;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    var apiPath = '/admin/accounting/invoices/';
    var path = $location.absUrl();    
    var id = path.substring(path.lastIndexOf("/")+1);
    getItems();
   
    function getItems(){
        if(id > 0){
            $scope.editing = true;
            vendorInvoicesEditSrv.getVendorInvoice(id).then(function () {
                vendorInvoicesEditSrv.vendorInvoice.entryDate = new Date(vendorInvoicesEditSrv.vendorInvoice.entryDate);
                $scope.item = vendorInvoicesEditSrv.vendorInvoice;
//                $scope.item.company = vendorInvoicesEditSrv.Vendor;
//                $scope.vendorLocations = vendorInvoicesEditSrv.VendorLocations;
//                $scope.item.vendorLocation = vendorInvoicesEditSrv.purchaseOrder.VendorLocations_id;
                $scope.lineItems = vendorInvoicesEditSrv.vendorInvoiceItems;
//                if($scope.lineItems[0].length === 0){
//                    $scope.lineItems = [];
//                    $scope.lineItems.push(new LineItems());
//                }

                $scope.loading = false;
//                $scope.item.taxTypes = [];
//                if(vendorInvoicesEditSrv.purchaseOrderNotes[0].length !== 0){
//                    notesSrv.notes = notesSrv.getNotes(vendorInvoicesEditSrv.purchaseOrderNotes);
//                }
            });
        } else {
            $scope.editing = false;
            $scope.loading = false;
            var date = new Date();
            $scope.item.entryDate = date;
        } 
    }    
    
    function LineItems(){
        return {
            isSelected: false,
            productCode: '',
            InventoryItems_id: '',
            name: '',
            price: '',
            quantity: '',
            amount: '',
            VendorItems_id: '',
            PurchaseOrders_id: $scope.item.id
        }; 
    }
    
    $scope.dropzoneConfig = {
        'options': {// passed into the Dropzone constructor
            'url': '/admin/accounting/payablesinvoices/upload/' + id,
            'uploadMultiple': false,
            'dictDefaultMessage': ''
        },
        'eventHandlers': {
            'sending': function (file, xhr, formData) {
            },
            'success': function (file, response) {
//                getStaffPhoto();
            }
        }
    };
    
    $scope.lineItems.push(new LineItems());
    
    //Table Controls
    $scope.addRow = function(){
        $scope.lineItems.push(new LineItems());        
    };
    
    $scope.insertRows = function () {
        for(var i = $scope.lineItems.length-1; i >= 0; i--){
            if ($scope.lineItems[i].isSelected === true) {
                $scope.lineItems.splice(parseInt(i) + 1, 0, new LineItems());
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
    
    //Claims Autocomplete
    $scope.fetchClaimAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.jobNumber = viewVal;
        return vendorInvoicesEditSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Product Code Typeahead
    $scope.fetchProductCodeAutocomplete = function (viewVal) {
            var searchObject = {};
            searchObject.productCode = viewVal;
            searchObject.Vendors_id = $scope.item.Vendors_id;
            return vendorInvoicesEditSrv.fetchProductCodeAutocomplete(searchObject);
    };
    
    //Product Name Typeahead
    $scope.fetchProductNameAutocomplete = function (viewVal) {
//            var searchObject = {};
//            searchObject.name = viewVal;
//            searchObject.Vendors_id = $scope.item.Vendors_id;
//            return vendorInvoicesEditSrv.fetchProductNameAutocomplete(searchObject);
    };
    
    $scope.fetchVendorsAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.company = viewVal;
        return vendorInvoicesEditSrv.fetchVendorsAutocomplete(searchObject);
    };
    
    $scope.fetchSubcontractorsAutocomplete = function(viewVal) {
        var searchObject = {};
        searchObject.company = viewVal;
        return vendorInvoicesEditSrv.fetchSubcontractorsAutocomplete(searchObject);
    };
    
    //Staff Typeahead
    $scope.fetchStaffAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return vendorInvoicesEditSrv.fetchStaffAutocomplete(searchObject);
    };
    
    $scope.getVendorsID = function(vendor){
        $scope.item.Vendors_id = vendor.Vendors_id;
    };
    
    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function (claim) {
        $scope.item.Claims_id = claim.id;
    };
    
    //Get Claims ID from autocomplete list
    $scope.getSubcontractorsID = function (subcontractor) {
        $scope.item.Subcontractors_id = subcontractor.id;
    };

    $scope.getStaffID = function(row, staff){
        row.Staff_id = staff.Staff_id;
    };
    
    //Get Vendor items info
    $scope.getProductInfo = function (row, value, index) {
        value.unitPrice = parseFloat(value.unitPrice);
        row.productCode = value.productCode;
        row.name = value.name;
        row.description = value.description;
        row.price = value.unitPrice;
        row.AccountingTaxTypes_id = value.AccountingTaxTypes_id;
        row.VendorItems_id = value.VendorItems_id;
        row.InventoryItems_id = value.InventoryItems_id;
        $scope.updateTaxList(row, index, row.AccountingTaxTypes_id);
        $scope.updateAmount(row);
    };    
    
    //Check selected
    $scope.checkSelected = function () {
        $scope.rowSelected = false;
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
        $scope.checkSelected();
    };
    
    //Update totals
    $scope.updateAmount = function(row){
        if(!isNaN(parseFloat(row.price)) && !isNaN(parseFloat(row.quantity)) ){
            row.amount = parseFloat(row.price) * parseFloat(row.quantity);
            
        } else {
            row.amount = 0;
        }
        $scope.updateSubtotal();
    };
    
    $scope.updateSubtotal = function(){
        $scope.item.subtotal = 0;
        for(var i in $scope.lineItems){
            if($scope.lineItems[i].amount === ''){
                $scope.item.subtotal += 0;
            } else {
                $scope.item.subtotal += $scope.lineItems[i].amount;
            }
        }        
        $scope.updateTotal();
    };
    
    $scope.updateTotal = function(){
        $scope.item.total = $scope.item.subtotal;        
        $scope.taxTotal = 0;
        
        //Add the delivery fee
        if(parseFloat($scope.item.deliveryFee) > 0){
            $scope.item.total += parseFloat($scope.item.deliveryFee);
        }
        
        //Add the tax to the total
        $scope.updateTax();
        for(var i in $scope.item.taxTypes){
            $scope.taxTotal += $scope.item.taxTypes[i].total;
        }
        $scope.item.total += $scope.taxTotal;
    };
    
    //Update tax
    $scope.updateTax = function(){
        $scope.item.taxTypes = [];
        $scope.item.tax = 0;
        for(var i in $scope.lineItems){
            $scope.lineItems[i].tax = $scope.lineItems[i].amount * ($scope.lineItems[i].taxAmount * 0.01);
            $scope.item.tax += $scope.lineItems[i].tax;
            var taxObj = {
                id: $scope.lineItems[i].AccountingTaxTypes_id,
                type: $scope.lineItems[i].taxType,
                total: 0
            };
            
            if(taxObj.id !== undefined && !objectWithPropExists($scope.item.taxTypes, 'id', taxObj.id) && taxObj.id !== null && $scope.lineItems[i].taxAmount !== 0){
                $scope.item.taxTypes.push(taxObj);
            }        
            for(var j in $scope.item.taxTypes){
                if($scope.lineItems[i].AccountingTaxTypes_id === $scope.item.taxTypes[j].id){
                    $scope.item.taxTypes[j].total += $scope.lineItems[i].amount * ($scope.lineItems[i].taxAmount * 0.01);
                }
                
            }
        }
    };
    
    $scope.updateTaxList = function(row, index, id){
        var taxSelect = document.getElementById('taxType' + index);
        var options = $(taxSelect).find('option');
        for(var i = 0; i < options.length; i++){
            if(options[i].value === id){
                row.taxAmount = parseFloat(options[i].attributes['data-amount'].nodeValue);
                row.taxType = options[i].attributes['data-type'].nodeValue;
            }
        }
    };
    
    function objectWithPropExists(array1,propName,propVal) {
        for(var i=0,k=array1.length;i<k;i++){
            if(array1[i][propName]===propVal) return true;
        }
        return false;
    }   
    
    //Date Picker
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        $scope.isOpen.datepicker = true;
    };
//    
//    //Clear t he item
//    $scope.clear = function(){
//        $scope.item = {};
//    };
//    
    //Saving Items    
    $scope.save = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        var VendorInvoice = angular.copy($scope.item);
        var VendorInvoiceItem = angular.copy($scope.lineItems);
        VendorInvoice.entryDate = $filter('date')(VendorInvoice.entryDate, 'yyyy-MM-dd', '+0000');
        vendorInvoicesEditSrv.save(VendorInvoice, VendorInvoiceItem, formToken).then(function(){
            //$window.location.href = apiPath + '0';
        });
    };
//    
//    //Save and make a new Purchase Order
//    $scope.saveAndNew = function () {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        var purchaseOrder = angular.copy($scope.item);
//        var purchaseOrderItems = angular.copy($scope.lineItems);
//        purchaseOrder.creationDate = $filter('date')(purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
//        vendorInvoicesEditSrv.save(purchaseOrder, purchaseOrderItems, formToken).then(function(){
//            $window.location.href = apiPath + '0';
//        });
//    };
//    
//    //Save and return to pos list
//    $scope.saveAndClose = function () {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        var purchaseOrder = angular.copy($scope.item);
//        var purchaseOrderItems = angular.copy($scope.lineItems);
//        purchaseOrder.creationDate = $filter('date')(purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
//        vendorInvoicesEditSrv.save(purchaseOrder, purchaseOrderItems, formToken).then(function(){
//            $window.location.href = apiPath;
//        });
//    };
});