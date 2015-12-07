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

    var Claims_id = document.getElementById('Claims_id').value;
    var CostCards_id = document.getElementById('CostCards_id').value;
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    
    $scope.selectUnassigned = {
        timesheets: false,
        inventoryUsed: false,
        eqUsed: false,
        costCard: false,
        miscUsed: false
    };
    
    $scope.costCard = {
        timesheets: [],
        inventoryUsed: [],
        eqUsed: [],
        costCard: {},
        miscUsed: []
    };
    
    getExistingItem ();
    
    function getExistingItem (){
        if(CostCards_id > 0){
            $scope.editing = true;
            costCardEditSrv.getCostCard(CostCards_id, Claims_id).then(function () {
                
                $scope.costCard = costCardEditSrv.costCardItems;
                $scope.costCard.costCard = $scope.costCard.costCard[0];
                delete $scope.costCard.costCard[0];
                
                $scope.costCard.costCard.Claims_id = Claims_id;
                
                $scope.getCostCardTotals();
                $scope.loading = false;
            });
        } else {
            $scope.editing = false;
            $scope.loading = true;
            costCardEditSrv.getCostCard(CostCards_id, Claims_id).then(function(){
                $scope.loading = false;
                $scope.unassignedItems = costCardEditSrv.costCardItems;
                $scope.costCard.costCard.Claims_id = Claims_id;
            });
        }
        
    }
    
    $scope.getTotals = function () {
        console.log('getting totals...');
        costCardEditSrv.getTotals(Claims_id, CostCards_id);
    };

    $scope.getCostCardTotals = function() {
        $scope.getTimesheetTotalCost($scope.costCard.timesheets);
        $scope.getTimesheetTotalHours($scope.costCard.timesheets);
        $scope.getMaterialsTotalCost($scope.costCard.inventoryUsed);
        $scope.getEquipmentTotalCost($scope.costCard.eqUsed);
        $scope.getPurchaseOrdersCost($scope.costCard.purchaseOrders);
        $scope.getMiscTotalCost($scope.costCard.miscUsed);
        $scope.getCostCardCosts();
    };
    
    $scope.getTimesheetTotalHours = function(timesheets) {
        $scope.timesheetsRegHours = 0;
        $scope.timesheetsOTHours = 0;
        $scope.timesheetsDOTHours = 0;
        $scope.timesheetsSRegHours = 0;
        $scope.timesheetsSOTHours = 0;
        $scope.timesheetsSDOTHours = 0;
        $scope.timesheetsTotalHours = 0;
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
//    $scope.selectUnassigned.timesheets = false;
    //Check selected
    $scope.checkUnassignedSelected = function (key, value) {
        if(value === false){
            $scope.selectUnassigned[key] = false;
        }
    };
    
    $scope.selectAllTimesheetsToggle = function (value) {
        for (var i in $scope.costCard.timesheets) {
            if ($scope.costCard.timesheets[i] !== null && value === true) {
                $scope.costCard.timesheets[i].isSelected = true;
            } else {
                $scope.costCard.timesheets[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllMaterialsToggle = function (value) {
        for (var i in $scope.costCard.inventoryUsed) {
            if ($scope.costCard.inventoryUsed[i] !== null && value === true) {
                $scope.costCard.inventoryUsed[i].isSelected = true;
            } else {
                $scope.costCard.inventoryUsed[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllEquipmentToggle = function (value) {
        for (var i in $scope.costCard.eqUsed) {
            if ($scope.costCard.eqUsed[i] !== null && value === true) {
                $scope.costCard.eqUsed[i].isSelected = true;
            } else {
                $scope.costCard.eqUsed[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllMiscItemsToggle = function (value) {
        for (var i in $scope.costCard.miscUsed) {
            if ($scope.costCard.miscUsed[i] !== null && value === true) {
                $scope.costCard.miscUsed[i].isSelected = true;
            } else {
                $scope.costCard.miscUsed[i].isSelected = false;
            }
        }
        $scope.checkSelected();
    };
    
    $scope.selectAllPurchaseOrdersToggle = function (value) {
        for (var i in $scope.costCard.purchaseOrders) {
            if ($scope.costCard.purchaseOrders[i] !== null && value === true) {
                $scope.costCard.purchaseOrders[i].isSelected = true;
            } else {
                $scope.costCard.purchaseOrders[i].isSelected = false;
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
        costCardEditSrv.save(CostCards_id, $scope.costCard, formToken);
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
        
        costCardEditSrv.save(CostCards_id, $scope.costCard, formToken);
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
        costCardEditSrv.save(CostCards_id, $scope.costCard, formToken);
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
        costCardEditSrv.save(CostCards_id, $scope.costCard, formToken);
    };
    
    //Assign the items to a cost card
    $scope.assignSelected = function() {
        for(var i in $scope.unassignedItems){
            for(var j = $scope.unassignedItems[i].length-1; j >= 0; j--){
                if($scope.unassignedItems[i][j].isSelected){
                    $scope.unassignedItems[i][j].isSelected = false;
                    $scope.unassignedItems[i][j].id = $scope.unassignedItems[i][j].items_id;                    
                    $scope.costCard[i].push($scope.unassignedItems[i][j]);                    
                    $scope.unassignedItems[i].splice(j, 1);
                }                
            }
        }
        $scope.getCostCardTotals();
    };
    
    $scope.selectAllUnassigned = function(key, value) {
        for(var i in $scope.unassignedItems[key]){
            if(value === true){
                $scope.unassignedItems[key][i].isSelected = true;
            } else {
                $scope.unassignedItems[key][i].isSelected = false;
            }
        }
    };
    
    $scope.save = function () {
        costCardEditSrv.save(CostCards_id, $scope.costCard, formToken);
    };
    
    $scope.saveDetails = function () {
        costCardEditSrv.save(CostCards_id, $scope.costCardDetails, formToken);
    };
});