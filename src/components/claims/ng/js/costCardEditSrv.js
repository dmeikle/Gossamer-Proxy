// Cost Card Modal Service
module.service('costCardEditSrv', function ($http, searchSrv, $filter, crudSrv) {
    var apiPath = '/admin/claims/costcards/get/';
    var savePath = '/admin/claims/costcards/';
    var totalsPath = '/admin/claims/costcards/totals/';
    var self = this;
    
    //Get the cost card items
    this.getCostCard = function (CostCard_id, Claims_id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + Claims_id + '/' + CostCard_id
        }).then(function (response) {
            self.costCardItems = response.data;
        });
    };
    
    //Get the cost card items
    this.getUnassignedItems = function (Claims_id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: apiPath + Claims_id + '/0'
        }).then(function (response) {
            self.unassignedItems = response.data;
        });
    };
    
    //Get the cost card items
    this.getTotals = function (Claims_id, CostCard_id) {
        return $http({
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            url: totalsPath + Claims_id + '/' + CostCard_id
        }).then(function (response) {
            //self.costCardTotals = response.data.timesheets;
        });
    };
    
    //Save the cost card
    this.save = function (id, lineItems, formToken) {        
        for (var i in lineItems) {
            for (var j in lineItems[i]){
                if (lineItems[i][j] === null) {
                    delete lineItems[i][j];
                } 
                for(var p in lineItems[i][j]){
                    if (lineItems[i][j][p] === null) {
                        delete lineItems[i][j][p];
                    }                    
                }
            }
        }
        return crudSrv.save(savePath + id, lineItems, 'CostCardItem', formToken);//.then(function(response){
//            console.log(response);
//            return response;
//        });
    };    
});