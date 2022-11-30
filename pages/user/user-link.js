jQuery(document).ready(function(){

    const userDetailsPanel = document.getElementById('user-profile-details')
    const userDetailsContent = document.getElementById('user-details-content')

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
                    <div class="user__badge">
                        <img class="rounded-circle" src="https://picsum.photos/150" alt="random lorem picsum image" />
                    </div>
                    <div class="user__info">
                        <h2 class="user__full-name"></h2>
                        <p class="user__location fs-6">
                            Birmingham, UK (place-holder)
                        </p>
                    </div>
                </section>
                <section class="profile-menu navbar-nav justify-content-end px-2 mt-5">
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
                </section>
                <a class="btn btn-outline-dark" href="${jsObject.logout_url}">Logout</a><br>
            </div>
            <span id="pg_user_id"></span>
`
        );
        jQuery('#pg_user_id').html(data.ID)
        jQuery('.user__full-name').html(data.display_name)
        jQuery('.user__location').html(data.location)

        jQuery('.user-profile-link').on('click', write_profile)
        jQuery('.user-prayers-link').on('click', write_prayers)
        jQuery('.user-challenges-link').on('click', write_challenges)
    }

    function write_profile() {
        console.log('write profile')
        open_profile()
    }

    function write_prayers() {
        console.log('write prayers');
        open_profile()
    }

    function write_challenges() {
        console.log('write challenges');
        open_profile()
    }

    function open_profile() {
        jQuery('#user-profile-details').offcanvas('show')
    }
})
