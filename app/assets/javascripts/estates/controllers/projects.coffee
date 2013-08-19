estates.controller 'ProjectsController', [
  '$scope', '$element', '$compile', '$http', '$timeout', '$window'
  ($scope, $element, $compile, $http, $timeout, $window) ->
    # initialize tabs
    $scope.projectTab = 1

    $scope.project = $element.data('project')
    $scope.urls = $element.data('urls')
    $scope.followers = $element.data('followers')

    # setup mapping
    marker = $scope.project

    # $scope.markers   = [marker]
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
        $http.post($scope.urls.follow).success (follower) ->
          $scope.followers.push(follower)
          $timeout( ->
            $scope.$apply ->
              $('.profile-badge img').trigger('resize')
          , 100)
      else
        $scope.followText = 'Track'
        $scope.followState = 'not-following'
        $http.post($scope.urls.unfollow).success (follower) ->
          index = (f.id for f in $scope.followers).indexOf(follower.id)
          $scope.followers.splice(index, 1)
]

