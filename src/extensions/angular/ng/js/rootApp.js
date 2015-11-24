var module = angular.module('rootApp', ['ui.bootstrap']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function (data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

    $httpProvider.interceptors.push(function(toastsSrv) {
	// toastsSrv Expects 
    // { formItemType : { 
    //         fieldName : 'Error string',
    //         fieldName_value : 'value from input field'
    //    }
    // }
    	return {
    		'response': function(response) {
    			if (response && 
				response.config.method === 'POST' && 
				response.data.result === 'error') {
    				toastsSrv.newAlert(response.data);
    			} else if (response && 
				response.config.method === 'POST' && 
				response.data.result !== 'error') {
    				toastsSrv.newAlert({'data': { 'Success' : {'Success' : 'Saved'} }, 'result': 'success'});
    			}
    			return response;
    		}
    	};
    });
});
