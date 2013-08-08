estates.controller 'ProfileController', [
  '$scope', '$element'
  ($scope, $element) ->
    $scope.user = $element.data('user')
]
