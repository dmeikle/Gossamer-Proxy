var module = angular.module('rootApp', ['ui.bootstrap']);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function (data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

    $httpProvider.interceptors.push(function(toastsSrv) {
    	return {
    		'response': function(response) {
    			if (response && response.data.result === 'error') {
    				toastsSrv.newAlert(response.data);
    			}
    			return response;
    		}
    	};
    });
});
