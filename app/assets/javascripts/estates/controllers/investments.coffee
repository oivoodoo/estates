estates.controller 'InvestmentsController', [
  '$scope', '$element'
  ($scope, $element) ->
    $scope.project = $element.data('project')
    $scope.step = (step, event) ->
      event.preventDefault()
      $scope.investButton = step
]
