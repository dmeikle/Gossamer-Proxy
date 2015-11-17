// Cost Card Modal Service
module.service('costCardSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/claims/costcards/get/';
    var self = this;
    
    
    //Get the purchase order
    this.getCostCard = function (id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + id
        }).then(function (response) {
            self.costCardTimesheets = response.data.timesheets;
            self.costCardMaterials = response.data.inventoryUsed;
            self.costCardEquipment = response.data.eqUsed;
            //self.costCardMiscItems = response.data.miscUsed;
        });
    };
    
    //Save the purchase order
    this.save = function (item, lineItems, formToken) {
        var itemID = '';
        if (item.id) {
            itemID = parseInt(item.id);
        } else {
            itemID = '0';
        }

        for (var i in item) {
            if (item[i] === null) {
                delete item[i];
            }
        }
        
        for (i in lineItems) {
            for (var j in lineItems[i]){                
                if (lineItems[i][j] === null) {
                    delete lineItems[i][j];
                }
            }
        }
        var data = {};
        data.PurchaseOrder = item;
        data.PurchaseOrderItems = lineItems;
        data.FORM_SECURITY_TOKEN = formToken;
        console.log(data);
        
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