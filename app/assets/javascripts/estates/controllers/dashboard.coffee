estates.controller 'DashboardController', [
  '$scope', '$element'
  ($scope, $element) ->
    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step

    user = $element.data('user')
    projects = $element.data('projects')
    markers = (project for project in projects when project.infoWindow = "#{project.name}, #{project.address}")

    # because of exporting only lng and ltd
    $scope.markers = projects

    # setup center for the google maps
    # by default if we have no at least one invested project or user doesn't
    # have address we will take San Fransisco coordinates for the pointing
    # somewhere.
    SF =
      latitude: 37.7756
      longitude: -122.4193

    project = projects[0] || {}

    center =
      latitude:  user.latitude  || project.latitude  || SF.latitude
      longitude: user.longitude || project.longitude || SF.longitude

    $scope.center    = center
    $scope.zoom      = 12
]

