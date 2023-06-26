jQuery(document).ready(function() {
  /**
   * API HANDLERS
   */
  window.api_post = (action, data) => {
    return window.api_fetch( jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type, {
      method: "POST",
      body: JSON.stringify({action: action, parts: jsObject.parts, data: data}),
    })
      .catch(function (e) {
        console.log(e)
      })
  }

  window.api_post( 'get_global_list', {} )
    .then(function(data) {

            let html_content_active = ''
            let html_content_completed = ''

            jQuery.each( data, function(i,v){
              const lapNumber = v.lap_number || '1'
              if ( v.status === 'active' ){
                html_content_active += `<tr>
                                <td>${v.start_time}</td>
                                <th class="white">${v.post_title} ${!jsObject.is_rolling_laps_feature_on || v.single_lap === '1' ? '' : `- Lap ${lapNumber}`}</th>
                                <td style="text-align:right;">
                                  <a href="/prayer_app/custom/${v.lap_key}">Pray</a> |
                                  <a href="/prayer_app/custom/${v.lap_key}/map">Map</a> |
                                  <a href="/prayer_app/custom/${v.lap_key}/tools">Sharing</a> |
                                  <a href="/prayer_app/custom/${v.lap_key}/display">Display</a>
                                </td>
                              </tr>`
              } else if ( v.status === 'complete' ) {
                html_content_completed += `<tr>
                                <td>${v.start_time}</td>
                                <th class="white">${v.post_title} ${!jsObject.is_rolling_laps_feature_on || v.single_lap === '1' ? '' : `- Lap ${lapNumber}`}</th>
                                <td>${v.stats.participants}</td>
                                <td>${v.stats.time_elapsed_small}</td>
                                <td style="text-align:right;">
                                  <a href="/prayer_app/custom/${v.lap_key}/map">Map</a>
                                </td>
                              </tr>`
              }

            })

            jQuery('#active_content').html(
                  `<table class="display " style="width:100%;" id="list-table-active" data-order='[[ 0, "desc" ]]'>
                          <thead>
                              <th></th>
                              <th>Name</th>
                              <th class="desktop">Links</th>
                            </thead>
                          <tbody>
                             ${html_content_active}
                          </tbody>
                          </table>`
            )
            jQuery('#list-table-active').DataTable({
              lengthChange: false,
              pageLength: 3,
              pagingType: 'simple',
              responsive: true,
              order: [[0, 'desc']],
              columnDefs: [
                {
                  target: 0,
                  visible: false,
                }
              ],
            });


          jQuery('#complete_content').html(
            `<table class="display " style="width:100%;" id="list-table-completed" data-order='[[ 0, "desc" ]]'>
                                    <thead>
                                        <th></th>
                                        <th>Name</th>
                                        <th class="desktop">Warriors</th>
                                        <th class="desktop">Time Elapsed</th>
                                        <th class="desktop">Links</th>
                                      </thead>
                                    <tbody>
                                       ${html_content_completed}
                                    </tbody>
                                    </table>`
          )
          jQuery('#list-table-completed').DataTable({
            lengthChange: false,
            pageLength: 3,
            pagingType: 'simple',
            responsive: true,
            order: [[0, 'desc']],
            columnDefs: [
              {
                target: 0,
                visible: false,
              }
            ],
          });

    }) // end post api
}) // end .ready
