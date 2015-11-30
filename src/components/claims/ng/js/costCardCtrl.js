module.controller('costCardCtrl', function ($scope, costCardSrv, $location, $filter, $window) {
    
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    
    $scope.loading = false;
    $scope.lineItems = [];
    $scope.item = {};
    $scope.loading = true;
    $scope.selectAll = false;
    $scope.showHours = false;
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    
    $scope.timesheetsRegHours = 0;
    $scope.timesheetsOTHours = 0;
    $scope.timesheetsDOTHours = 0;
    $scope.timesheetsSRegHours = 0;
    $scope.timesheetsSOTHours = 0;
    $scope.timesheetsSDOTHours = 0;    
    $scope.timesheetsTotalHours = 0;
    $scope.timesheetsTotalCost = 0;
    $scope.materialsTotalCost = 0;
    $scope.equipmentTotalCost = 0;
    $scope.miscTotalCost = 0;
    
    //var apiPath = '/admin/accounting/pos/';
    var path = $location.absUrl();    
    var id = path.substring(path.lastIndexOf("/")+1);
    getExistingItem ();
    
    function getExistingItem (){
        if(id > 0){
            $scope.editing = true;
            costCardSrv.getCostCard(id).then(function () {
                $scope.costCardTimesheets = costCardSrv.costCardTimesheets;
                $scope.costCardMaterials = costCardSrv.costCardMaterials;
                $scope.costCardEquipment = costCardSrv.costCardEquipment;
                $scope.costCardMiscItems = costCardSrv.costCardMiscItems;
                $scope.costCardPurchaseOrders = costCardSrv.costCardPurchaseOrders;
                $scope.lineItems = $scope.costCardTimesheets.concat($scope.costCardMaterials, $scope.costCardEquipment);
                $scope.getTimesheetTotalCost($scope.costCardTimesheets);
                $scope.getTimesheetTotalHours($scope.costCardTimesheets);
                $scope.getMaterialsTotalCost($scope.costCardMaterials);
                $scope.getEquipmentTotalCost($scope.costCardEquipment);
                $scope.getPurchaseOrdersCost($scope.costCardPurchaseOrders);
                $scope.getMiscTotalCost($scope.costCardMiscItems);
                $scope.getCostCardCosts();
                $scope.loading = false;
                
                //console.log($scope.costCardEquipment[0].length);
            });
        } else {
            $scope.editing = false;
            $scope.loading = false;
            $scope.item.id = 0;
        }
        
    }
    
    $scope.getTimesheetTotalHours = function(timesheets) {
        for(var i in timesheets) {
            $scope.timesheetsRegHours += parseFloat(timesheets[i].regularHours);
            $scope.timesheetsOTHours += parseFloat(timesheets[i].overtimeHours);
            $scope.timesheetsDOTHours += parseFloat(timesheets[i].doubleOTHours);
            $scope.timesheetsSRegHours += parseFloat(timesheets[i].statRegularHours);
            $scope.timesheetsSOTHours += parseFloat(timesheets[i].statOTHours);
            $scope.timesheetsSDOTHours += parseFloat(timesheets[i].statDoubleOTHours);
            $scope.timesheetsTotalHours += parseFloat(timesheets[i].totalHours);
        }
    };
    
    $scope.getTimesheetTotalCost = function(timesheets) {
        $scope.timesheetsTotalCost = 0;        
        //Currently, we are hard-coding the values for BC STAT holidays.
        //This will change in the future so we can allow for more locaitons if their STAT rates vary.
        for(var i in timesheets) {
            $scope.timesheetsTotalCost += (parseFloat(timesheets[i].regularHours) * parseFloat(timesheets[i].hourlyRate));
            $scope.timesheetsTotalCost += (parseFloat(timesheets[i].overtimeHours) * (parseFloat(timesheets[i].hourlyRate)*1.5));
            $scope.timesheetsTotalCost += (parseFloat(timesheets[i].doubleOTHours) * (parseFloat(timesheets[i].hourlyRate)*2));
            $scope.timesheetsTotalCost += (parseFloat(timesheets[i].statRegularHours) * (parseFloat(timesheets[i].hourlyRate)*1.5));
            //Stat OT and DOT? Should be only DOT after 12 hours on a STAT in BC
            $scope.timesheetsTotalCost += (parseFloat(timesheets[i].statOTHours) * (parseFloat(timesheets[i].hourlyRate)*2));
            $scope.timesheetsTotalCost += (parseFloat(timesheets[i].statDoubleOTHours) * (parseFloat(timesheets[i].hourlyRate)*2));
        }
    };
    
    $scope.getMaterialsTotalCost = function(materials) {
        $scope.materialsTotalCost = 0;
        for(var i in materials) {
            $scope.materialsTotalCost += parseFloat(materials[i].cost);
        }
    };
    
    $scope.getEquipmentTotalCost = function(equipment) {
        $scope.equipmentTotalCost = 0;
        for(var i in equipment) {
            if(parseFloat(equipment[i].numDays) > parseFloat(equipment[i].maxDays)){
                $scope.equipmentTotalCost += (parseFloat(equipment[i].price))*(parseFloat(equipment[i].maxDays));
            } else {
                $scope.equipmentTotalCost += (parseFloat(equipment[i].price))*(parseFloat(equipment[i].numDays));
            }
        }
    };
    
    $scope.getMiscTotalCost = function(miscItems) {
        $scope.miscTotalCost = 0;
        for(var i in miscItems) {
            $scope.miscTotalCost += parseFloat(miscItems[i].cost);
        }
    };
    
    $scope.getPurchaseOrdersCost = function(purchaseOrders) {
        $scope.purchaseOrdersSubtotal = 0;
        $scope.purchaseOrdersTax = 0;
        $scope.purchaseOrdersTotal = 0;
        for(var i in purchaseOrders) {
    
            if(purchaseOrders[i].subtotal !== null){
                $scope.purchaseOrdersSubtotal += parseFloat(purchaseOrders[i].subtotal);
            }
            
            if(purchaseOrders[i].tax !== null){
                $scope.purchaseOrdersTax += parseFloat(purchaseOrders[i].tax);
            }
            
            if(purchaseOrders[i].total !== null){
                $scope.purchaseOrdersTotal += parseFloat(purchaseOrders[i].total);
            }
            
        }
    };
    
    $scope.getCostCardCosts = function() {
        $scope.costCardTotalCost = 0;
        
        if(!isNaN($scope.timesheetsTotalCost)){
            $scope.costCardTotalCost += $scope.timesheetsTotalCost;
        }
        
        if(!isNaN($scope.materialsTotalCost)){
            $scope.costCardTotalCost += $scope.materialsTotalCost;
        }
        
        if(!isNaN($scope.equipmentTotalCost)){
            $scope.costCardTotalCost += $scope.equipmentTotalCost;
        }
        
        if(!isNaN($scope.miscTotalCost)){
        $scope.costCardTotalCost += $scope.miscTotalCost;
        }
        
        if(!isNaN($scope.purchaseOrdersTotal)){
            $scope.costCardTotalCost += $scope.purchaseOrdersTotal;
        }
        
        
//        $scope.costCardTimesheets = costCardSrv.costCardTimesheets;
//        $scope.costCardMaterials = costCardSrv.costCardMaterials;
//        $scope.costCardEquipment = costCardSrv.costCardEquipment;
//        $scope.costCardMiscItems = costCardSrv.costCardMiscItems;
    };
    
    $scope.toggleHours = function() {
        if($scope.showHours === false){            
            $scope.showHours = true;
        } else {
            $scope.showHours = false;
        }
    };
    
    //Check selected
    $scope.checkSelected = function () {
        $scope.rowSelected = false;
        for (var index in $scope.lineItems) {
            if ($scope.lineItems[index] !== null && $scope.lineItems[index].isSelected === true) {
                $scope.rowSelected = true;
            } else {
                $scope.selectAll = false;
            }
        }
    };

//    //Select All
//    $scope.selectAllToggle = function (value) {
//        for (var i in $scope.lineItems) {
//            if ($scope.lineItems[i] !== null && value === true) {
//                $scope.lineItems[i].isSelected = true;
//            } else {
//                $scope.lineItems[i].isSelected = false;
//            }
//        }
//        $scope.checkSelected();
//    };
    
    $scope.selectAllTimesheetsToggle = function (value) {
        for (var i in $scope.costCardTimesheets) {
            if ($scope.costCardTimesheets[i] !== null && value === true) {
                $scope.costCardTimesheets[i].isSelected = true;
            } else {
                $scope.costCardTimesheets[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    //Select All
    $scope.selectAllToggle = function (value) {
        for (var i in $scope.lineItems) {
            if ($scope.lineItems[i] !== null && value === true) {
                $scope.lineItems[i].isSelected = true;
            } else {
                $scope.lineItems[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
        
    $scope.approveAll = function() {
        for(var i in $scope.lineItems){
            $scope.lineItems[i].status = 1;
        }
        $scope.save();
    };
    
    $scope.approveItems = function () {
        for (var i in $scope.lineItems) {
            if($scope.lineItems[i].isSelected === true){
                console.log('DIS EYE TEM IS APOOVED YAOLLl');
            }
        }
    };
    
    //Saving Items    
    $scope.save = function () {
        var costCardItems = {};
        costCardItems.eqUsed = $scope.costCardEquipment;
        costCardItems.inventoryUsed = $scope.costCardMaterials;
        costCardItems.miscUsed = $scope.costCardMiscItems;
//        costCardItems.purchaseOrders = $scope.costCardPurchaseOrders;
        costCardItems.timesheets = $scope.costCardTimesheets;
        
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        purchaseOrder.creationDate = $filter('date')(purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
//        costCardSrv.save(purchaseOrder, purchaseOrderItems, formToken).then(function(){
//            //$window.location.href = apiPath + '0';
//        });
    };
    
//    //Update totals
//    $scope.updateAmount = function(row){
//        if(!isNaN(parseFloat(row.unitPrice)) && !isNaN(parseFloat(row.quantity)) ){
//            row.amount = parseFloat(row.unitPrice) * parseFloat(row.quantity);
//            
//        } else {
//            row.amount = 0;
//        }
//        $scope.updateSubtotal();
//    };
//    
//    $scope.updateSubtotal = function(){
//        $scope.item.subtotal = 0;
//        for(var i in $scope.lineItems){
//            if($scope.lineItems[i].amount === ''){
//                $scope.item.subtotal += 0;
//            } else {
//                $scope.item.subtotal += $scope.lineItems[i].amount;
//            }
//        }
//        
//        $scope.updateTotal();
//    };
//    
//    $scope.updateTotal = function(){
//        $scope.item.total = $scope.item.subtotal;        
//        $scope.taxTotal = 0;
//        
//        //Add the delivery fee
//        if(parseFloat($scope.item.deliveryFee) > 0){
//            $scope.item.total += parseFloat($scope.item.deliveryFee);
//        }
//        
//        //Add the tax to the total
//        $scope.updateTax();        
//        for(var i in $scope.item.taxTypes){
//            $scope.taxTotal += $scope.item.taxTypes[i].total;
//        }        
//        $scope.item.total += $scope.taxTotal;
//    };
//    
//    //Update tax
//    $scope.updateTax = function(){
//        $scope.item.taxTypes = [];
//        for(var i in $scope.lineItems){
//            $scope.lineItems[i].tax = $scope.lineItems[i].amount * ($scope.lineItems[i].taxAmount * 0.01);
//            var taxObj = {
//                id: $scope.lineItems[i].AccountingTaxTypes_id,
//                type: $scope.lineItems[i].taxType,
//                total: 0
//            };
//            
//            if(taxObj.id !== undefined && !objectWithPropExists($scope.item.taxTypes, 'id', taxObj.id) && taxObj.id !== null && $scope.lineItems[i].taxAmount !== 0){
//                $scope.item.taxTypes.push(taxObj);
//            }        
//            for(var j in $scope.item.taxTypes){
//                if($scope.lineItems[i].AccountingTaxTypes_id === $scope.item.taxTypes[j].id){
//                    $scope.item.taxTypes[j].total += $scope.lineItems[i].amount * ($scope.lineItems[i].taxAmount * 0.01);
//                }
//            }
//        }
//    };
//    
//    $scope.updateTaxList = function(row, index, id){
//        var taxSelect = document.getElementById('taxType' + index);
//        var options = $(taxSelect).find('option');
//        for(var i = 0; i < options.length; i++){
//            if(options[i].value === id){
//                row.taxAmount = parseFloat(options[i].attributes['data-amount'].nodeValue);
//                row.taxType = options[i].attributes['data-type'].nodeValue;
//            }
//        }
//    };
//    
//    function objectWithPropExists(array1,propName,propVal) {
//        for(var i=0,k=array1.length;i<k;i++){
//            if(array1[i][propName]===propVal) return true;
//        }
//        return false;
//    }   
//    
//    //Date Picker
//    $scope.dateOptions = {'starting-day': 1};
//    $scope.openDatepicker = function (event) {
//        $scope.isOpen.datepicker = true;
//    };
//    
//    //Clear the item
//    $scope.clear = function(){
//        $scope.item = {};
//    };
    

//    
//    //Saving Items    
//    $scope.saveAndNew = function () {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        var purchaseOrder = angular.copy($scope.item);
//        var purchaseOrderItems = angular.copy($scope.lineItems);
//        purchaseOrder.creationDate = $filter('date')(purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
//        costCardSrv.save(purchaseOrder, purchaseOrderItems, formToken).then(function(){
//            $window.location.href = apiPath + '0';
//        });
//    };
//    
//    //Saving Items    
//    $scope.saveAndClose = function () {
//        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//        var purchaseOrder = angular.copy($scope.item);
//        var purchaseOrderItems = angular.copy($scope.lineItems);
//        purchaseOrder.creationDate = $filter('date')(purchaseOrder.creationDate, 'yyyy-MM-dd', '+0000');
//        costCardSrv.save(purchaseOrder, purchaseOrderItems, formToken).then(function(){
//            $window.location.href = apiPath;
//        });
//    };
});