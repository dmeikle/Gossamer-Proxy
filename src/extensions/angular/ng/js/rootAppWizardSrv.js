module.service('addNewWizardSrv', function($http) {
  this.getWizardPages = function(page, apiPath) {
    return $http.get(apiPath).then(function(response) {
      var elementList = document.implementation.createHTMLDocument();
      elementList.body.innerHTML = response.data;
      self.wizardPages = [];
      for (var i = 0; i < elementList.body.children.length; i++) {
        selfwizardPages.push(elementList.body.children[i]);
      }
    });
  };
});
