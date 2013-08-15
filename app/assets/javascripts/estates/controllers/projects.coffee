estates.controller 'ProjectsController', [
  '$scope', '$element', '$compile', '$http', '$timeout', '$window'
  ($scope, $element, $compile, $http, $timeout, $window) ->
    # initialize tabs
    $scope.projectTab = 1

    $scope.project = $element.data('project')
    $scope.urls = $element.data('urls')
    $scope.followers = $element.data('followers')

    weirdResize = ->
      $timeout ->
        # TODO: remove this quick fix for the tabs
        $('.connections a img').trigger('resize')
      , 100

    # TODO: remove this quick fix for the tabs
    $window.onload = ->
      weirdResize()

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
      weirdResize()

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
        $http.post($scope.urls.follow).success (follower) ->
          $scope.followers.push(follower)
          weirdResize()
      else
        $scope.followText = 'Track'
        $scope.followState = 'not-following'
        $http.post($scope.urls.unfollow).success (data) ->
          $('.profile-badge').append(data)
]

