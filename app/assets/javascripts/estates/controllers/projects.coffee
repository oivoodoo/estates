estates.controller 'ProjectsController', [
  '$scope', '$element'
  ($scope, $element) ->
    debugger

    $scope.project = $element.data('project')

    options =
      center:
        latitude: $scope.project.latitude
        longitude: $scope.project.longitude
      markers: []
      zoom: 15
    angular.extend $scope, options

    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step
]

