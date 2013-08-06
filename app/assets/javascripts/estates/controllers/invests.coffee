estates.controller 'InvestsController', [
  '$scope'
  ($scope) ->
    $scope.step = (next, event) ->
      event.preventDefault()
      $scope.investButton = next
]
