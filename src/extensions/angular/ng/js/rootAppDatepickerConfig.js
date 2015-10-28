var module = angular.module('rootApp', ['ui.bootstrap']);

module.config(function (datepickerConfig, datepickerPopupConfig) {
    datepickerConfig.showWeeks = false;
    datepickerPopupConfig.showButtonBar = false;
});
