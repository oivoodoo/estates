estates.controller 'ProfileController', [
  '$scope', '$element', '$window', '$compile', '$timeout', '$rootScope'
  ($scope, $element, $window, $compile, $timeout, $rootScope) ->
    $scope.profileTab = 1

    $scope.user = $element.data('user')
    $scope.projects = $element.data('projects')

    $scope.open = (link) ->
      window.open(link, '_blank')

    $scope.openTab = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step
      $scope.$broadcast('map-refresh')
]
