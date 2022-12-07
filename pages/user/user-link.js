jQuery(document).ready(function(){

    const userProfileDetails = jQuery('#user-details-content')

    if ( jsObject.is_logged_in ) {
        write_main( jsObject.user )
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
                jQuery('.loading-spinner').removeClass('active')
                if ( data ) {
                    show_user_nav()
                    write_main(data)
                }
            })
    }

    function show_user_nav() {
        const loginRegisterLink = jQuery('#login-register-link')
        const userProfileLink = jQuery('#user-profile-link')
        const logoutLink = jQuery('#logout-link')

        loginRegisterLink.hide()
        userProfileLink.show()
        logoutLink.show()
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

                    <div class="user__avatar"></div>

                    <div class="user__info">
                        <h2 class="user__full-name">${data.display_name}</h2>
                        <p class="user__location small">
                            ${data.location && data.location.label || LoadingSpinner()}
                            ${LocationChangeButton()}
                        </p>
                    </div>
                </section>
                <section class="profile-menu px-2 mt-5">
                    <div class="navbar-nav">
                        <button class="user-profile-link nav-link px-1 py-2 d-flex justify-content-between align-items-center border-bottom border-1 border-dark">
                            <span class="two-em">Profile</span>
                            <i class="ion-chevron-right three-em"></i>
                        </button>
                        <button class="user-prayers-link nav-link px-1 py-2 d-flex justify-content-between align-items-center border-bottom border-1 border-dark">
                            <span class="two-em">Prayers</span>
                            <i class="ion-chevron-right three-em"></i>
                        </button>
                        <button class="user-challenges-link nav-link px-1 py-2 d-flex justify-content-between align-items-center border-bottom border-1 border-dark">
                            <span class="two-em">Challenges</span>
                            <i class="ion-chevron-right three-em"></i>
                        </button>
                    </div>
                </section>
                <a class="btn btn-outline-dark" href="${jsObject.logout_url}">Logout</a><br>
            </div>
            <span id="pg_user_id">${data.ID}</span>
`
        );

        get_user_app('stats')
            .done((stats) => {
                if (!stats || stats.length === 0) {
                    return
                }
                jsObject.user.stats = stats
                jQuery('.user__avatar').html(LocationBadge(stats.total_locations || 0))
            })

        get_user_app('activity')
            .done((activity) => {
                if (!activity || activity.length === 0) {
                    return
                }
                jsObject.user.activity = activity
            })

        if ( !data.location || data.location === '' ) {
            const error = () => {
                jQuery('.user__location').html('Please select your location')
            }

            if (navigator.geolocation) {
                const success = (location) => {
                    const lat = location.coords.latitude
                    const lng = location.coords.longitude
                    get_user_app('ip_location', { lat, lng })
                        .done((location) => {
                            if (!location || location === "") {
                                error()
                                return
                            }
                            jsObject.user.location = location
                            jsObject.user.is_ip_location = 1

                            jQuery('.user__location').html(location.label)

                            return get_user_app('update_user', {
                                location,
                                is_ip_location: true,
                                lat,
                                lng
                            })
                        })
                }

                navigator.geolocation.getCurrentPosition(success, error)
            } else {
                error()
            }
        }


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
                        <td>
                            ${location || 'Please set your location'}
                            ${LocationChangeButton()}
                        </td>
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

                    <div class="user__avatar"></div>

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

                <section class="user-activity">
                    <div class="user-activity__list"></div>
                    <button class="btn btn-outline-dark mt-5 mx-auto d-block" id="load-more-user-activity" style="display: none">Load more</button>
                </section>

            </section>
`
        )

        if (jsObject.user.activity && jsObject.user.stats) {
            const { offset, limit, logs } = jsObject.user.activity
            const { total_minutes, total_locations } = jsObject.user.stats

            const handlePrimaryContent = ({ location_name, time_prayed_text }) => `${time_prayed_text} for ${location_name || 'Location name goes here'}`
            const handleSecondaryContent = ({ time_prayed_text, group_name }) => `in ${group_name}`

            jQuery('.user-total-locations').html(total_locations)
            jQuery('.user-total-minutes').html(total_minutes)
            jQuery('.user__avatar').html(LocationBadge(total_locations))
            jQuery('.user-activity__list').html(PG.ActivityList(logs, handlePrimaryContent, handleSecondaryContent))

            const logsLeft = total_locations - ( offset + limit )
            if ( logsLeft > 0 ) {
                const loadMoreButton = jQuery('#load-more-user-activity')

                loadMoreButton.show()
                const getMoreActivity = () => {
                    const { offset, limit } = jsObject.user.activity
                    get_user_app('activity', { offset: offset + limit, limit })
                        .done((newActivity) => {
                            const activity = {
                                offset: newActivity.offset,
                                limit: newActivity.limit,
                                logs: [
                                    ...jsObject.user.activity.logs,
                                    ...newActivity.logs,
                                ]
                            }
                            jsObject.user.activity = activity

                            jQuery('.user-activity__list').append(PG.ActivityList(newActivity.logs, handlePrimaryContent, handleSecondaryContent))

                            const newLogsLeft = total_locations - (newActivity.offset + limit)

                            if (newLogsLeft > 0) {
                                loadMoreButton.one('click', getMoreActivity)
                            } else {
                                loadMoreButton.removeClass('d-block')
                                loadMoreButton.hide()
                            }
                        })
                }
                loadMoreButton.one('click', getMoreActivity)
            }

        }
        open_profile()
    }

    function write_challenges() {
        console.log('write challenges');
        open_profile()
    }

    function open_profile() {
        jQuery('#user-profile-details').offcanvas('show')
    }

    function LocationBadge(totalLocations) {

        const colorSchemes = {
            disabled: {
                'primary-color': '#fff',
                'primary-shadow': '#fff',
                'secondary-color': '#fff',
                'light-border': '#000',
                'dark-border': '#000',
                'darker-border': '#000',
                'icon-color': '#000',
                'inner-border-size': '2px',
                'outer-border-size': '2px',
                'sheen-width': 0,
            },
            bronze: {
                'primary-color': '#f1a14f',
                'primary-shadow': '#87340c',
                'secondary-color': '#e57d2a',
                'light-border': '#c36527',
                'dark-border': '#a44028',
                'darker-border': '#8c350b',
            },
            silver: {
                'primary-color': '#d2d2d0',
                'primary-shadow': '#7e7e7e',
                'secondary-color': '#bfbebc',
                'light-border': '#f5f4f1',
                'dark-border': '#adadad',
                'darker-border': '#62615d',
            },
            gold: {
                'primary-color': '#ffbd0b',
                'primary-shadow': '#cb7407',
                'secondary-color': '#f0a608',
                'light-border': '#ffd84c',
                'dark-border': '#d57e08',
                'darker-border': '#c47207',
            },
            platinum: {
                'primary-color': '#96d4f5',
                'primary-shadow': '#0762a4',
                'secondary-color': '#6fbde6',
                'light-border': '#caeeff',
                'dark-border': '#0d8adb',
                'darker-border': '#022a66',
            },
        }

        let styles = {}
        let text = ''

        if (totalLocations >= 5000) {
            styles = colorSchemes['platinum']
            text = '5000'
        } else if (totalLocations >= 2000 ) {
            styles = colorSchemes['gold']
            text = '2000'
        } else if (totalLocations >= 1000 ) {
            styles = colorSchemes['gold']
            text = '1000'
        } else if (totalLocations >= 500 ) {
            styles = colorSchemes['silver']
            text = '500'
        } else if (totalLocations >= 100 ) {
            styles = colorSchemes['silver']
            text = '100'
        } else if (totalLocations >= 50 ) {
            styles = colorSchemes['bronze']
            text = '50'
        } else if (totalLocations >= 10 ) {
            styles = colorSchemes['bronze']
            text = '10'
        } else if (totalLocations >= 5 ) {
            styles = colorSchemes['bronze']
            text = '5'
        } else if (totalLocations >= 1 ) {
            styles = colorSchemes['bronze']
            text = '1'
        } else {
            styles = colorSchemes['disabled']
            text = '0'
        }

        const disabled = totalLocations === 0

        return Badge({ text, icon: 'location', styles, disabled })
    }

    /**
     * The .user__badge class has several CSS variables on it for customising the color and size of the badge
     *
     *     --pg-badge-primary-color: #ffbd0b; The outer background color and icon color
     *     --pg-badge-primary-shadow: #cb7407; The shadow color of the icon
     *     --pg-badge-secondary-color: #f0a608; The inner background color
     *     --pg-badge-light-border: #ffd84c; The lighter half of the borders
     *     --pg-badge-dark-border: #d57e08; The darker half of the borders
     *     --pg-badge-darker-border: #c47207; The inner shadow of the side lines
     *     --pg-badge-icon-color: defaults to primary-color
     *     --pg-badge-rotation: 44deg;
     *     --pg-badge-size: 150px;
     *     --pg-badge-inner-size: 70px;
     *     --pg-badge-outer-border-size: 7px;
     *     --pg-badge-inner-border-size: 5px;
     *     --pg-badge-icon-size: 50px;
     *     --pg-badge-sheen-width: 40px;
     *
     * Pass parameters with these names in styles (excluding the --) to change the properties e.g. 'primary-color': #F00
     *
     * @param string text The text to put at the bottom of the badge
     * @param string icon The ion icon class name e.g. location/sparkles etc.
     * @param object styles The styles to customise the badge
     */
    function Badge({ text, icon, styles, disabled }) {

        const style = Object.entries(styles)
            .map(([key, value]) => `--pg-badge-${key}: ${value}`)
            .join('; ')

        return `
            <div class='user__badge' style="${style}" ${disabled ? 'disabled' : ''}>
                <div class='front jump'>
                    <span class='badge__icon'>
                        <i class="icon ion-${icon}"></i>
                    </span>
                    <div class='shapes'>
                        <div class='shape_l'></div>
                        <div class='shape_r'></div>
                        <span class='bottom'>${text}</span>
                    </div>
                </div>
            </div>
`
    }

    function LoadingSpinner(active = true) {
        const activeAttr = active ? 'active' : ''

        return `<span class="loading-spinner ${activeAttr}"></span>`
    }

    function LocationChangeButton() {
        return ModalButton({
            text: 'Change',
            modalId: 'location-modal',
            buttonType: 'outline-success',
            classes: 'small border-0',
            id: 'new-mapbox-search',
        })
    }
    /**
     * Creates markup for a button to trigger a modal
     * 
     * @param string text The text to show in the button
     * @param string modalId The id of the modal to trigger
     * @param string buttonType The classtype of the button e.g. primary, outline-success etc. (see bootstrap)
     */
    function ModalButton({ text, modalId, buttonType = '', classes = '', id = '' }) {

        return `
        <button id="${id}" class="btn btn-${buttonType} ${classes}" data-bs-toggle="modal" data-bs-target="#${modalId}">
            ${text}
        </button>`
    }
})
