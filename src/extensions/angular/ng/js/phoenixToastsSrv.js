module.service('toastsSrv', function() {
  this.alerts = {};

  this.newAlert = function(object) { //Expects {domNodeId: <value>, message: <value>}
    if (object.hasOwnProperty('domNodeId') && object.hasOwnProperty('message')) {
      alerts[object.domNodeId] = object.message;
    }
  };
});
