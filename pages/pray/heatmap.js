jQuery(document).ready(function($){
  const isMobile = window.pg_js.isMobile()
  const translations = window.pg_js.escapeObject(window.pg_heatmap.translations)

  const red = 'rgba(255,0,0, .7)'
  const green = 'rgba(0,128,0, .9)'
  const defaultMapType = 'binary'
  const defaultDetailsType = 'location_details'
  const NUMBER_OF_MAP_SLICES = 10;

  const detailsType = jsObject.hasOwnProperty('details_type') ? jsObject.details_type : defaultDetailsType
  const mapType = jsObject.hasOwnProperty('map_type') ? jsObject.map_type : defaultMapType

  const participantsLayerId = 'participants'
  const participantsClusterLayerId = 'participants-clustered'
  const userLocationsLayerId = 'user_locations'
  const setting_prefix = 'pg_'
  const toggleParticipantsId = 'toggle_participants'
  const toggleUserLocationsId = 'toggle_user_locations'
  const clusterToggleId = 'cluster_participants'
  const settings_toggle = document.querySelector('#map-settings .dropdown')
  const toggleClusteringElement = document.getElementById(clusterToggleId)
  const toggleParticipantsElement = document.getElementById(toggleParticipantsId)
  const toggleUserLocationsElement = document.getElementById(toggleUserLocationsId)

  const mapSettingsKey = 'map_settings'
  let mapSettings = load_setting(mapSettingsKey)

  if (mapSettings === null) {
    const mapSettingsDefaults = {
      toggle_participants: true,
      toggle_user_locations: true,
      cluster_participants: false,
    };
    save_setting(mapSettingsKey, mapSettingsDefaults)

    mapSettings = mapSettingsDefaults
  }

  if ( settings_toggle ) {
    if ( mapSettings.toggle_participants ) {
      toggleParticipantsElement.classList.add('active')
    } else {
      toggleClusteringElement.setAttribute('disabled', true)
    }
    if ( mapSettings.toggle_user_locations ) {
      toggleUserLocationsElement.classList.add('active')
    }
    if ( mapSettings.cluster_participants ) {
      toggleClusteringElement.classList.add('active')
    }
  }

  let countdownInterval

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
  window.api_post_global = ( type, action, data = [] ) => {
    return window.api_fetch( `${window.pg_global.root}pg-api/v1/${type}/${action}`, {
      method: "POST",
      body: JSON.stringify(data),
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
      }`)

  const pray_for_area_modal = document.getElementById('pray-for-area-modal')
  const pray_for_area_content = pray_for_area_modal && pray_for_area_modal.querySelector('.modal-content')
  const pray_for_area_button = jQuery('#pray-for-area-button')
  const cta_modal = document.getElementById('cta_modal')
  const cta_modal_body = cta_modal ? cta_modal.querySelector('.modal-body') : null

  pray_for_area_button && pray_for_area_button.on('click', () => {
    if ( !window.selected_grid_id ) {
      return
    }

    const url = new URL( window.location.href )
    const urlWithAction = url.pathname;
    const urlWithoutAction = urlWithAction.split('/').slice(0, -1).join('/')

    pray_for_area_content.innerHTML = `<iframe src="${urlWithoutAction}/location?grid_id=${window.selected_grid_id}" frameborder="0" id="pray-for-area-iframe"></iframe>`

    /* fit the iframe to the screen height */
    const pray_for_area_iframe = document.getElementById('pray-for-area-iframe')
    const verticalMargin = getComputedStyle(pray_for_area_modal).getPropertyValue('--bs-modal-margin');
    const screenHeight = window.innerHeight;
    pray_for_area_iframe.style.height = `calc( ${screenHeight}px - 2 * ${verticalMargin} - 2px )`

    /* Attach eventListeners to prayer buttons */
    pray_for_area_iframe.addEventListener('load', () => {
      if ( pray_for_area_iframe.getAttribute('src') === '' ) {
        return
      }

      const iframeDocument = pray_for_area_iframe.contentDocument
      const question_done_button = iframeDocument.getElementById('question__yes_done')
      const decision_map_button = iframeDocument.getElementById('decision__map')
      const decision_home_button = iframeDocument.getElementById('decision__home')

      decision_map_button.addEventListener('click', () => {
        close_iframe_modal()
      })
      decision_home_button.addEventListener('click', () => {
        close_iframe_modal();
        location.href = '/'
      })
      question_done_button.addEventListener('click', () => {
        close_iframe_modal();
        celebrate_prayed_for_place(window.selected_grid_id)
      })
    })

    function close_iframe_modal() {
      pray_for_area_iframe.setAttribute('src', '');
      jQuery(pray_for_area_modal).modal('hide');
    }

    jQuery(pray_for_area_modal).modal('show')
    hide_location_details()
  })

  pray_for_area_modal && pray_for_area_modal.addEventListener('hidden.bs.modal', (event) => {
    pray_for_area_content.innerHTML = ''
  })

  settings_toggle && settings_toggle.addEventListener('hide.bs.dropdown', (e) => {
    const cluster_participants_element = document.getElementById('cluster_participants')
    const clustered = cluster_participants_element.classList.contains('active')

    if (clustered) {
      gtag( 'event', 'chose_clustering' )
    } else {
      gtag( 'event', 'chose_nonclustering' )
    }
  })

  let initialize_screen = jQuery('.initialize-progress')
  let grid_details_content = jQuery('#grid-details-content')

  // preload all geojson
  let asset_list = []
  var i = 1;
  while( i <= NUMBER_OF_MAP_SLICES ){
    asset_list.push(i+'.geojson')
    i++
  }

  let loop = 0
  let list = 0
  window.load_map_triggered = 0
  window.get_page( 'get_grid')
    .done(function(x){
      list = 1

      jsObject.grid_data = x.grid_data
      jsObject.participants = x.participants

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
  window.get_data_page( 'get_user_locations', data )
    .done(function(user_locations){
      jsObject.user_locations = user_locations
    })
    .fail(function(){
      console.log('Error getting user locations')
      jsObject.user_locations = []
    })

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
  function pan_to_user_location() {
    window.api_post_global( 'user', 'ip_location' )
      .then(function(location) {
        window.user_location = []
        if ( location ) {
          window.user_location = location

          const lng = Math.round( Number( location.lng ) )
          window.map.flyTo({
            center: [ lng, 30 ],
          })

        }
      })
  }

  function load_map() {
    jQuery('#initialize-screen').hide()
    jQuery('.loading-spinner').removeClass('active')

    let options = {
      container: 'map',
      style: 'mapbox://styles/discipletools/clgnj6vkv00e801pj9xnw49i6',
      center: [0, 30],
      minZoom: 0,
      maxZoom: 12,
      zoom: 2,
      maxBounds: [ [-170, -75], [180, 85] ]
    }
    if ( isMobile ) {
      options = {
        container: 'map',
        style: 'mapbox://styles/discipletools/clgnj6vkv00e801pj9xnw49i6',
        center: [-90, 30],
        minZoom: 0,
        maxZoom: 12,
        zoom: 1
      }
    }

    mapboxgl.accessToken = window.pg_global.map_key;
    map = new mapboxgl.Map(options);
    map.dragRotate.disable();
    map.touchZoomRotate.disableRotation();

    let nav = new mapboxgl.NavigationControl({
      showCompass: false,
      showZoom: true
    });
    map.addControl(nav, "top-right");

    if ( ! isMobile ) {
      map.fitBounds([
        [-90, -60],
        [60, 90]
      ]);
    }
    window.map = map

    if (cta_modal) {
      show_cta()
    }

    if ( isMobile ) {
      pan_to_user_location()
    }

    load_grid()
  }

  function load_grid() {
    window.previous_hover = false
    const mapLayers = {
      binary: [
        {
          label: 'Remaining',
          color: red,
        },
        {
          label: 'Covered in Prayer',
          color: green,
        },
      ],
      heatmap: [
        { label: '0', value: 0, color: '#aaa' },
        { label: '1', value: 1, color: '#ffffe5' },
        { label: '2', value: 2, color: '#f7fcb9' },
        { label: '3', value: 3, color: '#d9f0a3' },
        { label: '4', value: 4, color: '#addd8e' },
        { label: '5', value: 5, color: '#78c679' },
        { label: '6', value: 6, color: '#41ab5d' },
        { label: '7', value: 7, color: '#238443' },
        { label: '8', value: 8, color: '#006837' },
        { label: '9+', value: 9, color: '#004529' },
      ],
    }
    const legendDiv = document.getElementById('map-legend');

    const layers = mapLayers[mapType]
    if (mapType === 'heatmap') {
      loadLegend( legendDiv, layers )
    } else {
      legendDiv.style.display = 'none'
    }

    const fillColors = getFillColors(jsObject.map_type, layers)
    window.lineColor = '#6986B2'
    if ( jsObject.map_type === 'heatmap' ) {
      window.lineColor = 'black'
    }

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
          map.on('load', function() {
            jQuery.each(geojson.features, function (j, v) {
              if (typeof jsObject.grid_data.data[v.id] !== 'undefined' ) {
                geojson.features[j].properties.value = jsObject.grid_data.data[v.id]
              } else {
                geojson.features[j].properties.value = 0
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
                'line-color': window.lineColor,
                'line-width': .5
              }
            });
            map.addLayer({
              'id': i.toString() + 'fills_heat',
              'type': 'fill',
              'source': i.toString(),
              'paint': {
                ...fillColors,
              }
            },'waterway-label' )

            map.on('click', i.toString() + 'fills_heat', function (e) {

              const grid_id = e.features[0].id
              window.selected_grid_id = grid_id
              if (detailsType === 'community_stats') {
                load_grid_community_stats( grid_id )
              } else if (detailsType === 'location_details') {
                load_grid_details( grid_id )
              }
            })
            map.on('mouseenter', i.toString() + 'fills_heat', () => {
              map.getCanvas().style.cursor = 'pointer'
            })
            map.on('mouseleave', i.toString() + 'fills_heat', () => {
              map.getCanvas().style.cursor = ''
            })
          })

        }) /* ajax call */

    }) /* for each loop */

    images = [
      { src: jsObject.image_folder + 'l-orange-shadow32.png', id: 'avatar1' },
      { src: jsObject.image_folder + 'd-orange-shadow32.png', id: 'avatar2' },
    ]

    const allImages = images

    /* load prayer warriors layer */
    map.on('load', function() {
      let features = []
      jsObject.participants.forEach((v, i) => {
        features.push({
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [v.longitude, v.latitude]
            },
            "properties": {
              "name": "Name",
              "imageId": images[i%images.length].id,
              "i": i,
              "imagesLength": images.length,
            }
          }
        )
      })

      map.addSource('participants', {
        'type': 'geojson',
        'data': {
          "type": "FeatureCollection",
          "features": features
        },
        'cluster': mapSettings.cluster_participants,
        'clusterMaxZoom': 10,
        'clusterRadius': 30,
      })

      Promise.all(
        allImages.map(({src, id}) => new Promise((resolve) => {
          map.loadImage(
            src,
            (error, image) => {
              map.addImage(id, image)
              resolve()
            }
          )
        }))
      )
      .then(() => {

          const circleColor = [
            'step',
            ['get', 'point_count'],
            '#F48224',
            100,
            '#FAAF1B',
            750,
            '#fcc639'
          ]
          iconSizes = [
            1, 1,
            18, 2
          ]
          map.addLayer({
            'id': participantsClusterLayerId,
            'type': 'circle',
            'source': 'participants',
            'filter': [ 'has', 'point_count' ],
            'layout': {
              'visibility': mapSettings.toggle_participants ? 'visible' : 'none',
            },
            paint: {
              'circle-color': circleColor,
              'circle-radius': [
                'step',
                ['get', 'point_count'],
                20,
                100,
                30,
                750,
                40
              ]
            },
          })
          map.addLayer({
            id: 'participants-cluster-count',
            type: 'symbol',
            source: 'participants',
            filter: ['has', 'point_count'],
            layout: {
              'visibility': mapSettings.toggle_participants ? 'visible' : 'none',
              'text-field': ['get', 'point_count_abbreviated'],
              'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
              'text-size': 12
            }
          });
          map.addLayer({
            'id': participantsLayerId,
            'type': 'symbol',
            'source': 'participants',
            'filter': [ '!', [ 'has', 'point_count' ] ],
            'layout': {
              'visibility': mapSettings.toggle_participants ? 'visible' : 'none',
              'icon-image': [ 'get', 'imageId' ],
              "icon-size": [
                'interpolate',
                ['linear', 1],
                ['zoom'],
                ...iconSizes,
              ],
              'icon-padding': 0,
              "icon-allow-overlap": true,
            }
          })
        })
  })

    /* load user locations layer */
    map.on('load', function() {
      let features = []
      jQuery.each( jsObject.user_locations, function(i,v){
        features.push({
            "type": "Feature",
            "geometry": {
              "type": "Point",
              "coordinates": [v.longitude, v.latitude],
            },
            "properties": {
              "name": "Name"
            }
          }
        )
      })
      let geojson = {
        "type": "FeatureCollection",
        "features": features
      }
      map.addSource('user_locations', {
        'type': 'geojson',
        'data': geojson
      });
      let tickImage = jsObject.image_folder + 'recent-prayers-lightblue32.png'
      let iconSize = 1
      map.loadImage(
        tickImage,
        (error, image) => {
          if (error) throw error;
          map.addImage('custom-marker-user', image);
          map.addLayer({
            'id': userLocationsLayerId,
            'type': 'symbol',
            'source': 'user_locations',
            'layout': {
              'visibility': mapSettings.toggle_user_locations ? 'visible' : 'none',
              'icon-image': 'custom-marker-user',
              "icon-size": iconSize,
              'icon-padding': 0,
              "icon-allow-overlap": true,
              'text-font': [
                'Open Sans Semibold',
                'Arial Unicode MS Bold'
              ],
              'text-offset': [0, 1.25],
              'text-anchor': 'top'
            }
          });
        })
    })

    map.on('idle', () => {
      if (!map.getLayer(participantsLayerId) || !map.getLayer(userLocationsLayerId)) {
        return
      }

      const toggleElements = document.querySelectorAll(`.map-toggle[data-layer-id], .map-toggle[data-source-id]`)
      for ( const toggleElement of toggleElements ) {

        if (!toggleElement) {
          continue
        }

        toggleElement.onclick = function(e) {
          e.preventDefault()
          e.stopPropagation()

          const layerId = this.dataset.layerId
          const sourceId = this.dataset.sourceId

          let layerIds = []
          if ( sourceId ) {
            const style = map.getStyle()

            layerIds = style.layers
                          .filter(({ source }) => source === sourceId)
                          .map(({id}) => id)

          } else {
            layerIds = [ layerId ]
          }

          if ( layerIds.length === 0 ) {
            return
          }

          const visibility = map.getLayoutProperty(layerIds[0], "visibility");

          const isParticipantsToggle = this.id === toggleParticipantsId

          if (visibility === "visible" || typeof visibility === 'undefined') {
            layerIds.forEach((layerId) => {
              map.setLayoutProperty(layerId, "visibility", "none");
            })
            this.classList.remove('active')
            save_map_setting( this.id, false )
            if ( isParticipantsToggle ) {
              toggleClusteringElement.setAttribute('disabled', true)
            }
          } else {
            layerIds.forEach((layerId) => {
              map.setLayoutProperty(layerId, "visibility", "visible");
            })
            this.classList.add('active')
            save_map_setting( this.id, true )
            if ( isParticipantsToggle ) {
              toggleClusteringElement.removeAttribute('disabled')
            }
          }
        }
      }

      toggleClusteringElement.onclick = function(e) {
        e.preventDefault()
        e.stopPropagation()

        const style = map.getStyle()

        const clustered = style.sources.participants.cluster

        if ( clustered ) {
          style.sources.participants.cluster = false
          this.classList.remove('active')
          save_map_setting( clusterToggleId, false )
        } else {
          style.sources.participants.cluster = true
          this.classList.add('active')
          save_map_setting( clusterToggleId, true )
        }

        map.setStyle(style)
      }

    })

    // add stats
    jQuery('.completed').html( jsObject.stats.completed )
    jQuery('.completed_percent').html( jsObject.stats.completed_percent )
    jQuery('.remaining').html( jsObject.stats.remaining )
    jQuery('.warriors').html( jsObject.stats.participants )
    jQuery('.time_elapsed').html( PG.DisplayTime( jsObject.stats.time_elapsed_data ) )
    jQuery('.start_time').html( jsObject.stats.start_time_formatted )

    update_stats()

    if ( jsObject.stats.remaining_int < 1 ) {
      jQuery('.on-going.reveal-me').show()
      jQuery('.locations_per_hour').html( jsObject.stats.locations_per_hour )
      jQuery('.locations_per_day').html( jsObject.stats.locations_per_day )
      jQuery('.needed_locations_per_hour').html( jsObject.stats.needed_locations_per_hour )
      jQuery('.needed_locations_per_day').html( jsObject.stats.needed_locations_per_day )
      jQuery('.time_remaining').html( jsObject.stats.time_remaining_small )
    }

    if ( jsObject.stats.on_going ) {
      jQuery('.end_time').html( 'On-going' )
    } else {
      jQuery('.end_time').html( jsObject.stats.end_time_formatted )
    }

    const holdingPage = jQuery('.holding-page')

    /* Get the value of midnight this morning to compare start date against */

    const challengeDate = new Date( jsObject.stats.start_time * 1000 )
    const timeSinceMidnight = challengeDate.getSeconds() * 1000 + challengeDate.getMinutes() * 60 * 1000 + challengeDate.getHours() * 60 * 60 * 1000
    const midnightOfChallengeDate = challengeDate - timeSinceMidnight

    if ( Date.now() < midnightOfChallengeDate ) {
      const startDate = new Date(jsObject.stats.start_time * 1000 )
      const startTime = startDate.toLocaleTimeString().split(':').slice(0,2).join(':')

      /* TODO: revert back to interval for seconds countdown */
      /*
      setTimeout(() => {

        incrementCountdown()

        countdownInterval = setInterval(incrementCountdown, 1000)
      }, 1000)
      */
      incrementCountdown()

      jQuery('.starts-on-date').html( `${jsObject.stats.start_time_formatted} <br/> ${startTime}` )
      jQuery('.holding-page .start-praying-button').hide()
      holdingPage.show()

      jQuery('#pray-button').hide()

    } else {
      holdingPage.hide()
    }

    jQuery('#head_block').show()
    jQuery('#foot_block').show()
  } /* .preCache */

  function incrementCountdown() {
    const startPrayingButton = jQuery('.holding-page .start-praying-button')
    const prayButton = jQuery('#pray-button')
    let now = new Date().getTime() / 1000
    let timeLeft = jsObject.stats.start_time - now;

    if ( Math.floor( timeLeft ) < 0 ) {
      jQuery('.holding-page .time-remaining').html('Go')
      window.schoolPride()
      startPrayingButton.html('Start Praying')
      startPrayingButton.off('click')
      startPrayingButton.on('click', () => {
        location.href = `/prayer_app/custom/${jsObject.parts.public_key}`
      })
      startPrayingButton.show()
      prayButton.show()

      clearInterval(countdownInterval)
      return
    }

    const formattedTimeLeft = formatTimeLeft(timeLeft)
    jQuery('.time-remaining').html(formattedTimeLeft)
  }

  function formatTimeLeft(timeLeft) {
    /* TODO: Revert back to floor when putting back in seconds countdown */
    //let days = Math.floor(timeLeft / (60 * 60 * 24) );
    let days = Math.ceil(timeLeft / (60 * 60 * 24) );
    let hours = Math.floor((timeLeft / (60 * 60 )) - ( days * 24 ) );
    let minutes = Math.floor((timeLeft / 60) - ( hours * 60 ) - ( days * 24 * 60 ) );
    let seconds = Math.floor(timeLeft - ( minutes * 60 ) - ( hours * 60 * 60 ) - ( days * 24 * 60 * 60 ) ) ;

    let daysText = ''
    if ( days > 1 ) {
      daysText = `${days} days <br />`
    } else if ( days === 1) {
      daysText = `${days} day <br />`
    } else {
      daysText = ''
    }

    if ( days > 0 && hours < 10 ) {
      hours = `0${hours}`
    }
    if ( ( days > 0 || hours > 0 ) && minutes < 10 ) {
      minutes = `0${minutes}`
    }
    if ( ( days > 0 || hours > 0 || minutes > 0 ) && seconds < 10 ) {
      seconds = `0${seconds}`
    }

    /* #####   Rolled back to only showing days for now   ##### */
    return daysText

    if ( days > 0 ) {
      return `${daysText} <span class="time-counter">${hours}:${minutes}:${seconds}</span>`
    }
    if ( Number(hours) > 0 ) {
      return `<span class="time-counter">${hours}:${minutes}:${seconds}</span>`
    }
    if ( Number(minutes) > 0) {
      return `<span class="time-counter">${minutes}:${seconds}</span>`
    }
    return `<span class="time-counter">${seconds}</span>`
  }

  function load_grid_details( grid_id ) {
    let div = jQuery('#grid_details_content')
    div.empty().html(`<div className="col-12"><span class="loading-spinner active"></span></div>`)

    show_location_details();

    window.get_data_page( 'get_grid_details', {grid_id: grid_id} )
      .done(function(response){
        if ( ! response ) {
          return
        }
        window.report_content = response

        console.log(response)
        let bodies_1 = ''
        let bodies_2 = ''
        let bodies_3 = ''
        i = 0
        while ( i < response.location.percent_non_christians ) {
          bodies_1 += '<i class="ion-ios-body brand two-em"></i>';
          i++;
        }
        i = 0
        while ( i < response.location.percent_christian_adherents ) {
          bodies_2 += '<i class="ion-ios-body brand-lighter two-em"></i>';
          i++;
        }
        i = 0
        while ( i < response.location.percent_believers ) {
          bodies_3 += '<i class="ion-ios-body secondary two-em"></i>';
          i++;
        }
        let admin_level = response.location.admin_level_title.charAt(0).toUpperCase() + response.location.admin_level_title.slice(1)
        div.html(
          `
          <div class="row">
              <div class="col-12">
                <hr class="mt-0" />
                <p><span class="stats-title two-em">${response.location.full_name}</span></p>
                <p>${translations.one_believer_for_every.replace('%d', numberWithCommas(Math.ceil(response.location.all_lost_int / response.location.believers_int ) ) ) }</p>
                <hr>
              </div>
              <div class="col-12">
                 <div class="row">
                    <div class="col-12 center">
                        <p><strong>${translations["Don't Know Jesus"]}</strong></p>
                        <p>${bodies_1} <span>(${response.location.non_christians})</span></p>
                    </div>
                    <div class="col-12 center">
                        <p><strong>${translations["Know about Jesus"]}</strong></p>
                        <p>${bodies_2} <span>(${response.location.christian_adherents})</span></p>
                    </div>
                    <div class="col-12 center">
                        <p><strong>${translations["Know Jesus"]}</strong></p>
                        <p>${bodies_3} <span>(${response.location.believers})</span></p>
                    </div>
                </div>
                <hr>
              </div>
              <div class="col-12">
                ${translations.location_description1.replace('%1$s', admin_level).replace('%2$s', response.location.full_name).replace('%3$s', response.location.population)}
                ${translations.location_description2.replace('%1$s', response.location.name).replace('%2$s', response.location.believers).replace('%3$s', response.location.christian_adherents).replace('%4$s', response.location.non_christians)}
                ${translations.location_description3.replace('%1$s', response.location.name).replace('%2$s', response.location.peer_locations).replace('%3$s', response.location.admin_level_name_plural)}
                <hr>
              </div>
              <div class="col-12">
                ${translations.religion}: ${response.location.primary_religion}<br>
                ${translations.official_language}: ${response.location.primary_language}<br>
                <hr>
              </div>

          </div>`
        )
      })
  }

  function load_grid_community_stats( grid_id ) {
    let div = jQuery('#grid_details_content')
    div.empty().html(`<div className="col-12"><span class="loading-spinner active"></span></div>`)

    jQuery('#offcanvas_location_details').offcanvas('show')

    window.get_data_page( 'get_grid_stats', {grid_id: grid_id} )
      .done(function(response){
        window.report_content = response

        const communityStats = response.stats

        const totalNumberStats = []

        if (communityStats.times_prayed.me > 0) {
          totalNumberStats.push({
                  value: communityStats.times_prayed.me,
                  icon: 'body',
                  size: 'medium',
                  color: 'orange',
                })
        }
        if (communityStats.times_prayed.community > 0) {
          totalNumberStats.push({
                  value: communityStats.times_prayed.community,
                  icon: 'body',
                  size: 'medium',
                  color: 'blue',
                })
        }

        const totalTimeStats = []

        if (communityStats.time_prayed.me > 0) {
          totalTimeStats.push({
                  value: communityStats.time_prayed.me,
                  icon: 'time',
                  size: 'medium',
                  color: 'orange',
                })
        }
        if (communityStats.time_prayed.community > 0) {
          totalTimeStats.push({
                  value: communityStats.time_prayed.community,
                  icon: 'time',
                  size: 'medium',
                  color: 'blue',
                })
        }

        const myNumberStats = communityStats.times_prayed.me > 0 ? `
          <span>Me: ${PG.IconInfographic([{
                  value: communityStats.times_prayed.me,
                  icon: 'body',
                  size: 'medium',
                  color: 'orange',
                }])}</span>` : ''
        const communityNumberStats = communityStats.times_prayed.community > 0 ? `
          <span>Community: ${PG.IconInfographic([{
                  value: communityStats.times_prayed.community,
                  icon: 'body',
                  size: 'medium',
                  color: 'blue',
                }])}</span>` : ''
        const myTimeStats = communityStats.time_prayed.me > 0 ? `
          <span>Me: ${PG.IconInfographic([{
                  value: communityStats.time_prayed.me,
                  icon: 'time',
                  size: 'medium',
                  color: 'orange',
                }])}</span>` : ''

        const communityTimeStats = communityStats.time_prayed.community > 0 ? `
          <span>Community: ${PG.IconInfographic([{
                  value: communityStats.time_prayed.community,
                  icon: 'time',
                  size: 'medium',
                  color: 'blue',
                }])}</span>` : ''

        const handlePrimaryContent = ({ time_prayed_text }) => `${time_prayed_text}`
        const handleSecondaryContent = ({ is_mine, group_name }) => `${is_mine ? "Me in " + group_name : group_name}`

        div.html(
          `
          <div class="row">
              <div class="col-12">
                <h1 class="header-border-top">${translations["Community Stats"]}</h1>
                <p><span class="stats-title two-em">${response.location.full_name}</span></p>
                <hr />
                <p><span class="two-em">${translations["Summary"]}</span></p>
                <p>${translations["Times prayed for"]}: ${communityStats.times_prayed.total}</p>

                ${PG.IconInfographic(totalNumberStats)}

                <p>${translations["Total time prayed"]}: ${communityStats.time_prayed.total} ${communityStats.time_prayed.total > 1 ? translations.minutes : translations.minute}</p>

                ${PG.IconInfographic(totalTimeStats)}

                <hr>
              </div>
              <div class="col-12">
                <p><span class="two-em">${translations["Summary"]}</span></p>

                ${PG.ActivityList(communityStats.logs, handlePrimaryContent, handleSecondaryContent)}

                <hr />
              </div>

          </div>`
        )
      })
  }

  function getFillColors(mapType, layers) {
    const stepColors = []
    layers.forEach(({ value, color }) => {
      if ( value !== 0 ) {
        stepColors.push(value)
      }
      stepColors.push(color)
    })
    const heatmapFill = {
      "fill-color": [
        "step",
        ["get","value"],
        ...stepColors,
      ],
      'fill-opacity': 0.9,
      'fill-outline-color': 'black'
    }

    const binaryFill = {
      'fill-color': {
        property: 'value',
        stops: [[0, '#11224E'], [1, '#fff']]
        //#f2e86d
        //#e5d58a
        //#d4c28a
        //#e1b843
        //#FCD37B
        //#FAE6BC
        //#FAF8D4 light yellow
        //#FAF2A1 vanilla
        //#FDFBE8 ice white
        //#E6C229 saffron
        //#EACC48 naples yellow
        //#C04CFD phlox
        //#f2944a secondary colour
        //#FFC170 earth yellow
        //#BDEDE0 celeste
        //#FDFBE8 ivory
      },
      'fill-opacity': 1,
      'fill-outline-color': 'black'
    }

    const fillColorDictionary = {
      'heatmap': heatmapFill,
      'binary': binaryFill,
    }

    if ( !Object.prototype.hasOwnProperty.call(fillColorDictionary, mapType) ) {
      return fillColorDictionary[defaultFill]
    }

    return fillColorDictionary[mapType]
  }

  function loadLegend(legendDiv, layers) {
    layers.forEach( ({ label, color }) => {
      const item = `
        <div class="map-legend__layer">
          <div class="map-legend__color-swatch" style="background-color: ${color}"></div>
          <span className="map-legend__label">${label}</span>
        </div>`

      legendDiv.insertAdjacentHTML('beforeend', item)
    })
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function show_location_details() {
   jQuery('#offcanvas_location_details').offcanvas('show');
  }
  function hide_location_details() {
   jQuery('#offcanvas_location_details').offcanvas('hide');
  }
  function celebrate_prayed_for_place(grid_id) {
    update_map(grid_id)
    update_stats()
    window.celebrationFireworks()
  }

  function update_map(grid_id){
    window.get_page('get_grid')
      .done(function(x){
        console.log('reload')
        // add stats
        jsObject.grid_data = x.grid_data
        reload_load_grid(grid_id)
      })
  }

  function update_stats() {
    window.get_page('get_stats')
      .done(function(stats) {
        jsObject.stats = stats
        jQuery('.completed').html( jsObject.stats.completed )
        jQuery('.completed_percent').html( jsObject.stats.completed_percent )
        jQuery('.remaining').html( jsObject.stats.remaining )
        jQuery('.time_elapsed').html( PG.DisplayTime( jsObject.stats.time_elapsed_data ) )
        jQuery('.prayer_warriors').html( jsObject.stats.participants )
        jQuery('.lap_pace').html( jsObject.stats.lap_pace_small )
      })
  }

  function reload_load_grid(grid_id) {

    for (let i = 0; i < NUMBER_OF_MAP_SLICES; i++) {
      window.map.setPaintProperty(i.toString() + 'fills_heat', 'fill-color-transition', {
        duration: 2000,
        delay: 0,
      }, {
        validate: true
      })
    }

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
            if (typeof jsObject.grid_data.data[v.id] !== 'undefined') {
              geojson.features[i].properties.value = jsObject.grid_data.data[v.id]
            } else {
              geojson.features[i].properties.value = 0
            }
          })

          window.map.getSource(i.toString()).setData(geojson);
        }) /* ajax call */

    }) /* for each loop */

  }

  function save_map_setting(name, value) {
    const mapSettings = load_setting(mapSettingsKey)

    const newSettings = { ...mapSettings, [name]: value }

    save_setting(mapSettingsKey, newSettings)
  }
  function save_setting(name, value) {
    const settingName = setting_prefix + name
    localStorage.setItem( settingName, JSON.stringify(value) )
  }
  function load_setting(name) {
    const settingName = setting_prefix + name
    const setting = localStorage.getItem(settingName)

    try {
      const unpackedSetting = JSON.parse(setting)
      return unpackedSetting
    } catch (e) {
      return setting
    }
  }

  function show_cta() {
    const url = new URL(window.location.href)

    const show_cta = url.searchParams.get('show_cta') !== null

    if ( show_cta && jsObject.is_cta_feature_on === true ) {
      window.api_post_global( 'ctas', 'get_cta' )
        .then((cta) => {
          if ( !cta ) {
            return
          }
          const content = `
            <h3 class="modal-title">${cta.post_title}</h3>
            ${
              cta.post_content
                .replace( 'wp-element-button', 'btn btn-primary' )
            }
          `
          cta_modal_body.innerHTML = content

          const ctaLink = cta_modal_body.querySelector('a')
          if (ctaLink && !ctaLink.classList.contains('share-button')) {
            ctaLink.setAttribute('target', '_blank')
          }

          window.pg_set_up_share_buttons()
          jQuery(cta_modal).modal('show')
        })
    }
  }
})
