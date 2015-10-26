// Inventory Modal Service
module.service('inventoryModalSrv', function ($http, searchSrv, $filter) {
    var apiPath = '/admin/accounting/inventory/';

    var self = this;

    //Save the inventory item
    this.save = function (headings, lineItems, formToken) {
        var itemID = '';
        if (headings.id) {
            itemID = parseInt(headings.id);
        } else {
            itemID = '0';
        }

        for (var i in headings) {
            if (headings[i] === null) {
                delete headings[i];
            }
        }

        var data = {};
        data.SuppliesUsed = headings;
        data.InventoryItems = lineItems;
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