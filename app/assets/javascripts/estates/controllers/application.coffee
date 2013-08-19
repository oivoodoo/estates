estates.controller 'ApplicationController', [
  '$scope', '$window'
  ($scope, $window) ->
    $(document).on 'page:load', ->
      window.load()
      $(window).trigger('load')
]

