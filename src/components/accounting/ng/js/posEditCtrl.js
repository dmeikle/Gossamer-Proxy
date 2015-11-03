module.controller('posEditCtrl', function ($scope, posEditSrv, $location) {
    
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
    
    $scope.item.pst = 0;
    $scope.item.gst = 0;
    
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    var path = $location.absUrl();    
    var id = path.substring(path.lastIndexOf("/")+1);
    
    if(id > 0){
        $scope.editing = true;
        posEditSrv.getPurchaseOrder(id).then(function () {
            $scope.item = posEditSrv.purchaseOrder;
            $scope.lineItems = posEditSrv.purchaseOrderItems;
            $scope.loading = false;
            $scope.item.pst = 0;
            $scope.item.gst = 0;
//            for(var i in $scope.lineItems){
//                posEditSrv.getInventoryItemDetails($scope.lineItems[i].InventoryItems_id)
//            }
        });
    } else {
        $scope.editing = false;
        $scope.loading = false;
    }
    
    
    function LineItems(){
        return {
            isSelected: false,
            productCode: '',
            InventoryItems_id: '',
            name: '',
            PackageTypes_id: '',
            price: '',
            quantity: '',
            cost: '',
            chargeOut: '',
            amount: ''
        }; 
    }
    
    $scope.lineItems.push(new LineItems());
    
    //Table Controls
    $scope.addRow = function(){
        $scope.lineItems.push(new LineItems());        
    };
    //console.log($scope.lineItems);
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
    
    //Get Material info from material name
    $scope.getProductNameInfo = function (row, value) {
        for (var j in posEditSrv.materialsAutocomplete) {
            if (posEditSrv.materialsAutocomplete[j].name === value) {
                row.productCode = posEditSrv.materialsAutocomplete[j].productCode;
                row.unitPrice = parseFloat(posEditSrv.materialsAutocomplete[j].purchaseCost);
                row.PackageTypes_id = posEditSrv.materialsAutocomplete[j].PackageTypes_id;
                row.InventoryItems_id = posEditSrv.materialsAutocomplete[j].id;
            }
        }
    };

    //Get Material info from product code
    $scope.getProductCodeInfo = function (row, value) {
        for (var i in posEditSrv.productCodeAutocomplete) {
            if (posEditSrv.productCodeAutocomplete[i].productCode === value) {
                console.log(posEditSrv.productCodeAutocomplete[i]);
                row.productName = posEditSrv.productCodeAutocomplete[i].name;
                row.unitPrice = parseFloat(posEditSrv.productCodeAutocomplete[i].price);
                row.InventoryItems_id = posEditSrv.productCodeAutocomplete[i].id;
            }
        }
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
        
        if(!isNaN(parseFloat(row.unitPrice)) && !isNaN(parseFloat(row.quantity))){
            row.amount = parseFloat(row.unitPrice) * parseFloat(row.quantity);
            console.log(row.taxPercent);
            //Add the tax
            if(!isNaN(parseFloat(row.taxPercent))){
                console.log('wah awhahiwhia');
                var taxMultiplier = parseFloat(row.taxPercent) * 0.01;
                row.tax = parseFloat(((row.unitPrice) * taxMultiplier).toFixed(2));
                row.amount += row.tax;  
            }
            
        } else {
            row.amount = '';
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
        if(parseFloat($scope.item.deliveryFee) > 0){
            $scope.item.total += parseFloat($scope.item.deliveryFee);
        }
        if(parseFloat($scope.item.tax) > 0){
            $scope.item.total += parseFloat($scope.item.tax);
        }
    };
    
    //Update tax
    $scope.updateTax = function(row, index, id){
        var taxSelect = document.getElementById('taxType' + index);
        var options = $(taxSelect).find('option');
        for(var i = 0; i < options.length; i++){
            if(options[i].value === id){
                row.taxPercent = options[i].attributes['data-amount'].nodeValue;
                row.taxPercent = options[i].attributes['data-amount'].nodeValue;
            }
        }
    };
    
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
        $scope.item.purchaseOrderItem = $scope.lineItems;
        console.log($scope.item);
        //posEditSrv.save($scope.item, formToken);
    };
});