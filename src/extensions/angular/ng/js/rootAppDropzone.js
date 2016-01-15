angular.module('dropzone', []).directive('dropzone', function () {
    return function (scope, element, attrs) {
        var config, dropzone;
        
        if(scope[attrs.dropzone]) {
            config = scope[attrs.dropzone];            
        } else {
            config = scope.$parent[attrs.dropzone]; 
        }

        // create a Dropzone for the element with the given options
        Dropzone.autoDiscover = false;
        dropzone = new Dropzone(element[0], config.options);

        // bind the given event handlers
        angular.forEach(config.eventHandlers, function (handler, event) {
            dropzone.on(event, handler);
        });
    };
});
