var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
  || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
  isMobile = true;
}

jQuery(document).ready(function($){

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
      url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type + '/' + jsObject.parts.action,
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
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
      url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type + '/' + jsObject.parts.action,
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
      }
    })
      .fail(function(e) {
        console.log(e)
        jQuery('#error').html(e)
      })
  }
  window.api_post_global = ( type, action, data = [] ) => {
    return window.api_fetch( `${jsObject.root}pg-api/v1/${type}/${action}`, {
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
      url: jsObject.mirror_url + 'tiles/world/flat_states/' + v,
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
      style: 'mapbox://styles/discipletools/cl2ksnvie001i15qm1h5ahqea',
      center: [0, 30],
      minZoom: 0,
      maxZoom: 12,
      zoom: 2,
      maxBounds: [ [-170, -75], [180, 85] ]
    }
    if ( isMobile ) {
      options = {
        container: 'map',
        style: 'mapbox://styles/discipletools/cl2ksnvie001i15qm1h5ahqea',
        center: [-90, 30],
        minZoom: 0,
        maxZoom: 12,
        zoom: 1
      }
    }

    if (jsObject.is_dark_map_on) {
      options.style = 'mapbox://styles/discipletools/clgnj6vkv00e801pj9xnw49i6'
    }

    mapboxgl.accessToken = jsObject.map_key;
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
    window.lineColor = 'white'
    if ( jsObject.map_type === 'heatmap' ) {
      window.lineColor = 'black'
    }

    if ( jsObject.is_dark_map_on ) {
      window.lineColor = '#6986B2'
    }

    jQuery.each(asset_list, function(i,file){

      jQuery.ajax({
        url: jsObject.mirror_url + 'tiles/world/flat_states/' + file,
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

    let images = [
      { src: jsObject.image_folder + 'avatar-d1.png', id: 'avatar1' },
      { src: jsObject.image_folder + 'avatar-d2.png', id: 'avatar2' },
      { src: jsObject.image_folder + 'avatar-d3.png', id: 'avatar3' },
      { src: jsObject.image_folder + 'avatar-d4.png', id: 'avatar4' },
      { src: jsObject.image_folder + 'avatar-d5.png', id: 'avatar5' },
      { src: jsObject.image_folder + 'avatar-d6.png', id: 'avatar6' },
      { src: jsObject.image_folder + 'avatar-d7.png', id: 'avatar7' },
      { src: jsObject.image_folder + 'avatar-d8.png', id: 'avatar8' },
      { src: jsObject.image_folder + 'avatar-d9.png', id: 'avatar9' },
      { src: jsObject.image_folder + 'avatar-d10.png', id: 'avatar0' },
    ]

    if ( jsObject.is_dark_map_on ) {
      images = [
        { src: jsObject.image_folder + 'l-orange-shadow32.png', id: 'avatar1' },
        { src: jsObject.image_folder + 'd-orange-shadow32.png', id: 'avatar2' },
      ]
    }

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

          let circleColor = [
                'step',
                ['get', 'point_count'],
                '#51bbd6',
                100,
                '#f1f075',
                750,
                '#f28cb1'
              ]
          let iconSizes = [
            1, 0.15,
            18, 1
          ]

          if ( jsObject.is_dark_map_on ) {
            circleColor = [
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
          }
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
      let tickImage = jsObject.image_folder + 'black-check-50.png'
      let iconSize = 0.5
      if ( jsObject.is_dark_map_on ) {
        tickImage = jsObject.image_folder + 'recent-prayers-lightblue32.png'
        iconSize = 1
      }
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

      const applyStylesButton = document.querySelector('.apply-new-map-styles')
      applyStylesButton.onclick = function(e) {
        e.preventDefault()
        e.stopPropagation()

        const style = map.getStyle()

        const yesStyle = $('.yes-map-colour').val() || 'green'
        const noStyle = $('.no-map-colour').val() || 'red'
        const lineColour = $('.line-colour').val() || 'white'
        const fillOpacity = $('.fill-opacity').val() || '0.75'

        console.log(style, yesStyle, noStyle)
        const stops = [
          [0, noStyle],
          [1, yesStyle],
        ]

        for (let i = 0; i < 10; i++) {
          const layerId = style.layers.findIndex(({id}) => id === `${i}fills_heat`)
          const lineLayerId = style.layers.findIndex(({id}) => id === `${i}line`)

          style.layers[layerId].paint['fill-color'].stops = stops
          style.layers[layerId].paint['fill-opacity'] = Number(fillOpacity)
          style.layers[lineLayerId].paint['line-color'] = lineColour
        }

        map.setStyle(style)

      }
    })

    // add stats
    jQuery('.completed').html( jsObject.stats.completed )
    jQuery('.completed_percent').html( jsObject.stats.completed_percent )
    jQuery('.remaining').html( jsObject.stats.remaining )
    jQuery('.warriors').html( jsObject.stats.participants )
    jQuery('.time_elapsed').html( jsObject.stats.time_elapsed_small )
    jQuery('.start_time').html( jsObject.stats.start_time_formatted )

    update_stats()

    if ( jsObject.stats.remaining_int < 1 ) {
      jQuery('.on-going').show()
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

      jQuery('.holding-page .starts-on-date').html( `${jsObject.stats.start_time_formatted} <br/> ${startTime}` )
      jQuery('.holding-page .pray-button').html('Start warming up')
      holdingPage.show()

    } else {
      holdingPage.hide()
    }

    jQuery('#head_block').show()
    jQuery('#foot_block').show()
  } /* .preCache */

  function incrementCountdown() {
    const prayButton = jQuery('.holding-page .pray-button')
    let now = new Date().getTime() / 1000
    let timeLeft = jsObject.stats.start_time - now;

    if ( Math.floor( timeLeft ) === 0 ) {
      jQuery('.holding-page .time-remaining').html('Go')
      window.schoolPride()
      prayButton.html('Start Praying')
      prayButton.off('click')
      prayButton.on('click', () => {
        location.href = `/prayer_app/custom/${jsObject.parts.public_key}`
      })

      clearInterval(countdownInterval)
      return
    }

    const formattedTimeLeft = formatTimeLeft(timeLeft)
    jQuery('.holding-page .time-remaining').html(formattedTimeLeft)
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
          bodies_1 += '<i class="ion-ios-body red two-em"></i>';
          i++;
        }
        i = 0
        while ( i < response.location.percent_christian_adherents ) {
          bodies_2 += '<i class="ion-ios-body orange two-em"></i>';
          i++;
        }
        i = 0
        while ( i < response.location.percent_believers ) {
          bodies_3 += '<i class="ion-ios-body green two-em"></i>';
          i++;
        }
        div.html(
          `
          <div class="row">
              <div class="col-12">
                <hr class="mt-0" />
                <p><span class="stats-title two-em">${response.location.full_name}</span></p>
                <p>1 believer for every ${numberWithCommas(Math.ceil(response.location.all_lost_int / response.location.believers_int ) ) } lost neighbors.</p>
                <hr>
              </div>
              <div class="col-12">
                 <div class="row">
                    <div class="col-12 center">
                        <p><strong>Don't Know Jesus</strong></p>
                        <p>${bodies_1} <span>(${response.location.non_christians})</span></p>
                    </div>
                    <div class="col-12 center">
                        <p><strong>Know about Jesus</strong></p>
                        <p>${bodies_2} <span>(${response.location.christian_adherents})</span></p>
                    </div>
                    <div class="col-12 center">
                        <p><strong>Know Jesus</strong></p>
                        <p>${bodies_3} <span>(${response.location.believers})</span></p>
                    </div>
                </div>
                <hr>
              </div>
              <div class="col-12">
                The ${response.location.admin_level_name} of <strong>${response.location.full_name}</strong> has a population of ${response.location.population}. We estimate ${response.location.name} has ${response.location.non_christians} who are far from Jesus, ${response.location.christian_adherents} who might know about Jesus culturally, and ${response.location.believers} people who know Jesus personally.
                ${response.location.full_name} is 1 of ${response.location.peer_locations} ${response.location.admin_level_name_plural} in ${response.location.parent_name}.
                <hr>
              </div>
              <div class="col-12">
                Religion: ${response.location.primary_religion}<br>
                Official Language: ${response.location.primary_language}<br>
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
                <h1 class="header-border-top">Community Stats</h1>
                <p><span class="stats-title two-em">${response.location.full_name}</span></p>
                <hr />
                <p><span class="two-em">Summary</span></p>
                <p>Prayed for ${communityStats.times_prayed.total} ${communityStats.times_prayed.total > 1 ? 'times' : 'time'}</p>

                ${PG.IconInfographic(totalNumberStats)}

                <p>Total time prayed: ${communityStats.time_prayed.total} ${communityStats.time_prayed.total > 1 ? 'mins' : 'min'}</p>

                ${PG.IconInfographic(totalTimeStats)}

                <hr>
              </div>
              <div class="col-12">
                <p><span class="two-em">Activity</span></p>

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

    let binaryFill = {
      'fill-color': {
        property: 'value',
        stops: [[0, red], [1, green]]
      },
      'fill-opacity': 0.75,
      'fill-outline-color': 'black'
    }

    if ( jsObject.is_dark_map_on ) {
      binaryFill = {
        'fill-color': {
          property: 'value',
          stops: [[0, '#11224E'], [1, '#fff']]
        },
        'fill-opacity': 1,
        'fill-outline-color': 'black'
      }
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
        jQuery('.time_elapsed').html( jsObject.stats.time_elapsed_small )
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
        url: jsObject.mirror_url + 'tiles/world/flat_states/' + file,
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

    if ( show_cta ) {
      window.api_post_global( 'ctas', 'get_cta' )
        .then((cta) => {
          const content = `
            <h3 class="modal-title">${cta.post_title}</h3>
            ${cta.post_content}
          `
          cta_modal_body.innerHTML = content
          window.pg_set_up_share_buttons()
          jQuery(cta_modal).modal('show')
        })
    }
  }
})
