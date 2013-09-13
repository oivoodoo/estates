estates.controller 'ProfileController', [
  '$scope', '$element', '$window', '$compile', '$timeout', '$http', "$location"
  ($scope, $element, $window, $compile, $timeout, $http, $location) ->
    tab = $location.path() || '/details'

    $scope.profileTab = ["/details", "/accounts", "/qualification", "/notifications"].indexOf(tab) + 1

    $scope.user = $element.data('user')
    $scope.projects = $element.data('projects')
    $scope.urls = $element.data('urls')
    $scope.followers = $element.data('followers')

    $scope.open = (link) ->
      window.open(link, '_blank')

    $scope.openTab = (event, variable, step) ->
      $scope[variable] = step
      $scope.$broadcast('map-refresh')

    $timeout( ->
      $scope.$apply ->
        $('.profile-badge img').trigger('resize')
    , 1000)

    if $scope.user.followed
      $scope.followTitle = "Stop Following"
      $scope.followProfile = 'following'
    else
      $scope.followProfile = 'not-following'
      $scope.followTitle = 'Follow'

    $scope.profile = ($event) ->
      $event.stopPropagation()
      $event.preventDefault()

      if $scope.followProfile == "not-following"
        $scope.followTitle = "Stop Following"
        $scope.followProfile = 'following'

        $http.post($scope.urls.follow).success (follower) ->
          if angular.isDefined($scope.followers)
            $scope.followers.push(follower)
            $timeout( ->
              $scope.$apply ->
                $('.profile-badge img').trigger('resize')
            , 1000)
      else
        $scope.followTitle = "Follow"
        $scope.followProfile = 'not-following'

        $http.post($scope.urls.unfollow).success (follower) ->
          if angular.isDefined($scope.followers)
            index = (f.id for f in $scope.followers).indexOf(follower.id)
            $scope.followers.splice(index, 1)
]
