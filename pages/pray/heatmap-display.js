const isMobile = window.pg_js.isMobile()

jQuery(document).ready(function($){

  window.get_page = (action) => {
    return jQuery.ajax({
      type: "POST",
      data: JSON.stringify({ action: action, parts: jsObject.parts }),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      url: window.pg_global.root + jsObject.parts.root + '/v1/' + jsObject.parts.type + '/' + jsObject.parts.action,
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', window.pg_global.nonce )
      }
    })
      .fail(function(e) {
        console.log(e)
        jQuery('#error').html(e)
      })
  }
  window.get_data_page = (action, data ) => {
    return jQuery.ajax({
      type: "POST",
      data: JSON.stringify({ action: action, parts: jsObject.parts, data: data }),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      url: window.pg_global.root + jsObject.parts.root + '/v1/' + jsObject.parts.type + '/' + jsObject.parts.action,
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', window.pg_global.nonce )
      }
    })
      .fail(function(e) {
        console.log(e)
        jQuery('#error').html(e)
      })
  }

  jQuery('#custom-style').empty().append(`
      #wrapper {
          height: ${window.innerHeight}px !important;
      }
      #map-wrapper {
          height: ${window.innerHeight}px !important;
      }
      #map {
          height: ${window.innerHeight}px !important;
      }
      #initialize-screen {
          height: ${window.innerHeight}px !important;
      }
      #welcome-modal {
          height: ${window.innerHeight - 30}px !important;
      }
      #map-sidebar-wrapper {
          height: ${window.innerHeight}px !important;
      }
`)

  let initialize_screen = jQuery('.initialize-progress')

  // preload all geojson
  let asset_list = []
  var i = 1;
  while( i <= 10 ){
    asset_list.push(i+'.geojson')
    i++
  }

  let loop = 0
  let list = 0
  window.load_map_triggered = 0
  window.get_page('get_grid')
    .done(function(x){
      list = 1

      jsObject.grid_data = x.grid_data
      jsObject.stats = x.stats

      if ( loop > 9 && list > 0 && window.load_map_triggered !== 1 ){
        window.load_map_triggered = 1
        load_map()
      }
    })
    .fail(function(){
      console.log('Error getting grid data')
      jsObject.grid_data = {'data': {}, 'highest_value': 1 }
    })
  let data = {
    hash: localStorage.getItem('pg_user_hash')
  }


  let map
  jQuery.each(asset_list, function(i,v) {
    jQuery.ajax({
      url: window.pg_global.mirror_url + 'tiles/world/flat_states/' + v,
      dataType: 'json',
      data: null,
      cache: true,
      beforeSend: function (xhr) {
        if (xhr.overrideMimeType) {
          xhr.overrideMimeType("application/json");
        }
      }
    })
      .done(function(x){
        loop++
        initialize_screen.val(loop)

        if ( 1 === loop ) {
          jQuery('#initialize-people').show()
        }

        if ( 3 === loop ) {
          jQuery('#initialize-activity').show()
        }

        if ( 5 === loop ) {
          jQuery('#initialize-coffee').show()
        }

        if ( 8 === loop ) {
          jQuery('#initialize-dothis').show()
        }

        if ( loop > 7 && list > 0 && window.load_map_triggered !== 1 ){
          window.load_map_triggered = 1
          load_map()
        }

      })
      .fail(function(){
        loop++
      })
  })

  function load_map() {
    jQuery('#initialize-screen').hide()
    jQuery('.loading-spinner').removeClass('active')

    let center = [0, 20]
    let zoom = 1.5

    mapboxgl.accessToken = window.pg_global.map_key;
    map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/discipletools/clgnj6vkv00e801pj9xnw49i6',
      center: center,
      minZoom: 1,
      maxZoom: 12,
      zoom: zoom,
      maxBounds: [ [-170, -75], [180, 85] ]
    });
    map.dragRotate.disable();
    map.touchZoomRotate.disableRotation();

    let nav = new mapboxgl.NavigationControl({
      showCompass: false,
      showZoom: true
    });

    map.on('load', function() {
      load_grid()
    })
  }

  window.intervalLoopCount = 0

  function load_grid() {
    jQuery.each(asset_list, function(i,file){

      jQuery.ajax({
        url: window.pg_global.mirror_url + 'tiles/world/flat_states/' + file,
        dataType: 'json',
        data: null,
        cache: true,
        beforeSend: function (xhr) {
          if (xhr.overrideMimeType) {
            xhr.overrideMimeType("application/json");
          }
        }
      })
        .done(function (geojson) {

          /* load prayer grid layer */

            jQuery.each(geojson.features, function (i, v) {
              if (typeof jsObject.grid_data.data[v.id] !== 'undefined' ) {
                geojson.features[i].properties.value = jsObject.grid_data.data[v.id]
              } else {
                geojson.features[i].properties.value = 0
              }
            })

            map.addSource(i.toString(), {
              'type': 'geojson',
              'data': geojson
            });
            map.addLayer({
              'id': i.toString()+'line',
              'type': 'line',
              'source': i.toString(),
              'paint': {
                'line-color': '#6986B2',
                'line-width': .5
              }
            });
            map.addLayer({
              'id': i.toString() + 'fills_heat',
              'type': 'fill',
              'source': i.toString(),
              'paint': {
                'fill-color': {
                  property: 'value',
                  stops: [[0, '#11224E'], [1, '#fff']]
                },
                'fill-opacity': 1,
                'fill-outline-color': 'black'
              }
            },'waterway-label' )

        }) /* ajax call */

    }) /* for each loop */

    // add stats
    jQuery('.completed').html( jsObject.stats.completed )
    jQuery('.completed_percent').html( jsObject.stats.completed_percent )
    jQuery('.remaining').html( jsObject.stats.remaining )
    jQuery('.time_elapsed').html( jsObject.stats.time_elapsed_small )
    jQuery('.prayer_warriors').html( jsObject.stats.participants )
    jQuery('.lap_pace').html( jsObject.stats.lap_pace_small )

    jQuery('#head_block').show()
    jQuery('#foot_block').show()

    window.intervalLoopCount++

  } /* .loadgrid */

  setInterval(function(){
    if ( window.intervalLoopCount > 60 ) {
      location.reload()
    } else {
      window.get_page('get_grid')
        .done(function(x){
          console.log('reload')
          // add stats
          jsObject.stats = x.stats
          jQuery('.completed').html( jsObject.stats.completed )
          jQuery('.completed_percent').html( jsObject.stats.completed_percent )
          jQuery('.remaining').html( jsObject.stats.remaining )
          jQuery('.time_elapsed').html( jsObject.stats.time_elapsed_small )
          jQuery('.prayer_warriors').html( jsObject.stats.participants )
          jQuery('.lap_pace').html( jsObject.stats.lap_pace_small )

          jsObject.grid_data = x.grid_data
          reload_load_grid()
        })
    }
  }, 60000 )

  function reload_load_grid() {
    jQuery.each(asset_list, function(i,file){

      jQuery.ajax({
        url: window.pg_global.mirror_url + 'tiles/world/flat_states/' + file,
        dataType: 'json',
        data: null,
        cache: true,
        beforeSend: function (xhr) {
          if (xhr.overrideMimeType) {
            xhr.overrideMimeType("application/json");
          }
        }
      })
        .done(function (geojson) {

          /* load prayer grid layer */
          jQuery.each(geojson.features, function (i, v) {
            if (typeof jsObject.grid_data.data[v.id] !== 'undefined' ) {
              geojson.features[i].properties.value = jsObject.grid_data.data[v.id]
            } else {
              geojson.features[i].properties.value = 0
            }
          })

          map.getSource(i.toString()).setData(geojson);

        }) /* ajax call */

    }) /* for each loop */

    // add stats
    jQuery('.completed').html( jsObject.stats.completed )
    jQuery('.completed_percent').html( jsObject.stats.completed_percent )
    jQuery('.remaining').html( jsObject.stats.remaining )
    jQuery('.time_elapsed').html( jsObject.stats.time_elapsed_small )
    jQuery('.prayer_warriors').html( jsObject.stats.participants )
    jQuery('.lap_pace').html( jsObject.stats.lap_pace_small )

    jQuery('#head_block').show()
    jQuery('#foot_block').show()
  } /* .loadgrid */

})


