estates.controller 'MapsController', [
  '$scope', '$element', 'EstatesMap'
  ($scope, $element, EstatesMap) ->
    $scope.markers = $element.data('markers')

    $scope.google = EstatesMap.settings($scope.user, $scope.markers)
    $scope.google.mapTypeControlOptions = false
    $scope.google.disableDefaultUI = true
    $scope.isOpened = false

    $scope.show = ->
      $scope.isOpened = true
      $scope.google.mapTypeControlOptions =
        mapTypeIds: [
          'grayMap',
          google.maps.MapTypeId.TERRAIN,
          google.maps.MapTypeId.SATELLITE,
          google.maps.MapTypeId.HYBRID
        ],
        position: google.maps.ControlPosition.RIGHT_BOTTOM
      $scope.google.disableDefaultUI = false
      $scope.$broadcast('map-refresh');

      # mapTypeControlOptions: (open ? false : mTCO)
    $scope.close = ->
      $scope.isOpened = false
      $scope.google.mapTypeControlOptions = false
      $scope.google.disableDefaultUI = true
      $scope.$broadcast('map-refresh');
]

