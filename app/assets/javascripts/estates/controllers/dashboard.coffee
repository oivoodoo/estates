estates.controller 'DashboardController', [
  '$scope', '$element', 'EstatesMap'
  ($scope, $element, EstatesMap) ->
    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step

    user = $element.data('user')
    projects = $element.data('projects')

    $scope.google = EstatesMap.settings(user, projects)
]

