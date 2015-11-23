module.service('toastsSrv', function () {

    var self = this;

    this.alerts = [];

    this.newAlert = function (response) { 
    //Expects 
    // { formItemType : { 
    //         fieldName : 'Error string',
    //         fieldName_value : 'value from input field'
    //    }
    // }

        var formItems = response.data;
        for (var item in formItems) {
            for (var property in formItems[item]) {
                if (formItems[item].hasOwnProperty(property) && 
                typeof formItems[item] === 'object' &&
                property.substr(property.length - 6) !== '_value' && 
                property !== 'FAIL_KEY') {
                    self.alerts.push({
                        'field': property, 
                        'message': formItems[item][property],
                        'type': response.result
                    });
                }
            }
        }
    };

    this.dismissAlert = function (index) {
        self.alerts.splice(index, 1);
    };
});
