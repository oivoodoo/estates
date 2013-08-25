estates.controller 'ProjectsController', [
  '$scope', '$element', '$compile', '$http', '$timeout', '$window', 'EstatesMap'
  ($scope, $element, $compile, $http, $timeout, $window, EstatesMap) ->
    # initialize tabs
    $scope.projectTab = 1

    $scope.project = $element.data('project')
    $scope.urls = $element.data('urls')
    $scope.followers = $element.data('followers')

    $scope.google = EstatesMap.settings({}, [$scope.project])

    # setup tab click function
    $scope.openTab = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step

    # user selected location tab that mean we need to refresh map
    $scope.$watch 'projectTab==3', ->
      $scope.$broadcast('map-refresh')

    $scope.$on 'map-refresh', ->
      $scope.google.refresh = !$scope.google.refresh

    window.applyFix (el) ->
      $compile($(el))($scope)

    # TODO: refactor this things, move out to the service using factory.
    # following things here
    if $scope.project.followed
      $scope.followText = "Stop tracking this project"
      $scope.followState = 'tracking'
      $scope.className = 'tracking'
    else
      $scope.followState = 'not-tracking'
      $scope.followText = 'Track this project'
      $scope.className = 'track'

    $scope.follow = ($event) ->
      $event.stopPropagation()
      $event.preventDefault()

      if $scope.followState == 'not-tracking'
        $scope.followText = "Stop tracking this project"
        $scope.followState = 'tracking'
        $scope.className = 'tracking'

        $http.post($scope.urls.follow).success (follower) ->
          if angular.isDefined($scope.followers)
            $scope.followers.push(follower)
            $timeout( ->
              $scope.$apply ->
                $('.profile-badge img').trigger('resize')
            , 100)
      else
        $scope.followText = 'Track this project'
        $scope.followState = 'not-tracking'
        $scope.className = 'track'

        $http.post($scope.urls.unfollow).success (follower) ->
          if angular.isDefined($scope.followers)
            index = (f.id for f in $scope.followers).indexOf(follower.id)
            $scope.followers.splice(index, 1)
]

