module.controller('posEditCtrl', function ($scope, posEditSrv, $location, $filter, notesSrv) {
    
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
    $scope.purchaseOrderNotes = [];
    $scope.loading = true;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var path = $location.absUrl();    
    var id = path.substring(path.lastIndexOf("/")+1);
    
    if(id > 0){
        $scope.editing = true;
        posEditSrv.getPurchaseOrder(id).then(function () {
            posEditSrv.purchaseOrder.creationDate = new Date(posEditSrv.purchaseOrder.creationDate);
            //posEditSrv.purchaseOrder.creationDate = $filter('date')(posEditSrv.purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
            //$scope.item.date = creationDate;
            $scope.item = posEditSrv.purchaseOrder;
            $scope.lineItems = posEditSrv.purchaseOrderItems;
            if($scope.lineItems[0].length === 0){
                $scope.lineItems = [];
                $scope.lineItems.push(new LineItems());
            }
            
            $scope.loading = false;
            $scope.item.taxTypes = [];
            if(posEditSrv.purchaseOrderNotes[0].length !== 0){
                notesSrv.notes = notesSrv.getNotes(posEditSrv.purchaseOrderNotes);                
            }
            //commentsSrv.comments = commentsSrv.convertToComments(posEditSrv.purchaseOrderNotes);
        });
    } else {
        $scope.editing = false;
        $scope.loading = false;
        $scope.item.id = 0;
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
        return posEditSrv.fetchClaimsAutocomplete(searchObject);
    };
    
    //Product Code Typeahead
    $scope.fetchProductCodeAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.productCode = viewVal;
        searchObject.Vendors_id = $scope.item.Vendors_id;
        return posEditSrv.fetchProductCodeAutocomplete(searchObject);
    };
    
    //Product Name Typeahead
    $scope.fetchProductNameAutocomplete = function (viewVal) {
        var searchObject = {};
        searchObject.name = viewVal;
        return posEditSrv.fetchProductNameAutocomplete(searchObject);
    };
    
    //Get Claims ID from autocomplete list
    $scope.getClaimsID = function (jobNumber) {
        for (var i in posEditSrv.autocomplete) {
            if (posEditSrv.autocomplete[i].jobNumber === jobNumber) {
                $scope.item.Claims_id = posEditSrv.autocomplete[i].id;
            }
        }
    };

    //Get Vendor items info
    $scope.getProductInfo = function (row, value, index) {
        value.unitPrice = parseFloat(value.unitPrice);
        row.productCode = value.productCode;
        row.name = value.name;
        row.description = value.description;
        row.unitPrice = value.unitPrice;
        row.AccountingTaxTypes_id = value.AccountingTaxTypes_id;
        row.VendorItems_id = value.VendorItems_id;
        row.InventoryItems_id = value.InventoryItems_id;
        $scope.updateTaxList(row, index, row.AccountingTaxTypes_id);   
        $scope.updateTax();
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
        if(!isNaN(parseFloat(row.unitPrice)) && !isNaN(parseFloat(row.quantity)) ){
            row.amount = parseFloat(row.unitPrice) * parseFloat(row.quantity);
            
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
        for(var i in $scope.lineItems){
            $scope.lineItems[i].tax = $scope.lineItems[i].amount * ($scope.lineItems[i].taxAmount * 0.01);
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
    
    //Clear the item
    $scope.clear = function(){
        $scope.item = {};
    };
    
    //Saving Items    
    $scope.save = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        var purchaseOrder = angular.copy($scope.item);
        var purchaseOrderItems = angular.copy($scope.lineItems);
        purchaseOrder.creationDate = $filter('date')(purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
        posEditSrv.save(purchaseOrder, purchaseOrderItems, formToken);
    };
});