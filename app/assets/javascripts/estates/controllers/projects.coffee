estates.controller 'ProjectsController', [
  '$scope'
  ($scope) ->
    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step
]
