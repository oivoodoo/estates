@estates = angular.module('estates', ['ng-rails-csrf', 'rails', 'ui', 'google-maps'])

$(document).on 'ready page:change', ->
  angular.bootstrap(document, ['estates'])

