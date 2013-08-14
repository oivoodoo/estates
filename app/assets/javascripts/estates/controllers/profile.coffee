estates.controller 'ProfileController', [
  '$scope', '$element', '$window', '$compile'
  ($scope, $element, $window, $compile) ->
    $scope.profileTab = 1
    $scope.user = $element.data('user')
    $scope.open = (link) ->
      window.open(link, '_blank')

    $(document).bind 'fix:scroll', (event, el) ->
      $el = $(el)
      $scope.$apply ->
        control = $el.parent().find('.fixed')
        $compile(control)($scope)
]
