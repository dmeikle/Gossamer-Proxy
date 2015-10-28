// Inventory Modal Service
module.service('inventoryModalSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/inventory/';

    var self = this;

    //Save the inventory item
    this.save = function (item, formToken) {
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

        var data = {};
        data.InventoryItem = item;
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