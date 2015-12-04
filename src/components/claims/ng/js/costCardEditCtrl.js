module.controller('costCardEditCtrl', function ($scope, costCardEditSrv, $location, $filter, $window) {
    
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    
    $scope.loading = false;
    $scope.lineItems = [];
    $scope.costCard = {};
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
    var path = $location.absUrl().split( '/' );;
    
    var id = path[path.length - 1];
    var Claims_id = path[path.length - 2];
    getExistingItem ();
    
    function getExistingItem (){
        if(id > 0){
            $scope.editing = true;
            costCardEditSrv.getCostCard(id, Claims_id).then(function () {
                $scope.costCardTimesheets = costCardEditSrv.costCardTimesheets;
                $scope.costCardMaterials = costCardEditSrv.costCardMaterials;
                $scope.costCardEquipment = costCardEditSrv.costCardEquipment;
                $scope.costCardMiscItems = costCardEditSrv.costCardMiscItems;
                $scope.costCardPurchaseOrders = costCardEditSrv.costCardPurchaseOrders;
                $scope.costCardDetails = costCardEditSrv.costCardDetails;
                $scope.lineItems = $scope.costCardTimesheets.concat($scope.costCardMaterials, $scope.costCardEquipment, $scope.costCardMiscItems, $scope.costCardPurchaseOrders);
                
                $scope.costCard.timesheets = ($scope.costCardTimesheets);
                $scope.costCard.inventoryUsed = $scope.costCardMaterials;
                $scope.costCard.eqUsed = $scope.costCardEquipment;
                $scope.costCard.miscUsed = $scope.costCardMiscItems;
                $scope.costCard.purchaseOrders = $scope.costCardPurchaseOrders;
                
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
            costCardEditSrv.getCostCard(id, Claims_id);
        }
        
    }
    
    $scope.getTotals = function () {
        costCardEditSrv.getTotals( Claims_id, id);
    };
    
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
    
    $scope.selectAllMaterialsToggle = function (value) {
        for (var i in $scope.costCardMaterials) {
            if ($scope.costCardMaterials[i] !== null && value === true) {
                $scope.costCardMaterials[i].isSelected = true;
            } else {
                $scope.costCardMaterials[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllEquipmentToggle = function (value) {
        for (var i in $scope.costCardEquipment) {
            if ($scope.costCardEquipment[i] !== null && value === true) {
                $scope.costCardEquipment[i].isSelected = true;
            } else {
                $scope.costCardEquipment[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllMiscItemsToggle = function (value) {
        for (var i in $scope.costCardMiscItems) {
            if ($scope.costCardMiscItems[i] !== null && value === true) {
                $scope.costCardMiscItems[i].isSelected = true;
            } else {
                $scope.costCardMiscItems[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllPurchaseOrdersToggle = function (value) {
        for (var i in $scope.costCardPurchaseOrders) {
            if ($scope.costCardPurchaseOrders[i] !== null && value === true) {
                $scope.costCardPurchaseOrders[i].isSelected = true;
            } else {
                $scope.costCardPurchaseOrders[i].isSelected = false;
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
    
    //Approve All Items
    $scope.approveAll = function () {
        for(var i in $scope.costCard){
            if($scope.costCard[i][0].length !== 0){
                for(var j in $scope.costCard[i]){                   
                    $scope.costCard[i][j].AccountingItemsStatusTypes_id = 2;
                }                
            }
        }
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardEditSrv.save(id, $scope.costCard, formToken);
    };
    
    //Approve Selected Items
    $scope.approveSelected = function () {
        for(var i in $scope.costCard){
            if($scope.costCard[i][0].length !== 0){
                for(var j in $scope.costCard[i]){
                    if($scope.costCard[i][j].isSelected === true){                        
                        $scope.costCard[i][j].AccountingItemsStatusTypes_id = 2;
                    }
                }                
            }
        }
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardEditSrv.save(id, $scope.costCard, formToken);
    };
    
    //Disapprove All Items
    $scope.disapproveAll = function () {
        for(var i in $scope.costCard){
            if($scope.costCard[i][0].length !== 0){
                for(var j in $scope.costCard[i]){                   
                    $scope.costCard[i][j].AccountingItemsStatusTypes_id = 3;
                }                
            }
        }
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardEditSrv.save(id, $scope.costCard, formToken);
    };
    
    //Disapprove Selected Items
    $scope.disapproveSelected = function () {
        for(var i in $scope.costCard){
            if($scope.costCard[i][0].length !== 0){
                for(var j in $scope.costCard[i]){
                    if($scope.costCard[i][j].isSelected === true){                        
                        $scope.costCard[i][j].AccountingItemsStatusTypes_id = 3;
                    }
                }                
            }
        }
        
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardEditSrv.save(id, $scope.costCard, formToken);
    };
    
    $scope.save = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardEditSrv.save(id, $scope.costCard, formToken).then(function () {
            getExistingItem();
        });
    };
    
    $scope.saveDetails = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        costCardEditSrv.save(id, $scope.costCardDetails, formToken);
    };
});