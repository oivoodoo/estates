estates.directive 'turboLoading', ->
  compile = ($element) ->
    $element.css('display', 'none')

    # lets setup visible settings
    opts =
      lines: 12
      length: 7
      width: 5
      radius: 10
      color: '#FFF'
      speed: 1
      trail: 100
      shadow: true
    spinner = new Spinner(opts).spin($element[0])

    ($scope, $element) ->
      # lets link events here
      $(document).on 'page:fetch', -> $element.css('display', 'block')
      $(document).on 'page:receive', -> $element.css('display', 'none')

  return {
    restrict: 'E'
    replace: true
    template: "<span class='loader'>"
    compile: compile
  }

