estates.controller 'ProjectsController', [
  '$scope', '$timeout', '$element'
  ($scope, $timeout, $element) ->
    address = $element.data('address')

    options =
      center:
        latitude: 28
        longitude: 53
      markers: []
      zoom: 8
    angular.extend $scope, options

    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step
]

