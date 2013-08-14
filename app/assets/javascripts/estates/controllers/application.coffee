estates.controller 'ApplicationController', [
  '$scope', '$compile', '$window'
  ($scope, $compile, $window) ->
    $window.onresize = ->
      layout()
      connectionMasonry()
      drawCharts()

    $window.onscroll = ->
      sizeMenu()
      callNag()
      fixPos()

    $(document).on 'click', '.nag', ->
      callNag()

    $window.onload = ->
      layout()
      connectionMasonry()

    $(document).on 'page:load', ->
      window.load()
      layout()
      connectionMasonry()
]

