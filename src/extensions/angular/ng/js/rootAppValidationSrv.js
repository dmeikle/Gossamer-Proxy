module.service('validationSrv', function($rootScope) {
	this.showErrors = function(object) {
        var data = object.data;
        var errors = {};
        for (var error in data) {
            if (typeof data[error] === 'object') {
                for (var property in data[error]) {
                    if (property !== 'FAIL_KEY' &&
                        property.slice(-6) !== '_value') {
                        errors[property] = data[error][property];
                    }
                }
            }
        }

        $rootScope.$broadcast('errors', errors);
	};
});