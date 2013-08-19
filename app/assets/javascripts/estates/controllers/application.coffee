estates.controller 'ApplicationController', [
  '$scope', '$window'
  ($scope, $window) ->
    $(document).on 'page:load user:signed_in', ->
      window.load()
]

