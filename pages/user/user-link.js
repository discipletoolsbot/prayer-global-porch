jQuery(document).ready(function(){

    const userProfileDetails = jQuery('#user-details-content')

    const challengeModal = jQuery('#create-challenge-modal')
    const challengeModalTitle = jQuery('#createChallengeLabel')
    const challengeTitleGroup = jQuery('.challenge-title-group')
    const challengeStartDateGroup = jQuery('.challenge-start-date-group')
    const challengeEndDateGroup = jQuery('.challenge-end-date-group')

    const challengeTitle = jQuery('#challenge-title')
    const challengeStartDate = jQuery('#challenge-start-date')
    const challengeStartTime = jQuery('#challenge-start-time')
    const challengeEndDate = jQuery('#challenge-end-date')
    const challengeEndTime = jQuery('#challenge-end-time')
    const challengeVisibility = jQuery('#challenge-visibility')
    const challengeModalAction = jQuery('#challenge-modal-action')
    const challengePostId = jQuery('#challenge-post-id')

    const challengeLoadingSpinner = jQuery('.challenge-loading')
    const createNewChallengeButton = jQuery('.create-new-challenge-button')
    const editChallengeButton = jQuery('.edit-challenge-button')
    const setChallengStartNowButton = jQuery('#set-challenge-start-to-now')
    const challengeHelpText = jQuery('#challenge-help-text')

    let isSavingLocation = false
    let isSavingChallenge = false


    window.getAuthUser(
        (user) => write_main( user ),
        () => window.loginRedirect()
    )

    jQuery('#delete-confirmation').on('keyup', (e) => {
        if (e.target.value === 'delete') {
            jQuery('#confirm-user-account-delete').prop( 'disabled', false)
        } else {
            jQuery('#confirm-user-account-delete').prop( 'disabled', true )
        }
    })
    jQuery('#confirm-user-account-delete').on('click', () => {
        get_user_app('delete_user')
            .then((confirmed) => {
                if (confirmed) {
                    window.location = '/'
                }
            })
    })

    jQuery('#location-modal').on('hidden.bs.modal', (e) => {
        jQuery('#mapbox-search').val('')
        jQuery('.mapbox-error-message').html('')
    })
    jQuery('#location-modal').on('shown.bs.modal', () => {
        jQuery('#mapbox-search').focus()
    })
    jQuery('#erase-user-account-modal').on('hidden.bs.modal', () => {
        jQuery('#delete-confirmation').val('')
    })
    challengeModal.on('hidden.bs.modal', () => {
        resetChallengeForm()
        isSavingChallenge = false
    })

    jQuery('.save-user-location').on('click', (e) => {
        const label = jQuery('#mapbox-search').val()

        const location = window.location_data &&
            window.location_data.location_grid_meta &&
            window.location_data.location_grid_meta.values &&
            Array.isArray(window.location_data.location_grid_meta.values)
                ? window.location_data.location_grid_meta.values[0]
                : null

        if ( label && label !== '' && location && location.label === label ) {

            if (isSavingLocation) {
                return
            }

            isSavingLocation = true

            jQuery('#mapbox-spinner-button').show()
            jQuery('.mapbox-error-message').html('')

            get_user_app('save_location', location)
                .then((location) => {
                    jsObject.user.location = location
                    jQuery('#location-modal').modal('hide')
                    jQuery('#mapbox-spinner-button').hide()
                    jQuery('#mapbox-search').val('')
                    jQuery('.user__location-label').html(location.label)
                    jQuery('.iplocation-message').empty()
                })
                .finally(() => {
                    isSavingLocation = false
                })
        } else {
            jQuery('.mapbox-error-message').html('Please select a location')
        }
    })

    setChallengStartNowButton.on('click', () => {
        const now = Date.now() / 1000

        challengeStartDate.val(toDateInputFormat(now))
        challengeStartTime.val(toTimeInputFormat(now))
    })

    function get_user_app (action, data ) {
        return window.api_fetch( jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type, {
            method: 'POST',
            body: JSON.stringify({ action: action, parts: jsObject.parts, data: data }),
        } )
    }

    function write_main (data) {
        const pgContentHTML = `

        <div class="flow">
            <section class="user__summary flow-small mt-5">

                <div class="user__avatar">
                    ${ data.stats
                        ? LocationBadge(data.stats.total_locations)
                        : `
                        <span class="user__badge loading">
                            <span class="loading-spinner active"></span>
                        </span>` }
                </div>

                <div class="user__info">
                    <h2 class="user__full-name">${data.display_name}</h2>
                    <p class="user__location small">
                        <span class="user__location-label">${data.location && data.location.label || LoadingSpinner()}</span>
                        ${LocationChangeButton()}
                        <span class="iplocation-message small d-block text-secondary">
                            ${data.location && data.location.source === 'ip' ? '(This is your estimated location)' : ''}
                        </span>
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
        </div>`
        jQuery('#pg_content').html(pgContentHTML);

        get_user_app('activity')
            .then((activity) => {
                if (!activity || activity.length === 0) {
                    return
                }
                jsObject.user.activity = activity
            })

        getChallenges('public')
        getChallenges('private')

        if ( !data.location || data.location === '' ) {
            // const pg_user_hash = Cookies.get('pg_user_hash')
            const pg_user_hash = localStorage.getItem('pg_user_hash')

            get_user_app('ip_location', { hash: pg_user_hash })
                .then((data) => {
                    if (!data || !data.location ) {
                        jQuery('.user__location-label').html('Please select your location')
                        return
                    }
                    jsObject.user.location = data.location
                    jsObject.user.location_hash = data.location_hash

                    jQuery('.user__location-label').html(data.location.label)
                    jQuery('.iplocation-message').html('(This is your estimated location)')
                })
        }

        jQuery('.user-profile-link').on('click', () => write_profile({
            name: data.display_name,
            email: data.user_email,
            location: data.location,
            send_lap_emails: data.send_lap_emails,
            send_general_emails: data.send_general_emails,
        }))
        jQuery('.user-prayers-link').on('click', () => write_prayers())
        jQuery('.user-challenges-link').on('click', () => write_challenges())

        /* Setup the mapbox search widget */
        window.write_input_widget()
   }

    function write_profile({
        name,
        email,
        location,
        send_lap_emails = false,
        send_general_emails = false,
    }) {
        const userDetailsContentHTML = `
        <h2 class="header-border-bottom">Profile</h2>
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
                        <span class="user__location-label">${location && location.label || 'Please set your location'}</span>
                        ${LocationChangeButton()}
                        <span class="iplocation-message small d-block text-secondary">
                            ${location && location.source === 'ip' ? '(This is your estimated location)' : ''}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <section class="communication-preferences flow-small">
            <h2 class="header-border-bottom">Communication Preferences</h2>

            <div>
                <div class="form-check small">
                    <input class="form-check-input user-check-preferences" type="checkbox" id="send_lap_emails" ${send_lap_emails && 'checked'}>
                    <label class="form-check-label" for="send_lap_emails">
                        Send me lap challenges via email
                    </label>
                </div>
                <div class="form-check small">
                    <input class="form-check-input user-check-preferences" type="checkbox" id="send_general_emails" ${send_general_emails && 'checked'}>
                    <label class="form-check-label" for="send_general_emails">
                        Send information about Prayer.Global, Zume, Pray4Movement and other Gospel Ambition projects via email
                    </label>
                </div>
            </div>
        </section>
        <section class="user-actions">
            <hr />
            <!--${ModalButton({
                text: "Data report for my account",
                modalId: "user-data-report",
                classes: 'btn-outline-dark small d-block',
            })}-->
            ${ModalButton({
                text: "Erase my account",
                modalId: "erase-user-account-modal",
                classes: "small btn-outline-danger d-block mt-3",
            })}
        </section>`
        jQuery('#user-details-content').html(userDetailsContentHTML)

        jQuery('.user-check-preferences').on('change', (e) => {
            get_user_app('update_user', {
                [e.target.id]: e.target.checked
            })
        })

        open_profile()
    }

    function write_prayers() {
        const prayersHTML = `
        <h2 class="header-border-bottom">Prayers</h2>
        <section class="user-stats flow">

            <div class="center">

                <div class="user__avatar">
                    <span class="user__badge loading">
                        <span class="loading-spinner active"></span>
                    </span>
                </div>

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

        </section>`
        userProfileDetails.html(prayersHTML)

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
                        .then((newActivity) => {
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
        const challengesHTML = `
        <section class="private-challenges flow-small">
            <h3 class="header-border-bottom">Private Challenges</h3>

            ${CreateChallengeButton( 'Private', 'private-challenge-button' )}

            <div class="d-flex justify-content-center private-challenges__list">
                <span class="loading-spinner active"></span>
            </div>
        </section>
        <section class="public-challenges flow-small">
            <h3 class="header-border-bottom">Public Challenges</h3>

            ${CreateChallengeButton( 'Public', 'public-challenge-button' )}

            <div class="d-flex justify-content-center public-challenges__list">
                <span class="loading-spinner active"></span>
            </div>
        </section>`
        userProfileDetails.html(challengesHTML)

        buildChallengeList( 'public' )
        buildChallengeList( 'private' )

        jQuery('#private-challenge-button').on('click', () => {
            challengeVisibility.val('private')
            challengeModalTitle.html('Create Private Challenge')
            challengeModalTitle[0].dataset.visibility = 'private'
        })
        jQuery('#public-challenge-button').on('click', () => {
            challengeVisibility.val('public')
            challengeModalTitle.html('Create Public Challenge')
            challengeModalTitle[0].dataset.visibility = 'public'
        })

        jQuery('.ongoing-challenge-button').on('click', () => {
            challengeTitleGroup.show()
            challengeStartDateGroup.show()
            challengeEndDateGroup.hide()
            challengeEndDate.attr('required', false)
            challengeEndTime.attr('required', false)

            challengeTitle.focus()
        })
        jQuery('.timed-challenge-button').on('click', () => {
            challengeTitleGroup.show()
            challengeStartDateGroup.show()
            challengeEndDateGroup.show()
            challengeEndDate.attr('required', true)
            challengeEndTime.attr('required', true)

            challengeTitle.focus()
        })

        jQuery('#challenge-form').on('submit', (event) => {
            event.preventDefault()
            if ( isSavingChallenge === true ) {
                return
            }
            isSavingChallenge = true
            challengeLoadingSpinner.addClass('active')
            challengeHelpText.html('')

            const challengeType = jQuery('input[name="challenge-type"]:checked').attr('id')
            const title = challengeTitle.val()
            const startDate = challengeStartDate.val()
            const startTime = challengeStartTime.val()
            const endDate = challengeEndDate.val()
            const endTime = challengeEndTime.val()
            const visibility = challengeVisibility.val()
            const modalAction = challengeModalAction.val()

            const data = {
                title,
                visibility,
                challenge_type: challengeType,
            }

            if ( modalAction === 'edit' ) {
                const post_id = challengePostId.val()
                data.post_id = post_id
            }

            const start_date_seconds = new Date( `${startDate} ${startTime}` ).getTime() / 1000

            data.start_date = start_date_seconds

            if ( challengeType === 'timed_challenge' ) {
                const end_date_seconds = new Date( `${endDate} ${endTime}` ).getTime() / 1000
                data.end_date = end_date_seconds

                if ( endDate < startDate ) {
                    challengeHelpText.html('The end date must be after the start date')
                    isSavingChallenge = false
                    challengeLoadingSpinner.removeClass('active')
                    return
                }
            }

            const actions = {
                'edit': 'edit_challenge',
                'create': 'create_challenge'
            }

            get_user_app( actions[modalAction], data)
                .then((challenge) => {
                    challengeModal.modal('hide')

                    getChallenges(visibility, () => {
                        buildChallengeList(visibility)
                    })
                })
                .catch(() => {
                    isSavingChallenge = false
                })
                .finally(() => {
                    challengeLoadingSpinner.removeClass('active')
                })
        })

        resetChallengeForm()

        open_profile()
    }

    function resetChallengeForm() {
        jQuery('input[name="challenge-type"]:checked').prop('checked', false)
        challengeTitleGroup.hide()
        challengeStartDateGroup.hide()
        challengeEndDateGroup.hide()
        challengeTitle.val('')
        challengeStartDate.val('')
        challengeStartTime.val('')
        challengeEndDate.val('')
        challengeEndTime.val('')
        challengeEndDate.attr('required', false)
        challengeEndTime.attr('required', false)
        createNewChallengeButton.show()
        editChallengeButton.hide()
        challengeModalAction.val('create')
        challengePostId.val('')
    }

    function setChallengeForm({ visibility, challenge_type, post_title, start_time, end_time, post_id }) {
        jQuery('input[name="challenge-type"]#' + challenge_type).prop('checked', true)
        jQuery('#createChallengeLabel').data('visibility', visibility)
        challengeModalAction.val('edit')
        challengePostId.val(post_id)
        challengeModalTitle[0].dataset.visibility = visibility
        challengeTitleGroup.show()
        challengeTitle.val(post_title)
        challengeVisibility.val(visibility)
        challengeStartDateGroup.show()
        challengeStartDate.val(toDateInputFormat(start_time))
        challengeStartTime.val(toTimeInputFormat(start_time))
        if ( challenge_type === 'ongoing_challenge' ) {
            challengeEndDateGroup.hide()
        } else {
            challengeEndDateGroup.show()
            challengeEndDate.val(toDateInputFormat(end_time))
            challengeEndTime.val(toTimeInputFormat(end_time))
            challengeEndDate.attr('required', true)
            challengeEndTime.attr('required', true)
        }
        createNewChallengeButton.hide()
        editChallengeButton.show()
    }

    function toDateInputFormat(timestamp) {
        const date = new Date( Number(timestamp) * 1000 )
        let isoString
        try {
            isoString = date.toISOString()
        } catch (error) {
            isoString = ''
        }
        const isoDate = isoString.split('T')[0]
        return isoDate
    }

    function toTimeInputFormat(timestamp) {
        const date = new Date( Number(timestamp) * 1000 )
        let timeString
        try {
            timeString = date.toTimeString().split(':').slice(0,2).join(':')
        } catch (error) {
            timeString = ''
        }
        return timeString
    }

    function getChallenges( visibility, callback ) {
        get_user_app( 'get_challenges', { visibility } )
            .then((challenges) => {
                jsObject.user[visibility + '_challenges'] = challenges

                if ( callback ) {
                    callback(challenges)
                }
            })
    }

    function buildChallengeList( visibility ) {

        const containers = {
            public: '.public-challenges__list',
            private: '.private-challenges__list',
        }

        const containerSelector = containers[visibility]
        const container = jQuery(containerSelector)

        const challenges = jsObject.user[visibility + '_challenges']

        if (!challenges || !Array.isArray(challenges) || challenges.length === 0) {
            container.html('No ' + visibility + ' challenges found')
        } else {
            container.html( buildChallengeListHTML( challenges ) )
        }

        jQuery( containerSelector + ' .edit-challenge-button').on('click', function() {
            const challengeId = Number(this.dataset.challengeId)

            const challenges = jsObject.user[visibility + '_challenges']

            const challenge = challenges.find(({ post_id }) => Number(post_id) === challengeId)

            if ( !challenge ) {
                return
            }

            setChallengeForm(challenge)
        })

    }

    function buildChallengeListHTML( challenges ) {
        const tableHead = `
            <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
`

        let tableBody = ''
        challenges.forEach((challenge) => {
            const urlRoot = `/prayer_app/custom/${challenge.lap_key}`
            tableBody += `
                <tr>
                    <td><a href="${urlRoot}/map">${challenge.post_title}</a></td>
                    <td style="width: 5%">
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle rounded-circle border-0 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                <i class="icon ion-android-more-vertical fs-3"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#create-challenge-modal" data-challenge-id="${challenge.post_id}" class="dropdown-item edit-challenge-button">Edit</a></li>
                                <li><a href="${urlRoot}/tools" class="dropdown-item">Share Tools</a></li>
                                <li><a href="${urlRoot}/display" class="dropdown-item">Display Map</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
`
        })

        const html = `
        <table class="table">
            ${tableHead}
            <tbody>
                ${tableBody}
            </tbody>
        </table>`

        return html
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
            buttonType: 'outline-primary',
            classes: 'small border-0',
            id: 'change-location',
        })
    }

    function CreateChallengeButton( type, id ) {

        const icon = type.toLowerCase() === 'private' ? 'locked' : 'unlocked'

        let text = '<i class="icon ion-' + icon + ' me-2"></i>'

        text += 'New ' + type + ' Challenge'

        return ModalButton({
            text,
            modalId: 'create-challenge-modal',
            buttonType: 'outline-dark',
            classes: 'd-block mx-auto',
            id,
        })
    }

    /**
     * Creates markup for a button to trigger a modal
     *
     * @param string text The text to show in the button
     * @param string modalId The id of the modal to trigger
     * @param string buttonType The classtype of the button e.g. primary, outline-success etc. (see bootstrap)
     * @param string classes Optional extra classes
     * @param string id Optional id to give the button
     */
    function ModalButton({ text, modalId, buttonType = '', classes = '', id = '', dataAttributes = [] } ) {

        const attributes = []
        dataAttributes.forEach(({name, value}) => {
            attributes.push(`data-${name}="${value}"`)
        })
        const dataAttributesHTML = attributes.join(' ')

        return `
        <button id="${id}" class="btn btn-${buttonType} ${classes}" data-bs-toggle="modal" data-bs-target="#${modalId}" ${dataAttributesHTML}>
            ${text}
        </button>`
    }
})

