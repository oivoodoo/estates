estates.controller 'ProjectsController', [
  '$scope', '$element', '$compile', '$http', '$timeout'
  ($scope, $element, $compile, $http, $timeout) ->
    $scope.project = $element.data('project')
    $scope.urls = $element.data('urls')
    $scope.followers = $element.data('followers')

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

    if $scope.project.followed
      $scope.followText = 'Stop Following'
      $scope.followState = 'following'
    else
      $scope.followState = 'not-following'
      $scope.followText = 'Follow'

    $scope.follow = (user) ->
      if $scope.followState == 'not-following'
        $scope.followText = 'Stop Following'
        $scope.followState = 'following'
        $http.post($scope.urls.follow).success (follower) ->
          $scope.followers.push(follower)
        # TODO: replace with better solution.
        $timeout(->
          $('.profile-badge img').trigger('resize')
        , 100)
      else
        $scope.followText = 'Follow'
        $scope.followState = 'not-following'
        debugger
        $scope.find = ->
          for i in [0..$scope.followers.length]
            if user.id == $scope.followers[i].id
              return i
        $scope.followers.splice(find(), 1)
        $http.post($scope.urls.unfollow).success (follower) ->
]
