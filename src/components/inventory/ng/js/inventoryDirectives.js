module.directive('getVehicle', function() {
  return {
    restrict:'E',
    scope:false,
    link: function(scope, elem, attrs) {
      var elements = document.getElementsByClassName('vehicle');
      for (var element in elements) {
        if (elements.hasOwnProperty(element) &&
          scope.$parent.equipmentList[0].Vehicles_id == elements[element].dataset.id) {

          scope.$parent.vehicle = {
              'number':elements[element].dataset.number,
              'licensePlate':elements[element].dataset.licenseplate
            };
        }
      }
    }
  };
});
