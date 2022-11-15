jQuery(document).ready(function(){

    if ( jsObject.is_logged_in ) {
        write_profile( jsObject.user.data )
    } else {
        write_login()
    }


    function get_user_app (action, data ) {
        return jQuery.ajax({
            type: "POST",
            data: JSON.stringify({ action: action, parts: jsObject.parts, data: data }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
            }
        })
            .fail(function(e) {
                console.log(e)
                jQuery('#error').html(e)
            })
    }

    function send_login () {
        let email = jQuery('#pg_input_email').val()
        let pass = jQuery('#pg_input_password').val()
        jQuery('.loading-spinner').addClass('active')

        get_user_app('login', { email: email, pass: pass } )
            .done(function(data){
                console.log(data)
                jQuery('.loading-spinner').removeClass('active')
                if ( data ) {
                    show_user_nav()
                    write_profile(data)
                }
            })
    }

    function show_user_nav() {
        const userNav = document.getElementById('user-nav')
        userNav.style.display = 'block'
    }

    function write_profile (data) {
        jQuery('#pg_content').html(`
            <section id="my-stats" class="user-details">
                <h2>Details</h2>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>User ID</td>
                        <td id="pg_user_id"></td>
                    </tr>
                    <tr>
                        <td>User Display Name</td>
                        <td id="pg_user_display"></td>
                    </tr>
                    <tr>
                        <td>User Email</td>
                        <td id="pg_user_email"></td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <hr />

            <section class="user-stats">
                <h2>Stats</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Locations</td>
                            <td id="pg_stats_locations">25</td>
                        </tr>
                        <tr>
                            <td>Time Prayed</td>
                            <td id="pg_stats_time">45 mins</td>
                        </tr>
                        <tr>
                            <td>Locations per day</td>
                            <td id="pg_stats_speed">5</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <hr />

            <a href="#" class="btn smoothscroll btn-outline-dark btn-xl" data-reverse-color>My Map</a>

            <hr />

            <section id="my-groups" class="user-groups flow-small">
                <h2>Groups</h2>
                <h3 class="text-start">Leading</h3>
                <table class="display " style="width:100%;" id="leading-list-table" data-order='[[ 0, "desc" ]]'>
                    <thead>
                        <th></th>
                        <th>Name</th>
                        <th class="desktop">Warriors</th>
                        <th class="desktop">Covered</th>
                        <th class="desktop">Remaining</th>
                        <th class="desktop">Pace</th>
                        <th class="desktop">Links</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>blah</td>
                            <td>My first group</td>
                            <td>10</td>
                            <td>100</td>
                            <td>4670</td>
                            <td>50</td>
                            <td>
                                <a href="#">Map</a>
                                <a href="#">Sharing</a>
                                <a href="#">Display</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="text-start">Participating</h3>
                <table class="display " style="width:100%;" id="leading-list-table" data-order='[[ 0, "desc" ]]'>
                    <thead>
                        <th></th>
                        <th>Name</th>
                        <th class="desktop">Warriors</th>
                        <th class="desktop">Covered</th>
                        <th class="desktop">Remaining</th>
                        <th class="desktop">Pace</th>
                        <th class="desktop">Links</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>blah</td>
                            <td>Let's cover the world</td>
                            <td>10</td>
                            <td>100</td>
                            <td>4670</td>
                            <td>50</td>
                            <td>
                                <a href="#">Map</a>
                                <a href="#">Sharing</a>
                                <a href="#">Display</a>
                            </td>
                        </tr>
                        <tr>
                            <td>blah</td>
                            <td>Global Prayer Group</td>
                            <td>10</td>
                            <td>100</td>
                            <td>4670</td>
                            <td>50</td>
                            <td>
                                <a href="#">Map</a>
                                <a href="#">Sharing</a>
                                <a href="#">Display</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </section>


            <a href="${jsObject.logout_url}">Logout</a>`
        );
        jQuery('#pg_user_id').html(data.ID)
        jQuery('#pg_user_display').html(data.display_name)
        jQuery('#pg_user_email').html(data.user_email)

    }
    function write_login () {
        jQuery('#pg_content').html(`
                <form id="login_form">
                    <p>
                        Email<br>
                        <input type="text" id="pg_input_email"  />
                    </p>
                    <p>
                        Password<br>
                        <input type="password" id="pg_input_password" />
                    </p>
                    <p>
                        <button type="button" id="submit_button">Submit</button> <span class="loading-spinner"></span>
                    </p>
                </form>`
        )
        jQuery('#submit_button').on('click', function(){
            send_login()

        })
    }

})