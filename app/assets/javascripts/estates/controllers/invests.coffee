estates.controller 'InvestsController', [
  '$scope'
  ($scope) ->
    $scope.next = (next, event) ->
      event.preventDefault()
      $scope.investButton = next
    $scope.prev = (prev, event) ->
      event.preventDefault()
      $scope.investButton = prev
]
