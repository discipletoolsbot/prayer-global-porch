jQuery(document).ready(function() {
  /**
   * API HANDLERS
   */
  window.api_post = (action, data) => {
    return jQuery.ajax({
      type: "POST",
      data: JSON.stringify({action: action, parts: jsObject.parts, data: data}),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
      beforeSend: function (xhr) {
        xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce)
      }
    })
      .fail(function (e) {
        console.log(e)
      })
  }

  window.api_post( 'get_global_list', {} )
    .done(function(data) {

            console.log(data)

            let html_content_active = ''
            let html_content_completed = ''

            jQuery.each( data, function(i,v){
              if ( v.status === 'active' ){
                html_content_active += `<tr>
                                <td>${v.start_time}</td>
                                <th><a href="/prayer_app/custom/${v.lap_key}">${v.post_title}</a></th>
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
                                <th><a href="/prayer_app/custom/${v.lap_key}">${v.post_title}</a></th>
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
              pageLength: 10,
              responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate,
                    type: '',
                    renderer: function ( api, rowIdx, columns ) {
                      var data = $.map( columns, function ( col, i ) {
                          return col.hidden ?
                              '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                  '<td class="dtr-title">'+col.title+':'+'</td> '+
                                  '<td class="dtr-data">'+col.data+'</td>'+
                              '</tr>' :
                              '';
                      } ).join('');

                      return data ?
                          $('<table/>').append( data ) :
                          false;
                  },
                },
              },
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
            pageLength: 10,
            responsive: {
              details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: '',
                renderer: function ( api, rowIdx, columns ) {
                  var data = $.map( columns, function ( col, i ) {
                    return col.hidden ?
                      '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                      '<td class="dtr-title">'+col.title+':'+'</td> '+
                      '<td class="dtr-data">'+col.data+'</td>'+
                      '</tr>' :
                      '';
                  } ).join('');

                  return data ?
                    $('<table/>').append( data ) :
                    false;
                },
              },
            },
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
