estates.controller 'ProjectsController', [
  '$scope', '$element', '$compile', '$http'
  ($scope, $element, $compile, $http) ->
    $scope.project = $element.data('project')

    marker =
      latitude: $scope.project.latitude
      longitude: $scope.project.longitude

    $scope.latitude  = marker.latitude
    $scope.longitude = marker.longitude
    $scope.markers   = []
    $scope.center    = marker
    $scope.zoom      = 12

    $scope.open = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step

    $(document).bind 'fix:scroll', (event, el) ->
      $el = $(el)
      $scope.$apply ->
        control = $el.parent().find('.fixed')
        $compile(control)($scope)

    $scope.followState = 'not-following'
    $scope.followText = 'Follow'

    $scope.follow = ->
      if $scope.followState == 'not-following'
        $scope.followText = 'Stop Following'
        $scope.followState = 'following'
        $http.post('/projects/3/follow');
      else
        $scope.followText = 'Follow'
        $scope.followState = 'not-following'
        $http.post('/projects/3/unfollow');
]

