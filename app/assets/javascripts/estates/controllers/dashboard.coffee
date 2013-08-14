estates.controller 'DashboardController', [
  '$scope'
  ($scope) ->
    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step

    marker =
      latitude: 52.3
      longitude: 28.3

    $scope.latitude  = marker.latitude
    $scope.longitude = marker.longitude
    $scope.markers   = []
    $scope.center    = marker
    $scope.zoom      = 12
]
