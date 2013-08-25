@estates = angular.module('estates', ['ng-rails-csrf', 'rails', 'ui'])

$(document).on 'ready page:change', ->
  angular.bootstrap(document, ['estates'])

