module.service('wizardSrv', function($http) {

  var self = this;

  this.getWizardPages = function(apiPath) {
    return $http({
      url: apiPath,
      method: 'GET'
    }).then(function(response) {
      var elementList = document.implementation.createHTMLDocument();
      elementList.body.innerHTML = response.data;
      self.wizardPages = [];
      for (var i = 0; i < elementList.body.children.length; i++) {
        self.wizardPages.push(elementList.body.children[i]);
      }
    });
  };
});
