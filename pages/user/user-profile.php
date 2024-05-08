<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * Class Prayer_Global_Porch_Public_Porch_Profile
 */
class PG_User_App_Profile extends DT_Magic_Url_Base {

    public $page_title = 'User Profile';
    public $root = 'user_app';
    public $type = 'profile';
    public $post_type = 'user';
    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );

        /**
         * tests if other URL
         */
        $url = dt_get_url_path();
        if ( strpos( $url, $this->root . '/' . $this->type ) === false ) {
            return;
        }
        /**
         * tests magic link parts are registered and have valid elements
         */
        if ( !$this->check_parts_match( false ) ){
            return;
        }

        // load if valid url
        add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [
            'porch-user-style-css',
            'jquery-ui-site-css',
            'foundations-css',
        ];
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [
            'jquery',
            'jquery-ui',
            'foundations-js',
            'porch-user-site-js',
            'mapbox-search-widget',
            'mapbox-gl',
            'components-js',
            'user-profile-js'
        ];
    }

    public function wp_enqueue_scripts() {
        wp_enqueue_script( 'user-profile-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'user-profile.js', [ 'jquery', 'components-js' ], filemtime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'user-profile.js' ), true );
        wp_localize_script( 'user-profile-js', 'jsObject', [
            'parts' => $this->parts,
            'translations' => [
                'change' => esc_html( __( 'Change', 'prayer-global-porch' ) ),
                'select_a_location' => esc_html( __( 'Please select a location', 'prayer-global-porch' ) ),
                'estimated_location' => esc_html( __( '(This is your estimated location)', 'prayer-global-porch' ) ),
                'profile' => esc_html( __( 'Profile', 'prayer-global-porch' ) ),
                'prayers' => esc_html( __( 'Prayers', 'prayer-global-porch' ) ),
                'challenges' => esc_html( __( 'My Prayer Relays', 'prayer-global-porch' ) ),
                'are_you_enjoying_the_app' => esc_html( __( 'Are you enjoying this app?', 'prayer-global-porch' ) ),
                'would_you_like_to_partner' => esc_html( __( 'Would you like to partner with us in helping others pray for the world?', 'prayer-global-porch' ) ),
                'consider_giving' => esc_html( __( 'Consider giving to help us increase prayer for the world.', 'prayer-global-porch' ) ),
                'give' => esc_html( __( 'Give', 'prayer-global-porch' ) ),
                'logout' => esc_html( __( 'Logout', 'prayer-global-porch' ) ),
                'name_text' => esc_html( __( 'Name', 'prayer-global-porch' ) ),
                'email_text' => esc_html( __( 'Email', 'prayer-global-porch' ) ),
                'location_text' => esc_html( __( 'Location', 'prayer-global-porch' ) ),
                'locations_text' => esc_html( __( 'Locations', 'prayer-global-porch' ) ),
                'communication_preferences' => esc_html( __( 'Communication Preferences', 'prayer-global-porch' ) ),
                'send_lap_emails_text' => esc_html( __( 'Send me lap challenges via email', 'prayer-global-porch' ) ),
                'send_general_emails_text' => esc_html( sprintf( __( 'Send information about %1$s, %2$s, %3$s and other %4$s projects via email', 'prayer-global-porch' ), 'Prayer.Global', 'Zume', 'Pray4Movement', 'Gospel Ambition' ) ),
                'erase_account' => esc_html( __( 'Erase my account', 'prayer-global-porch' ) ),
                'minutes' => esc_html( __( 'Minutes', 'prayer-global-porch' ) ),
                'load_more' => esc_html( __( 'Load more', 'prayer-global-porch' ) ),
                'time_prayed_for' => esc_html( _x( '%1$s for %2$s', '1 min for Paris, France', 'prayer-global-porch' ) ),
                'in_group_text' => esc_html( _x( 'in %s', 'in Global Lap', 'prayer-global-porch' ) ),
                'new_challenge' => esc_html( _x( 'New %s Relay', 'New public Relay', 'prayer-global-porch' ) ),
                'public' => esc_html( __( 'Public', 'prayer-global-porch' ) ),
                'private' => esc_html( __( 'Private', 'prayer-global-porch' ) ),
                'public_relays' => esc_html( __( 'My Public Relays', 'prayer-global-porch' ) ),
                'private_relays' => esc_html( __( 'My Private Relays', 'prayer-global-porch' ) ),
                'private_explanation1' => sprintf( esc_html( __( "Private relays do not show on the %s page, but can be shared with your team mates.", 'prayer-global-porch' ) ), '<a href="/challenges/active">' . esc_html__( 'Prayer Relays', 'prayer-global-porch' ) . '</a>' ),
                'public_explanation1' => sprintf( esc_html( __( "Your public relays will also appear on the %s page.", 'prayer-global-porch' ) ), '<a href="/challenges/active">' . esc_html__( 'Prayer Relays', 'prayer-global-porch' ) . '</a>' ),
                'no_relays_found' => esc_html__( 'You have not created any %s relays yet', 'prayer-global-porch' ),
                'view_join_other_relays' => esc_html__( 'View other public relays', 'prayer-global-porch' ),
                'edit' => esc_html__( 'Edit', 'prayer-global-porch' ),
                'display_map' => esc_html__( 'Display Map', 'prayer-global-porch' ),
            ],
            'is_logged_in' => is_user_logged_in() ? 1 : 0,
            'logout_url' => esc_url( '/user_app/logout' )
        ] );
    }

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );

        ?>
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/prayer-global/style.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/fonts/prayer-global/style.css' ) ) ?>">
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js?ver=3"></script>
        <style>
            #login_form input {
                padding:.5em;
            }
        </style>
        <?php
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }

    public function body(){
        DT_Mapbox_API::load_mapbox_search_widget();
        DT_Mapbox_API::mapbox_search_widget_css();

        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' );

        ?>

        <section class="page-section flow" data-section="login" id="section-login">
            <div class="container">
                <div class="row justify-content-md-center text-center">
                    <div class="flow" id="pg_content">
                        <span class="loading-spinner active"></span>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="details-modal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="detailsModalLabel"><?php echo esc_html__( 'Change Your Details', 'prayer-global-porch' ) ?></h5>
                            <button type="button" class="d-flex brand-light" data-bs-dismiss="modal" aria-label="Close">
                                <i class="icon pg-close two-em"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input required type="text" name="name" id="display_name" class="mb-4 form-control" placeholder="<?php echo esc_attr__( 'Name', 'prayer-global-porch' ) ?>">
                            <div id="mapbox-wrapper">
                                <div id="mapbox-autocomplete" class="mapbox-autocomplete" data-autosubmit="false" data-add-address="true">
                                    <div class="input-group mb-2">
                                            <input required id="mapbox-search" type="text" name="mapbox_search" class="form-control" autocomplete="off" placeholder="<?php echo esc_attr__( 'Select Location', 'prayer-global-porch' ) ?>" />
                                            <button id="mapbox-clear-autocomplete" class="btn btn-small btn-secondary d-flex align-items-center" type="button" title="<?php echo esc_attr__( 'Delete Location', 'prayer-global-porch' ) ?>" style="">
                                            <i class="icon pg-close one-rem lh-small"></i>
                                        </button>
                                    </div>
                                    <div class="mapbox-error-message text-danger small"></div>
                                    <div id="mapbox-spinner-button" style="display: none;">
                                        <span class="" style="border-radius: 50%;width: 24px;height: 24px;border: 0.25rem solid lightgrey;border-top-color: black;animation: spin 1s infinite linear;display: inline-block;"></span>
                                    </div>
                                    <div id="mapbox-autocomplete-list" class="mapbox-autocomplete-items"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-small btn-outline-primary cancel-user-details" data-bs-dismiss="modal"><?php echo esc_html__( 'Cancel', 'prayer-global-porch' ) ?></button>
                            <button type="button" class="btn btn-small btn-primary save-user-details"><?php echo esc_html__( 'Save', 'prayer-global-porch' ) ?></button>
                        </div>
                   </div>
                </div>
            </div>

            <div class="modal fade" id="create-challenge-modal" tabindex="-1" aria-labelledby="createChallengeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="createChallengeLabel" data-visibility=""><?php echo esc_html__( 'Create Challenge', 'prayer-global-porch' ) ?></h5>
                            <button type="button" class="d-flex brand-light" data-bs-dismiss="modal" aria-label="<?php echo esc_attr__( 'Close', 'prayer-global-porch' ) ?>">
                                <i class="icon pg-close two-em"></i>
                            </button>
                        </div>
                        <form action="" id="challenge-form">
                            <div class="modal-body pb-0">
                                <!-- Buttons group for choosing which type of challenge to start -->
                                <div class="btn-group-vertical mb-3 w-100" role="group" aria-label="<?php esc_attr( __( 'Choose type of challenge', 'prayer-global-porch' ) ) ?>">
                                    <input type="radio" class="btn-check ongoing-challenge-button" name="challenge-type" id="ongoing_challenge" autocomplete="off" required>
                                    <label class="btn btn-small btn-outline-secondary challenge-type" for="ongoing_challenge" role="button"><?php echo esc_html__( 'On-going Prayer Relay', 'prayer-global-porch' ) ?></label>
                                    <input type="radio" class="btn-check timed-challenge-button" name="challenge-type" id="timed_challenge" autocomplete="off" required/>
                                    <label class="btn btn-small btn-outline-secondary challenge-type" for="timed_challenge" role="button"><?php echo esc_html__( 'Timed Prayer Relay', 'prayer-global-porch' ) ?></label>
                                </div>

                                <input type="hidden" id="challenge-visibility">
                                <input type="hidden" id="challenge-modal-action" value="create">
                                <input type="hidden" id="challenge-post-id">

                                <!-- Form for inputs to go into -->
                                <div class="mb-3 challenge-title-group">
                                    <label for="challenge-title" class="form-label"><?php echo esc_html__( 'Challenge Title', 'prayer-global-porch' ) ?></label>
                                    <input class="form-control" type="text" id="challenge-title" placeholder="<?php esc_attr( __( 'Give your challenge a unique name', 'prayer-global-porch' ) ) ?>" required>
                                </div>
                                <div class="mb-3 challenge-start-date-group">
                                    <label for="challenge-start-date" class="form-label"><?php echo esc_html__( 'Challenge Start Date', 'prayer-global-porch' ) ?></label><button type="button" class="btn btn-xsmall btn-outline-secondary ms-3" id="set-challenge-start-to-now"><?php echo esc_html__( 'Now', 'prayer-global-porch' ) ?></button>
                                    <div class="d-flex">
                                        <input class="form-control" type="date" id="challenge-start-date" placeholder="<?php esc_attr( __( 'Start Date', 'prayer-global-porch' ) ) ?>" required>
                                        <input class="form-control" type="time" id="challenge-start-time" placeholder="<?php esc_attr( __( 'Start Time', 'prayer-global-porch' ) ) ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 challenge-end-date-group">
                                    <label for="challenge-end-date" class="form-label"><?php echo esc_html__( 'Challenge End Date', 'prayer-global-porch' ) ?></label>
                                    <div class="d-flex">
                                        <input class="form-control" type="date" id="challenge-end-date" placeholder="<?php esc_attr( __( 'End Date', 'prayer-global-porch' ) ) ?>">
                                        <input class="form-control" type="time" id="challenge-end-time" placeholder="<?php esc_attr( __( 'End Time', 'prayer-global-porch' ) ) ?>">
                                    </div>
                                    <div class="text-danger form-text" id="challenge-help-text"></div>
                                </div>
                                <div class="challenge-single-lap-group">
                                    <label for="challenge-single-lap" class="form-check-label"><?php echo esc_html__( 'Single Lap', 'prayer-global-porch' ) ?></label>
                                    <input type="checkbox" value="" class="form-check-input" id="challenge-single-lap">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="loading-spinner challenge-loading"></span>
                                <button class="btn btn-small btn-outline-primary cancel-new-challenge-button" data-bs-dismiss="modal" type="button"><?php echo esc_html__( 'Cancel', 'prayer-global-porch' ) ?></button>
                                <button class="btn btn-small btn-primary create-new-challenge-button"><?php echo esc_html__( 'Create', 'prayer-global-porch' ) ?></button>
                                <button class="btn btn-small btn-primary edit-challenge-button"><?php echo esc_html__( 'Edit', 'prayer-global-porch' ) ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="user-data-report" tabindex="-1" aria-labelledby="userDataReportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title fs-5" id="userDataReportModalLabel"><?php echo esc_html__( 'Data Report', 'prayer-global-porch' ) ?></h5>
                            <button type="button" class="d-flex brand-light" data-bs-dismiss="modal" aria-label="Close">
                                <i class="icon pg-close two-em"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="erase-user-account-modal" tabindex="-1" aria-labelledby="eraseUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="eraseUserModalLabel"><?php echo esc_html__( 'Erase Account', 'prayer-global-porch' ) ?></h5>
                            <button class="d-flex brand-light" data-bs-dismiss="modal" aria-label="<?php echo esc_attr__( 'Close', 'prayer-global-porch' ) ?>">
                                <i class="icon pg-close two-em"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <?php echo esc_html( __( 'This will delete your account from Prayer.Global.', 'prayer-global-porch' ) ) ?>
                            </p>
                            <p>
                                <?php echo esc_html( __( 'You will lose all progress and data assosciated with your account', 'prayer-global-porch' ) ) ?>
                            </p>
                            <p>
                                <?php echo esc_html( __( 'If you are sure you want to proceed please type "delete" into the box below and click "I am sure" button', 'prayer-global-porch' ) ) ?>
                            </p>
                            <div class="mb-3">
                                <label for="delete-confirmation" class="form-label"><?php echo esc_html__( 'Confirm delete', 'prayer-global-porch' ) ?></label>
                                <input type="text" class="form-control text-danger" id="delete-confirmation" placeholder="<?php esc_attr( __( 'Delete', 'prayer-global-porch' ) ) ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-dismiss="modal" type="button"><?php echo esc_html__( 'Cancel', 'prayer-global-porch' ) ?></button>
                            <button class="btn btn-danger" id="confirm-user-account-delete" disabled><?php echo esc_html__( 'I am sure', 'prayer-global-porch' ) ?></button>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <div class="offcanvas offcanvas-end" id="user-profile-details" data-bs-backdrop="true" data-bs-scroll="false">
            <div class="offcanvas__header">
                <button type="button" data-bs-dismiss="offcanvas" style="text-align: start">
                    <i class="icon pg-chevron-right three-em"></i>
                </button>
            </div>
            <div class="offcanvas__content px-0">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="flow-medium" id="user-details-content"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . '/v1';
        register_rest_route(
            $namespace,
            '/'.$this->type,
            [
                [
                    'methods'  => "POST",
                    'callback' => [ $this, 'endpoint' ],
                    'permission_callback' => '__return_true',
                ],
            ]
        );
    }

    public function endpoint( WP_REST_Request $request ) {

        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        switch ( $params['action'] ) {
            case 'update_user':
                return $this->update_user( $params['data'] );
            case 'delete_user':
                return $this->delete_user( $params['data'] );
            case 'activity':
                return $this->get_user_activity( $params['data'] );
            case 'ip_location':
                return $this->get_ip_location( $params['data'] );
            case 'save_details':
                return $this->save_details( $params['data'] );
            case 'link_anonymous_prayers':
                return $this->link_anonymous_prayers( $params['data'] );
            case 'create_challenge':
                return $this->create_challenge( $params['data'] );
            case 'edit_challenge':
                return $this->edit_challenge( $params['data'] );
            case 'get_challenges':
                return $this->get_challenges( $params['data'] );
            default:
                return $params;
        }


    }

    /**
     * Programmatically logs a user in
     *
     * @param string $username
     * @return bool True if the login was successful; false if it wasn't
     */
    public function programmatic_login( $username ): bool
    {
        if ( is_user_logged_in() ) {
            wp_logout();
        }

        add_filter( 'authenticate', [ $this, 'allow_programmatic_login' ], 10, 3 );    // hook in earlier than other callbacks to short-circuit them
        $user = wp_signon( array( 'user_login' => $username ) );
        remove_filter( 'authenticate', [ $this, 'allow_programmatic_login' ], 10, 3 );

        if ( is_a( $user, 'WP_User' ) ) {
            wp_set_current_user( $user->ID, $user->user_login );

            if ( is_user_logged_in() ) {
                return true;
            }
        }

        return false;
    }

    /**
     * An 'authenticate' filter callback that authenticates the user using only     the username.
     *
     * To avoid potential security vulnerabilities, this should only be used in     the context of a programmatic login,
     * and unhooked immediately after it fires.
     *
     * @param WP_User $user
     * @param string $username
     * @param string $password
     * @return bool|WP_User a WP_User object if the username matched an existing user, or false if it didn't
     */
    public function allow_programmatic_login( $user, $username, $password ) {
        return get_user_by( 'login', $username );
    }

    /**
     * Update the user's data
     *
     * @param array $data
     * @return void|WP_Error
     */
    public function update_user_meta( $data ) {
        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        foreach ( $data as $meta_key => $meta_value ) {
            if ( !in_array( $meta_key, PG_User_API::$allowed_user_meta, true ) ) {
                continue;
            }

            $meta_key = PG_NAMESPACE . $meta_key;

            $meta_key = sanitize_text_field( wp_unslash( $meta_key ) );

            if ( is_array( $meta_value ) ) {
                $meta_value = dt_sanitize_array( $meta_value );
            }

            $response = update_user_meta( $user_id, $meta_key, $meta_value );

            if ( is_wp_error( $response ) ) {
                return $response;
            }
        }
    }

    public function delete_user( $data ) {
        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        /* Delete user_id from all prayers with this user_id */
        global $wpdb;
        $update_reports = $wpdb->update( $wpdb->dt_reports, [ 'user_id' => null ], [ 'user_id' => $user_id ] );

        /* Unassign user_id from all laps that they have started */
        $unassign_laps = $wpdb->query( $wpdb->prepare( "
            DELETE FROM $wpdb->postmeta
            WHERE meta_id IN (
                SELECT meta_id FROM (
                    SELECT pm.meta_id FROM $wpdb->posts p
                    JOIN $wpdb->postmeta pm
                    ON p.ID = pm.post_id
                    WHERE p.post_type = 'laps'
                    AND pm.meta_key = 'assigned_to'
                    AND pm.meta_value = %s
                ) x
            )
        ", "user-$user_id" ) );

        $contact_id = Disciple_Tools_Users::get_contact_for_user( $user_id );
        DT_Contacts_Utils::erase_data( $contact_id, 'this-user@no.op' );

        /* Delete user */
        require_once( ABSPATH . 'wp-admin/includes/user.php' );
        wp_delete_user( $user_id );

        return true;
    }

    public function get_user_activity( $data ) {
        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $offset = isset( $data['offset'] ) ? (int) $data['offset'] : 0;
        $limit = isset( $data['limit'] ) ? (int) $data['limit'] : 50;

        $activity = PG_Stacker::build_user_location_stats( null, $offset, $limit );
        return $activity;
    }
    public function get_ip_location( $data ) {
        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $response = DT_Ipstack_API::get_location_grid_meta_from_current_visitor();

        if ( $response ) {
            /* Use the existing supplied hash if given */
            if ( isset( $data['hash'] ) ) {
                $hash = sanitize_text_field( wp_unslash( $data['hash'] ) );
            } else {
                $hash = hash( 'sha256', serialize( $response ) . mt_rand( 1000000, 10000000000000000 ) );
            }
            $country = $this->_extract_country_from_label( $response['label'] );
            $response['country'] = $country;
            $response['lat'] = strval( $response['lat'] );
            $response['lng'] = strval( $response['lng'] );
            $response['hash'] = $hash;
        }

        $data = [
            "location" => $response,
            "location_hash" => $hash,
        ];

        $this->update_user_meta( $data );

        return $data;
    }

    public function save_details( $data ) {
        if ( !isset( $data['location'], $data['display_name'] ) ) {
            return new WP_Error( __METHOD__, 'Missing location or display_name', [ 'status' => 400 ] );
        }

        $location = $data['location'];
        $display_name = $data['display_name'];

        if ( !isset( $location['lat'], $location['lng'], $location['label'], $location['level'] ) ) {
            return new WP_Error( __METHOD__, 'Missing lat, lng, label or level', [ 'status' => 400 ] );
        }

        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        /* Get the grid_id for this lat lng */
        $geocoder = new Location_Grid_Geocoder();

        $lat = (float) $location['lat'];
        $lng = (float) $location['lng'];
        $label = sanitize_text_field( wp_unslash( $location['label'] ) );

        $grid_row = $geocoder->get_grid_id_by_lnglat( $lng, $lat );

        $old_location = get_user_meta( get_current_user_id(), PG_NAMESPACE . 'location', true );

        $location['grid_id'] = $grid_row ? $grid_row['grid_id'] : false;
        $location['lat'] = strval( $lat );
        $location['lng'] = strval( $lng );
        $location['country'] = $this->_extract_country_from_label( $label );
        $location['hash'] = $old_location ? $old_location['hash'] : '';

        $this->update_user_meta( [
            'location' => $location,
        ] );

        $return = wp_update_user( [
            'ID' => $user_id,
            'display_name' => $display_name,
        ] );

        if ( is_wp_error( $return ) ) {
            $display_name = '';
        }

        return [
            'location' => $location,
            'display_name' => $display_name,
        ];
    }

    public function link_anonymous_prayers( $data ) {

        if ( ! isset( $data['user_id'], $data['hash'] ) ) {
            return new WP_Error( __METHOD__, 'user_id or hash missing', [ 'status' => 400, ] );
        }

        global $wpdb;

        $updates = $wpdb->get_var( $wpdb->prepare( "
            SELECT COUNT(*) FROM $wpdb->dt_reports
            WHERE hash = %s
            AND type = 'prayer_app'
            AND user_id IS NULL
        ", $data['hash'] ) );

        $has_updates = $updates > 0;
        if ( $has_updates ) {
            $wpdb->query( $wpdb->prepare( "
                UPDATE $wpdb->dt_reports
                SET user_id = %d
                WHERE hash = %s
                AND type = 'prayer_app'
                AND user_id IS NULL
            ", $data['user_id'], $data['hash'] ) );
        }

        return [
            'has_updates' => $has_updates,
            'number_of_updates' => $updates,
        ];
    }

    /**
     * Extract_country_from_label
     * @param string $label
     * @return array|bool|string
     */
    private function _extract_country_from_label( string $label ) {
        if ( $label === '' ) {
            return '';
        }
        return array_reverse( explode( ', ', $label ) )[0];
    }

    public function geolocate_by_latlng( $data ) {
        if ( !isset( $data['lat'], $data['lng'] ) ) {
            return new WP_Error( __METHOD__, 'Latitude or longitude missing', [ 'status' => 400 ] );
        }

        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $geocoder = new Location_Grid_Geocoder();

        $grid_row = $geocoder->get_grid_id_by_lnglat( (float) $data['lng'], (float) $data['lat'] );

        if ( !$grid_row ) {
            return '';
        }

        $label = $geocoder->_format_full_name( $grid_row );

        return $label;
    }

    public function create_challenge( $data ) {
        if ( !isset( $data['title'], $data['visibility'], $data['challenge_type'] ) ) {
            return new WP_Error( __METHOD__, 'Challenge Title, visibility or type missing', [ 'status' => 400 ] );
        }

        $user_id = get_current_user_id();

        if ( !$user_id || !DT_Posts::can_create( 'laps' ) ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $title = sanitize_text_field( wp_unslash( $data['title'] ) );
        $challenge_type = sanitize_text_field( wp_unslash( $data['challenge_type'] ) );
        $visibility = sanitize_text_field( wp_unslash( $data['visibility'] ) );

        $fields = [
            'title' => $title,
            'challenge_type' => $challenge_type,
            'visibility' => $visibility,
        ];

        if ( isset( $data['start_date'] ) ) {
            $fields["start_date"] = (int) $data['start_date'];
            $fields["start_time"] = (int) $data['start_date'];
        }
        if ( isset( $data['end_date'] ) ) {
            $fields["end_date"] = (int) $data['end_date'];
            $fields["end_time"] = (int) $data['end_date'];
        }

        $fields['assigned_to'] = $user_id;
        $fields['type'] = 'custom';
        $fields['single_lap'] = (bool) $data['single_lap'];

        $post = DT_Posts::create_post( 'laps', $fields );

        return $post;
    }

    public function edit_challenge( $data ) {
        if ( !isset( $data['post_id'] ) ) {
            return new WP_Error( __METHOD__, 'Challenge post_id is missing', [ 'status' => 400 ] );
        }

        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $old_challenge = DT_Posts::get_post( 'laps', $data['post_id'] );

        if ( !$old_challenge || !DT_Posts::can_update( 'laps', $data['post_id'] ) ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $fields = [];

        if ( isset( $data['title'] ) ) {
            $fields['title'] = $data['title'];
        }

        if ( isset( $data['challenge_type'] ) ) {
            $fields['challenge_type'] = $data['challenge_type'];
        }

        if ( isset( $data['visibility'] ) ) {
            $fields['visibility'] = $data['visibility'];
        }

        if ( isset( $data['start_date'] ) ) {
            $fields["start_date"] = (int) $data['start_date'];
            $fields["start_time"] = (int) $data['start_date'];
        }
        if ( isset( $data['end_date'] ) ) {
            $fields["end_date"] = (int) $data['end_date'];
            $fields["end_time"] = (int) $data['end_date'];
        }
        if ( isset( $data['single_lap'] ) ) {
            $fields['single_lap'] = (bool) $data['single_lap'];
        }

        $post = DT_Posts::update_post( 'laps', $data['post_id'], $fields );

        return $post;
    }

    public function get_challenges( $data ) {
        global $wpdb;

        $user_id = get_current_user_id();

        if ( !$user_id || !DT_Posts::can_access( 'laps' ) ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $visibility = isset( $data['visibility'] ) ? sanitize_text_field( wp_unslash( $data['visibility'] ) ) : 'public';

        $data = [];

        $user_meta_value = "user-$user_id";

        $results = $wpdb->get_results( $wpdb->prepare(
            "SELECT pm.post_id, p.post_title, pm3.meta_value as lap_key, pm4.meta_value as start_time, pm5.meta_value as visibility, pm7.meta_value as end_time, pm8.meta_value as challenge_type, pm9.meta_value as single_lap
                FROM $wpdb->posts p
                JOIN $wpdb->postmeta pm ON pm.post_id=p.ID AND pm.meta_key = 'type' AND pm.meta_value = 'custom'
                JOIN $wpdb->postmeta pm2 ON pm2.post_id=p.ID AND pm2.meta_key = 'status' AND pm2.meta_value = 'active'
                LEFT JOIN $wpdb->postmeta pm3 ON pm3.post_id=p.ID AND pm3.meta_key = 'prayer_app_custom_magic_key'
                LEFT JOIN $wpdb->postmeta pm4 ON pm4.post_id=p.ID AND pm4.meta_key = 'start_time'
                LEFT JOIN $wpdb->postmeta pm5 ON pm5.post_id=p.ID AND pm5.meta_key = 'visibility'
                JOIN $wpdb->postmeta pm6 ON pm6.post_id=p.ID AND pm6.meta_key = 'assigned_to' AND pm6.meta_value = %s
                LEFT JOIN $wpdb->postmeta pm7 ON pm7.post_id=p.ID AND pm7.meta_key = 'end_time'
                LEFT JOIN $wpdb->postmeta pm8 ON pm8.post_id=p.ID AND pm8.meta_key = 'challenge_type'
                LEFT JOIN $wpdb->postmeta pm9 ON pm9.post_id=p.ID AND pm9.meta_key = 'single_lap'
                WHERE p.post_type = 'laps'
                AND pm5.meta_value = %s
                ORDER BY p.post_title
             ", $user_meta_value, $visibility ), ARRAY_A );

        foreach ( $results as $row ) {
            $row['stats'] = pg_custom_lap_stats_by_post_id( $row['post_id'] );
            $data[] = $row;
        }

        return $data;
    }

}
PG_User_App_Profile::instance();
