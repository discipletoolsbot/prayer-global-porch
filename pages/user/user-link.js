jQuery(document).ready(function(){

    const userProfileDetails = jQuery('#user-details-content')

    if ( jsObject.is_logged_in ) {
        write_main( jsObject.user.data )
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
                    write_main(data)
                }
            })
    }

    function show_user_nav() {
        const userNav = document.getElementById('user-nav')
        if (!userNav) return
        userNav.style.display = 'block'
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

    function write_main (data) {
        jQuery('#pg_content').html(`

            <div class="flow">
                <section class="user__summary flow-small mt-5">

                    ${Badge()}

                    <div class="user__info">
                        <h2 class="user__full-name">${data.display_name}</h2>
                        <p class="user__location small">
                            ${data.location || 'Please set your location'}
                        </p>
                    </div>
                </section>
                <section class="profile-menu px-2 mt-5">
                    <div class="navbar-nav">
                        <div class="user-profile-link nav-link px-1 py-2 d-flex justify-content-between align-items-center border-0">
                            <span class="two-em">Profile</span>
                            <i class="ion-chevron-right three-em"></i>
                        </div>
                        <div class="user-prayers-link nav-link px-1 py-2 d-flex justify-content-between align-items-center">
                            <span class="two-em">Prayers</span>
                            <i class="ion-chevron-right three-em"></i>
                        </div>
                        <div class="user-challenges-link nav-link px-1 py-2 d-flex justify-content-between align-items-center">
                            <span class="two-em">Challenges</span>
                            <i class="ion-chevron-right three-em"></i>
                        </div>
                    </div>
                </section>
                <a class="btn btn-outline-dark" href="${jsObject.logout_url}">Logout</a><br>
            </div>
            <span id="pg_user_id">${data.ID}</span>
`
        );

        jQuery('.user-profile-link').on('click', () => write_profile({
            name: data.display_name,
            email: data.user_email,
            location: data.location,
            sendLapEmails: data.send_lap_emails,
            sendGeneralEmails: data.send_general_emails,
        }))
        jQuery('.user-prayers-link').on('click', () => write_prayers())
        jQuery('.user-challenges-link').on('click', () => write_challenges())
    }

    function write_profile({
        name,
        email,
        location,
        sendLapEmails = true,
        sendGeneralEmails = false,
    }) {
        jQuery('#user-details-content').html(`
            <h2 class="header-border-bottom center">Profile</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td>${name}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>${email}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td>${location || 'Please set your location'}</td>
                    </tr>
                </tbody>
            </table>
            <section class="communication-preferences flow-small">
                <h2 class="header-border-bottom center">Communication Preferences</h2>

                <div>
                    <div class="form-check small">
                        <input class="form-check-input" type="checkbox" id="send-lap-emails" ${sendLapEmails && 'checked'}>
                        <label class="form-check-label" for="send-lap-emails">
                            Send me lap challenges via email
                        </label>
                    </div>
                    <div class="form-check small">
                        <input class="form-check-input" type="checkbox" id="send-general-emails" ${sendGeneralEmails && 'checked'}>
                        <label class="form-check-label" for="send-general-emails">
                            Send information about Prayer.Global, Zume, Pray4Movement and other Gospel Ambition projects via email
                        </label>
                    </div>
                </div>
            </section>
            <section class="user-actions">
                <hr />
                <a href="#" class="btn small">Data report for my account</a>
                <button class="btn small btn-outline-danger mt-5">Erase my account</button>
            </section>
`
        )
        open_profile()
    }

    function write_prayers() {
        userProfileDetails.html(`
            <h2 class="header-border-bottom center">Prayers</h2>
            <section class="user-stats flow">

                <div class="center">

                    ${Badge()}

                </div>
                <div class="d-flex justify-content-around">
                    <div class="center">
                        <h4>Locations</h4>
                        <span class="three-em user-total-locations">0</span>
                    </div>
                    <div class="center">
                        <h4>Minutes</h4>
                        <span class="three-em user-total-minutes">0</span>
                    </div>
                </div>

            </section>
`
        )
        get_user_app( 'activity' )
            .done((activity) => {
                console.log(activity)
                if (!activity || activity.length === 0) {
                    return
                }
                const { total_locations, total_time, logs } = activity

                jQuery('.user-total-locations').html(total_locations)
                jQuery('.user-total-minutes').html(total_time)
            })
        open_profile()
    }

    function write_challenges() {
        console.log('write challenges');
        open_profile()
    }

    function open_profile() {
        jQuery('#user-profile-details').offcanvas('show')
    }

    function Badge() {
        return `
            <div class="user__badge">
                <img class="rounded-circle" src="https://picsum.photos/150" alt="random lorem picsum image" />
            </div>
`
    }
})
