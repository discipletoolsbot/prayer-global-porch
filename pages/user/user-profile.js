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
    const challengeSingleLap = jQuery('#challenge-single-lap')
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

    const {
        select_a_location,
        estimated_location,
        prayers,
        profile,
        challenges,
        are_you_enjoying_the_app,
        would_you_like_to_partner,
        consider_giving,
        give,
        logout,
        name_text,
        email_text,
        location_text,
        locations_text,
        communication_preferences,
        send_lap_emails_text,
        send_general_emails_text,
        erase_account,
        minutes,
        load_more,
        time_prayed_for,
        in_group_text,
        new_challenge,
        public,
        private,
        public_relays,
        private_relays,
        view_join_other_relays,
        no_relays_found,
        private_explanation1,
        private_explanation2,
        public_explanation1,
    } = jsObject.translations


    window.getAuthUser(
        (user) => {
            write_main( user )
        },
        () => {
            window.loginRedirect()
        }
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

    jQuery('#details-modal').on('hidden.bs.modal', (e) => {
        jQuery('#mapbox-search').val('')
        jQuery('.mapbox-error-message').html('')
    })
    jQuery('#details-modal').on('shown.bs.modal', () => {
    })
    jQuery('#details-modal').on('shown.bs.modal', () => {
        jQuery('#display_name').focus()
    })
    jQuery('#erase-user-account-modal').on('hidden.bs.modal', () => {
        jQuery('#delete-confirmation').val('')
    })
    challengeModal.on('hidden.bs.modal', () => {
        resetChallengeForm()
        isSavingChallenge = false
    })

    jQuery('.save-user-details').on('click', (e) => {
        const newLocation = jQuery('#mapbox-search').val()
        const display_name = jQuery('#display_name').val()

        let location = window.location_data &&
            window.location_data.location_grid_meta &&
            window.location_data.location_grid_meta.values &&
            Array.isArray(window.location_data.location_grid_meta.values)
                ? window.location_data.location_grid_meta.values[0]
                : null

        // If the location is null and the user has a location, then we are editing, and not choosing a new location
        if ( location === null && jsObject.user.location ) {
            location = jsObject.user.location
        }

        if ( newLocation && newLocation !== '' && location && location.label === newLocation ) {

            if (isSavingLocation) {
                return
            }

            isSavingLocation = true

            jQuery('#mapbox-spinner-button').show()
            jQuery('.mapbox-error-message').html('')

            get_user_app('save_details', { location, display_name })
                .then(({ location, display_name }) => {
                    jsObject.user.location = location
                    jsObject.user.name = display_name
                    jQuery('#details-modal').modal('hide')
                    jQuery('#mapbox-spinner-button').hide()
                    jQuery('#mapbox-search').val('')
                    jQuery('.user__location-label').html(location.label)
                    jQuery('.user__full-name').html(display_name)
                    jQuery('.iplocation-message').empty()
                    setup_details_modal()
                })
                .finally(() => {
                    isSavingLocation = false
                })
        } else {
            jQuery('.mapbox-error-message').html(select_a_location)
        }
    })

    const challenge_type_buttons = $('.challenge-type')
    challenge_type_buttons.on('click', function(e) {
        challenge_type_buttons.removeClass('btn-secondary').addClass('btn-outline-secondary')
        e.currentTarget.classList.add('btn-secondary')
        e.currentTarget.classList.remove('.btn-outline-secondary')
    })

    setChallengStartNowButton.on('click', () => {
        const now = Date.now() / 1000

        challengeStartDate.val(toDateInputFormat(now))
        challengeStartTime.val(toTimeInputFormat(now))
    })

    function get_user_app(action, data = {} ) {
        return window.api_fetch( jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type, {
            method: 'POST',
            body: JSON.stringify({ action: action, parts: jsObject.parts, data: data }),
        } )
    }

    function get_user_api(endpoint, data = {}) {
        return window.api_fetch( `/wp-json/pg-api/v1/user/${endpoint}`, {
            method: 'POST',
            body: JSON.stringify({ parts: jsObject.parts, data: data }),
        })
    }
    function setup_details_modal() {
        const { display_name, location: { label } } = jsObject.user
        jQuery('#display_name').val(display_name)
        jQuery('#mapbox-search').val(label)
    }

    function write_main (data) {
        console.log(data)

        setup_details_modal()
        const pgContentHTML = `

        <div class="flow-medium">
            <section class="user__summary flow-small">

                <div class="user__avatar">
                    ${ data.stats
                        ? LocationBadge(data.stats.total_locations)
                        : `
                        <span class="user__badge loading">
                            <span class="loading-spinner active"></span>
                        </span>` }
                </div>

                <div class="user__info">
                    <h2 class="user__full-name font-base uppercase">${data.display_name}</h2>
                    <p class="user__location">
                        <span class="user__location-label">${data.location && data.location.label || LoadingSpinner()}</span>
                        ${DetailsChangeButton()}
                        <span class="iplocation-message small d-block text-secondary">
                            ${data.location && data.location.source === 'ip' ? estimated_location : ''}
                        </span>
                    </p>
                </div>
            </section>
           <section class="profile-menu px-2 mt-5">
                <div class="navbar-nav w-fit mx-auto">
                    <button class="user-profile-link nav-link uppercase px-1 py-4 d-flex justify-content-between align-items-center border-bottom border-top border-1 border-dark">
                        <i class="icon pg-profile three-em"></i>
                        <span class="two-em">${profile}</span>
                        <i class="icon pg-chevron-right three-em"></i>
                    </button>
                    <button class="user-prayers-link nav-link uppercase px-1 py-4 d-flex justify-content-between align-items-center border-bottom border-1 border-dark">
                        <i class="icon pg-prayer three-em"></i>
                        <span class="two-em">${prayers}</span>
                        <i class="icon pg-chevron-right three-em"></i>
                    </button>
                    <button class="user-challenges-link nav-link uppercase px-1 py-4 d-flex justify-content-between align-items-center border-bottom border-1 border-dark">
                        <i class="icon pg-relay three-em"></i>
                        <span class="two-em px-3">${challenges}</span>
                        <i class="icon pg-chevron-right three-em"></i>
                    </button>
                </div>
            </section>
            <section>
                <p>${are_you_enjoying_the_app}</p>
                <p>${would_you_like_to_partner}</p>
                <div class="d-flex flex-column m-auto w-fit">
                    <a class="btn btn-small btn-primary-light uppercase" data-reverse-color href="/content_app/give_page">${give}</a>
                    <a class="btn btn-small btn-outline-primary mt-3 uppercase" href="/user_app/logout">${logout}</a><br>
                </div>
            </section>
        </div>`

        jQuery('#pg_content').html(pgContentHTML);

        jQuery('#change-details').on('click', () => {
            setup_details_modal()
        })

        if ( !data.stats ) {
            getStats()
        }

        getActivity()

        getChallenges('public')
        getChallenges('private')

        const pg_user_hash = localStorage.getItem('pg_user_hash')

        Promise.resolve()
            .then(() => {
                if ( !data.location || data.location === '' ) {
                    return get_user_app('ip_location', { hash: pg_user_hash })
                }
                return true
            })
            .then((data) => {
                if (data === true) {
                    return
                }
                if (!data || !data.location ) {
                    jQuery('.user__location-label').html(select_a_location)
                    return
                }
                jsObject.user.location = data.location
                jsObject.user.location_hash = data.location_hash

                jQuery('.user__location-label').html(data.location.label)
                jQuery('.iplocation-message').html(estimated_location)
            })
            .then(() => get_user_app('link_anonymous_prayers', { hash: pg_user_hash, user_id: jsObject.user.ID }))
            .then(({ has_updates }) => {
                if (has_updates) {
                    return Promise.all([
                        getStats(),
                        getActivity()]
                    )
                }
            })

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
        <h2 class="center">${profile}</h2>
        <div>
            <table class="table">
                <tbody>
                    <tr>
                        <td>${name_text}:</td>
                        <td>${name}</td>
                    </tr>
                    <tr>
                        <td>${email_text}:</td>
                        <td>${email}</td>
                    </tr>
                    <tr>
                        <td>${location_text}:</td>
                        <td>
                            <span class="user__location-label">${location && location.label || select_a_location}</span>
                            <span class="iplocation-message small d-block text-secondary">
                                ${location && location.source === 'ip' ? estimated_location : ''}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            ${DetailsChangeButton()}
        </div>
        <section class="communication-preferences flow-small">
            <h2 class="center">${communication_preferences}</h2>

            <div>
                <div class="form-check small">
                    <input class="form-check-input user-check-preferences" type="checkbox" id="send_lap_emails" ${send_lap_emails && 'checked'}>
                    <label class="form-check-label" for="send_lap_emails">
                        ${send_lap_emails_text}
                    </label>
                </div>
                <div class="form-check small">
                    <input class="form-check-input user-check-preferences" type="checkbox" id="send_general_emails" ${send_general_emails && 'checked'}>
                    <label class="form-check-label" for="send_general_emails">
                        ${send_general_emails_text}
                    </label>
                </div>
            </div>
        </section>
        <section class="user-actions">
            <hr />
            <!--${ModalButton({
                text: "Data report for my account",
                modalId: "user-data-report",
                classes: 'btn-primary small d-block',
            })}-->
            ${ModalButton({
                text: erase_account,
                modalId: "erase-user-account-modal",
                classes: "small uppercase btn btn-small btn-outline-danger d-block mt-3",
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
        <h2 class="center">${prayers}</h2>
        <section class="user-stats flow-medium">

            <div class="center">

                <div class="user__avatar">
                    <span class="user__badge loading">
                        <span class="loading-spinner active"></span>
                    </span>
                </div>

            </div>
            <div class="d-flex justify-content-around">
                <div class="center">
                    <h4>${locations_text}</h4>
                    <span class="three-em user-total-locations">0</span>
                </div>
                <div class="center">
                    <h4>${minutes}</h4>
                    <span class="three-em user-total-minutes">0</span>
                </div>
            </div>

            <section class="user-activity">
                <div class="user-activity__list"></div>
                <button class="btn btn-small btn-outline-primary mt-5 mx-auto d-block" id="load-more-user-activity" style="display: none">${load_more}</button>
            </section>

        </section>`
        userProfileDetails.html(prayersHTML)

        if (jsObject.user.activity && jsObject.user.stats) {
            const { offset, limit, logs } = jsObject.user.activity
            const { total_minutes, total_locations } = jsObject.user.stats

            const handlePrimaryContent = ({ location_name, time_prayed_text }) =>  time_prayed_for.replace('%1$s', time_prayed_text).replace('%2$s', location_name || location_text)
            const handleSecondaryContent = ({ time_prayed_text, group_name }) => in_group_text.replace('%s', group_name)

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
            <h2 class="center">${private_relays}</h2>
            <p class="center light-grey small">${private_explanation1}</p>

            ${CreateChallengeButton( private, 'private-challenge-button' )}

            <div class="d-flex justify-content-center private-challenges__list">
                <span class="loading-spinner active"></span>
            </div>
        </section>
        <section class="public-challenges flow-small">
            <h2 class="center">${public_relays}</h2>
            <p class="center light-grey small">${public_explanation1}</p>

            ${CreateChallengeButton( public, 'public-challenge-button' )}

            <div class="d-flex justify-content-center public-challenges__list">
                <span class="loading-spinner active"></span>
            </div>
        </section>
        <a class="d-block mx-auto center" href="/challenges/active/">${view_join_other_relays}</a>
        `
        userProfileDetails.html(challengesHTML)

        buildChallengeList( 'public' )
        buildChallengeList( 'private' )

        jQuery('#private-challenge-button').on('click', () => {
            challengeVisibility.val('private')
            challengeModalTitle.html('Create Private Relay')
            challengeModalTitle[0].dataset.visibility = 'private'
            resetChallengTypeButtons()
        })
        jQuery('#public-challenge-button').on('click', () => {
            challengeVisibility.val('public')
            challengeModalTitle.html('Create Public Relay')
            challengeModalTitle[0].dataset.visibility = 'public'
            resetChallengTypeButtons()
        })
        function resetChallengTypeButtons() {
            challenge_type_buttons.removeClass('btn-secondary').addClass('btn-outline-secondary')
        }

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
            const singleLap = challengeSingleLap.is(':checked')
            const endDate = challengeEndDate.val()
            const endTime = challengeEndTime.val()
            const visibility = challengeVisibility.val()
            const modalAction = challengeModalAction.val()

            const data = {
                title,
                visibility,
                challenge_type: challengeType,
                single_lap: singleLap,
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
        challengeSingleLap.removeAttr('checked')
        createNewChallengeButton.show()
        editChallengeButton.hide()
        challengeModalAction.val('create')
        challengePostId.val('')
    }

    function setChallengeForm({ visibility, challenge_type, post_title, start_time, end_time, post_id, single_lap }) {
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
        challengeSingleLap.attr('checked', single_lap)
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

    function getStats() {
        return get_user_api('stats')
            .then((stats) => {
                if (!stats || stats.length === 0) {
                    return
                }
                jsObject.user.stats = stats
                jQuery('.user__avatar').html(LocationBadge(stats.total_locations || 0))
            })
    }

    function getActivity() {
        return get_user_app('activity')
            .then((activity) => {
                if (!activity || activity.length === 0) {
                    return
                }
                jsObject.user.activity = activity
            })
    }

    function getChallenges( visibility, callback ) {
        return get_user_app( 'get_challenges', { visibility } )
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
            container.html( no_relays_found.replace('%s', visibility) )
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
                    <td style="width: 3%"><a href="${urlRoot}/tools" class="dropdown-item three-em"><i class="icon pg-share"></i></a></td>
                    <td style="width: 3%">
                        <div class="btn-group">
                            <button class="btn btn-small px-0 shadow-none dropdown-toggle border-0 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                <i class="icon ion-android-more-vertical fs-3"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#create-challenge-modal" data-challenge-id="${challenge.post_id}" class="dropdown-item edit-challenge-button">Edit</a></li>
                                <li><a href="${urlRoot}/display" class="dropdown-item">Display Map</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
        `})

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

    function DetailsChangeButton() {
        return ModalButton({
            text: 'Change',
            modalId: 'details-modal',
            classes: 'brand-lightest',
            id: 'change-details',
        })
    }

    function CreateChallengeButton( type, id ) {

        const icon = type.toLowerCase() === 'private' ? 'locked' : 'unlocked'

        let text = '<i class="icon ion-' + icon + ' me-2"></i>'

        text += new_challenge.replace('%s', type)

        return ModalButton({
            text,
            modalId: 'create-challenge-modal',
            buttonType: '',
            classes: 'd-block mx-auto btn btn-primary',
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
    function ModalButton({ text, modalId, classes = '', id = '', dataAttributes = [], onClick = null } ) {

        const attributes = []
        dataAttributes.forEach(({name, value}) => {
            attributes.push(`data-${name}="${value}"`)
        })
        const dataAttributesHTML = attributes.join(' ')

        return `
            <button onclick="${onClick}" id="${id}" class="${classes}" data-bs-toggle="modal" data-bs-target="#${modalId}" ${dataAttributesHTML}>
                ${text}
            </button>
        `
    }
})

