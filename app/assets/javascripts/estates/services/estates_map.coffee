estates.factory 'EstatesMap', [
  ->
    Styles =
      id: 'grayMap'
      name: 'Gray Map'
      grayMap: [
        {
          stylers: [ { saturation: -100 }, { lightness: 35 } ]
        },{
          elementType: 'labels',
          stylers: [ { weight: .2 }, { lightness: -10 } ]
        },{
          elementType: 'labels.text.stroke',
          stylers: [ { visibility: 'off' } ]
        }, {
          featureType: 'water',
          stylers: [ { color: '#b8b8b8' } ]
        }
      ]

    # setup center for the google maps
    # by default if we have no at least one invested object or user doesn't
    # have address we will take San Fransisco coordinates for the pointing
    # somewhere.
    SF =
      latitude: 37.7756
      longitude: -122.4193

    @settings = (user, collection) ->
      # configuring google maps here.
      settings = {}

      markers = (object for object in collection when object.infoWindow = "#{object.name}, #{object.address}")

      # because of exporting only lng and ltd
      settings.markers = markers

      object = collection[0] || {}

      center =
        latitude:  user.latitude  || object.latitude  || SF.latitude
        longitude: user.longitude || object.longitude || SF.longitude

      settings.center      = center
      settings.zoom        = 12
      settings.minZoom     = 2
      settings.fit         = true
      settings.scrollwheel = false
      settings.styles      = Styles
      settings.markClick   = true
      settings.draggable   = true
      settings.mapTypeControlOptions =
        mapTypeIds: [
          'grayMap',
          google.maps.MapTypeId.ROADMAP,
          google.maps.MapTypeId.TERRAIN,
          google.maps.MapTypeId.SATELLITE,
          google.maps.MapTypeId.HYBRID
        ]

      settings

    this
]

