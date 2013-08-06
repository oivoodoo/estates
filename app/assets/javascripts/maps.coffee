class @Maps
  constructor: (@address) ->

  setup: ->
    geocoder = new google.maps.Geocoder()
    geocoder.geocode { address : @address }, (results, status) ->
      if status == google.maps.GeocoderStatus.OK
        latlng = results[0].geometry.location
        options =
          zoom: 17
          center: latlng
          mapTypeId: google.maps.MapTypeId.ROADMAP

        map = new google.maps.Map(document.getElementById('map_container'), options)
        $(document).on 'click', "[href='#map']", ->
          google.maps.event.trigger(map, 'resize')
          map.setCenter(latlng)
          marker = new google.maps.Marker
            map: map
            position: results[0].geometry.location

