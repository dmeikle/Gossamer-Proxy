// Cost Card Modal Service
module.service('costCardEditSrv', function ($http, searchSrv, $filter, crudSrv) {
    var apiPath = '/admin/claims/costcards/get/';
    var savePath = '/admin/claims/costcards/';
    var self = this;
    
    //Get the purchase order
    this.getCostCard = function (CostCard_id, Claims_id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + Claims_id + '/' + CostCard_id 
//        crudSrv.getList()
        }).then(function (response) {
            self.costCardTimesheets = response.data.timesheets;
            self.costCardMaterials = response.data.inventoryUsed;
            self.costCardEquipment = response.data.eqUsed;
            self.costCardMiscItems = response.data.miscUsed;
            self.costCardPurchaseOrders = response.data.purchaseOrders;
        });
    };
    
    //Save the purchase order
    this.save = function (id, lineItems, formToken) {
        
        for (var i in lineItems) {
            for (var j in lineItems[i]){
                for(var p in lineItems[i][j]){
                    if (lineItems[i][j][p] === null) {
                        delete lineItems[i][j][p];
                    }                    
                }
            }
        }
        crudSrv.save(savePath + id, lineItems, 'CostCardItem', formToken);
    };
    
});