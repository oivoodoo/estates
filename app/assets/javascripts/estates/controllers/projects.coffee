estates.controller 'ProjectsController', [
  '$scope', '$element', '$compile', '$http'
  ($scope, $element, $compile, $http) ->
    # initialize tabs
    $scope.projectTab = 1

    $scope.project = $element.data('project')
    $scope.urls = $element.data('urls')

    # setup mapping
    marker =
      latitude: $scope.project.latitude
      longitude: $scope.project.longitude

    $scope.latitude  = marker.latitude
    $scope.longitude = marker.longitude
    $scope.markers   = []
    $scope.center    = marker
    $scope.zoom      = 12

    # setup tab click function
    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step

    $(document).bind 'fix:scroll', (event, el) ->
      $el = $(el)
      $scope.$apply ->
        control = $el.parent().find('.fixed')
        $compile(control)($scope)

    # following things here
    if $scope.project.followed
      $scope.followText = "Stop tracking this project"
      $scope.followState = 'following'
    else
      $scope.followState = 'not-following'
      $scope.followText = 'Track'

    $scope.follow = ($event) ->
      $event.stopPropagation()
      $event.preventDefault()
      if $scope.followState == 'not-following'
        $scope.followText = "Stop tracking this project"
        $scope.followState = 'following'
        $http.post($scope.urls.follow).success (data) ->
          $('#followed').append(data)
      else
        $scope.followText = 'Track'
        $scope.followState = 'not-following'
        $http.post($scope.urls.unfollow).success (data) ->
          $('.profile-badge').append(data)
]

