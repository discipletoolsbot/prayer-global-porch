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
                    write_profile(data)
                }
            })
    }

    function write_profile (data) {
        jQuery('#pg_content').html(`
            <section id="my-stats" class="user-details">
                <h2 class="header-border-top">Profile</h2>
                <table class="table">
                    <tbody>
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

            <section class="user-stats">
                <h2 class="header-border-top">Stats</h2>
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

            <a href="${jsObject.logout_url}">Logout</a><br>
            <span id="pg_user_id"></span>
            <span id="pg_user_id"></span>
`
        );
        jQuery('#pg_user_id').html(data.ID)
        jQuery('#pg_user_display').html(data.display_name)
        jQuery('#pg_user_email').html(data.user_email)

    }
    function write_login () {
        jQuery('#pg_content').html(`
                <form id="login_form">
                    <p>
                        <h2 class="header-border-top">Login</h2>
                    </p>
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
