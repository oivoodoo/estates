estates.controller 'ProfileController', [
  '$scope', '$element', '$window', '$compile'
  ($scope, $element, $window, $compile) ->
    $scope.profileTab = 1
    $scope.user = $element.data('user')
    $scope.projects = $element.data('projects')

    $scope.open = (link) ->
      window.open(link, '_blank')

    $(document).bind 'fix:scroll', (event, el) ->
      $el = $(el)
      $scope.$apply ->
        control = $el.parent().find('.fixed')
        $compile(control)($scope)

    markers = (project for project in $scope.projects when project.infoWindow = "#{project.name}, #{project.address}")

    # because of exporting only lng and ltd
    $scope.markers = $scope.projects

    # setup center for the google maps
    # by default if we have no at least one invested project or user doesn't
    # have address we will take San Fransisco coordinates for the pointing
    # somewhere.
    SF =
      latitude: 37.7756
      longitude: -122.4193

    project = $scope.projects[0] || {}

    center =
      latitude:  $scope.user.latitude  || project.latitude  || SF.latitude
      longitude: $scope.user.longitude || project.longitude || SF.longitude

    $scope.center    = center
    $scope.zoom      = 12  
]
