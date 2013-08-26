estates.controller 'ApplicationController', [
  '$scope', '$window', '$rootScope'
  ($scope, $window, $rootScope) ->
    $(document).on 'page:load user:signed_in', ->
      window.load()
      $('.project-thumb img').imageloader()

    window.applyFix (el) -> el
]

