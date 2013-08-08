estates.directive 'esDisabled', ->
  link = ($scope, $element, $attributes) ->
    $scope.$watch $attributes.esDisabled, ->
      value = $scope.$eval($attributes.esDisabled)
      if angular.isDefined(value) && value isnt ""
        $element.removeAttr('disabled')
      else
        $element.attr('disabled', 'disabled')

  return {
    restrict: 'A'
    link: link
    replace: false
  }
