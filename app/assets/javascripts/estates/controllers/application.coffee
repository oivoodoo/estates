estates.controller 'ApplicationController', [
  '$scope', '$compile'
  ($scope, $compile) ->
    $(window)
    .on('resize', ->
      window.layout();
      connectionMasonry();
    ).on('scroll', ->
      sizeMenu()
      callNag()
      fixPos($scope, $compile)
    ).on('click.nag', ->
      callNag()
    ).on('load', ->
      window.layout()
      connectionMasonry()
    )
]

