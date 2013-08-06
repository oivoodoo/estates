estates.controller 'InvestsController', [
  '$scope'
  ($scope) ->
    $scope.next = (next, event) ->
      event.preventDefault()
      $scope.investButton = step
    $scope.prev = (prev, event) ->
      event.preventDefault()
      $scope.investButton = step
]
