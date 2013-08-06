estates.controller 'InvestsController', [
  '$scope'
  ($scope) ->
    $scope.step = (step, event) ->
      event.preventDefault()
      $scope.investButton = step
]
