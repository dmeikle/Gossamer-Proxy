module.service('toastsSrv', function ($timeout) {

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
        var alert;
        for (var item in formItems) {
            for (var property in formItems[item]) {
                if (formItems[item].hasOwnProperty(property) && 
                typeof formItems[item] === 'object' &&
                property.substr(property.length - 6) !== '_value' && 
                property !== 'FAIL_KEY') {
                    alert = {
                        'field': property, 
                        'message': formItems[item][property],
                        'type': response.result
                    };
                    self.alerts.push(alert);
                }
            }
        }
        $timeout(10000).then(function() {
            self.dismissAlert(self.alerts.indexOf(alert));
        });
    };

    this.dismissAlert = function (index) {
        self.alerts.splice(index, 1);
    };
});
