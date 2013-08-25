estates.directive 'esGoogleMap', [
  '$timeout',
  ($timeout) ->
    link = ($scope, $element, $attributes) ->
      $element.addClass("angular-google-map");

      # we are applying google maps for the root element of the directive
      container = $element[0]
      options =
        container: container
        center: new google.maps.LatLng($scope.options.center.latitude, $scope.options.center.longitude)

      _instance = new google.maps.Map(container, angular.extend($scope.options, options))

      # setup custom styles
      styledMap = new google.maps.StyledMapType($scope.styles[$scope.styles.id], { name: $scope.styles.name })
      _instance.mapTypes.set($scope.styles.id, styledMap)
      _instance.setMapTypeId($scope.styles.id)

      # setup basic google maps events for saving basic properties to the
      # scopes
      google.maps.event.addListener _instance, "zoom_changed", ->
        $scope.options.zoom = _instance.getZoom()
        $scope.options.center = _instance.getCenter()
      google.maps.event.addListener _instance, "center_changed", ->
        $scope.options.center = _instance.getCenter()

      # setup refresh event
      $scope.$watch 'refresh', ->
        _instance.setOptions
          mapTypeControlOptions: $scope.options.mapTypeControlOptions
          disableDefaultUI: $scope.options.disableDefaultUI
        google.maps.event.trigger(_instance, "resize")
        # we need to reset center for refreshing
        _instance.setCenter(_instance.getCenter())

      @markers = []
      # add markers to the map with InfoBubble info window.
      for m in $scope.options.markers
        marker = new google.maps.Marker
          position: new google.maps.LatLng(m.latitude, m.longitude)
          map: _instance
          icon: m.icon
          zoomControl: false
          scaleControl: false
          scrollwheel: false
        @markers.push(marker)

        m.infoWindow.map = _instance
        info = new InfoBubble(m.infoWindow.settings)

        google.maps.event.addListener marker, 'click', ->
          if currentInfoWindow?
            currentInfoWindow.close()
          info.open(_instance, marker)
          currentInfoWindow = info

      # autofit markers on the screen
      if $scope.extra.fit and @markers.length > 0
        bounds = new google.maps.LatLngBounds()
        for m in @markers
          bounds.extend(m.getPosition())
        _instance.fitBounds(bounds)

    return {
      restrict: 'ECA'
      priority: 100
      transclude: true
      template: "<div class='angular-google-map' ng-transclude></div>"
      scope:
        options: '=options'
        styles: '=styles'
        refresh: '=refresh'
        extra: '=extra'
      replace: false
      link: link
    }
]

