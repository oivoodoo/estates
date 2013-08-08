estates.controller 'ProfileController', [
  '$scope', '$element'
  ($scope, $element) ->
    $scope.user = $element.data('user')
    $scope.open = (link) ->
      window.open(link, '_blank')
]
