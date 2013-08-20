estates.controller 'ProfileController', [
  '$scope', '$element', '$window', '$compile', 'EstatesMap'
  ($scope, $element, $window, $compile, EstatesMap) ->
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

    $scope.openTab = (event, variable, step) ->
      event.preventDefault()
      $scope[variable] = step
      $('#accreditation_user_form').fileupload
        dataType: "script"

    $scope.google = EstatesMap.settings($scope.user, $scope.projects)
]
