@estates = angular.module('estates', ['ng-rails-csrf', 'rails', 'ui'])

$(document).on 'ready page:load', ->
  angular.bootstrap(document, ['estates'])

