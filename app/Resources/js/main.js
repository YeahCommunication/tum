
(function() {
    'use strict';
    angular.module('app', ['restangular', 'ngMaterial', 'ngMessages', 'ngAnimate', 'ngSanitize', 'LocalStorageModule'])

    .config(function($mdThemingProvider, localStorageServiceProvider, $mdGestureProvider, $interpolateProvider) {
        localStorageServiceProvider.setPrefix('tum');
        $mdGestureProvider.skipClickHijack();
        $interpolateProvider.startSymbol('[[').endSymbol(']]');

    })
    //FORCE FOCUS ON SELECT WITH SEARCH
    .directive('forceFocus', function() {
      return {
        restrict: 'A',
        require: ['^^mdSelect', '^ngModel'],
        link: function(scope, element, controller) {
          scope.$watch(function () {
            var found = element;
            while (!found.hasClass('md-select-menu-container')) {
              found = found.parent();
            }
            return found.hasClass('md-active');
          }, function (evalu) {
            if (evalu) {
                element.focus();
            }
          })
        }
      }
    })

})();

