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
    public $allowed_user_meta = [
        'location',
        'location_hash',
        'send_lap_emails',
        'send_general_emails',
    ];

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

        // require login access
//        if ( ! is_user_logged_in() ) {
//            wp_safe_redirect( dt_custom_login_url( 'login' ) );
//        }


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
        return array_merge( $allowed_js, [
            'jquery',
            'jquery-ui',
            'foundations-js',
            'porch-user-site-js',
            'mapbox-search-widget',
            'mapbox-gl',
        ]);
    }

    public function wp_enqueue_scripts() {}

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );

        $user_id = get_current_user_id();
        $userdata = pg_get_user( $user_id, $this->allowed_user_meta );

        if ( is_user_logged_in() ) {
            $userdata['stats'] = $this->get_user_stats();
        }
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'user' => $userdata,
                'translations' => [
                    'add' => __( 'Add Magic', 'disciple-tools-porch-template' ),
                ],
                'is_logged_in' => is_user_logged_in() ? 1 : 0,
                'logout_url' => esc_url( wp_logout_url( '/' ) )
            ]) ?>][0]
        </script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/js/components.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/js/components.js' ) ) ?>"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>user-link.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'user-link.js' ) ) ?>"></script>
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
        <section class="page-section" data-section="login" id="section-login">
            <div class="container">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-7 flow" id="pg_content"></div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" id="user-profile-details" data-bs-backdrop="true" data-bs-scroll="false">
                <div class="offcanvas__header">
                    <button type="button" data-bs-dismiss="offcanvas" style="text-align: start">
                        <i class="ion-chevron-right three-em"></i>
                    </button>
                </div>
                <div class="offcanvas__content">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="flow" id="user-details-content"></div>
                        </div>
                    </div>
                </div>
           </div>

            <div class="modal fade" id="location-modal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="locationModalLabel">Change Your Location</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="mapbox-wrapper">
                                <div id="mapbox-autocomplete" class="mapbox-autocomplete" data-autosubmit="false" data-add-address="true">
                                    <div class="input-group mb-2">
                                        <input required id="mapbox-search" type="text" name="mapbox_search" class="form-control" autocomplete="off" placeholder="Select Location" />
                                        <button id="mapbox-clear-autocomplete" class="btn btn-danger" type="button" title="Delete Location" style="">
                                            <i class="ion-close"></i>
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
                            <button type="button" class="btn btn-outline-dark cancel-user-location" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary save-user-location">Save</button>
                        </div>
                   </div>
                </div>
            </div>

            <div class="modal fade" id="create-challenge-modal" tabindex="-1" aria-labelledby="createChallengeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createChallengeLabel" data-visibility="">Create Challenge</h1>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" id="challenge-form">
                            <div class="modal-body">
                                <!-- Buttons group for choosing which type of challenge to start -->
                                <div class="btn-group-vertical mb-3 w-100" role="group" aria-label="Choose type of challenge">
                                    <input type="radio" class="btn-check ongoing-challenge-button" name="challenge-type" id="ongoing_challenge" autocomplete="off" required>
                                    <label class="btn btn-secondary" for="ongoing_challenge" role="button">Pray for the whole world</label>
                                    <input type="radio" class="btn-check timed-challenge-button" name="challenge-type" id="timed_challenge" autocomplete="off" required/>
                                    <label class="btn btn-secondary" for="timed_challenge" role="button">Timed Challenge</label>
                                </div>

                                <input type="hidden" id="challenge-visibility">
                                <input type="hidden" id="challenge-modal-action" value="create">
                                <input type="hidden" id="challenge-post-id">

                                <!-- Form for inputs to go into -->
                                <div class="mb-3 challenge-title-group">
                                    <label for="challenge-title" class="form-label">Challenge Title</label>
                                    <input class="form-control" type="text" id="challenge-title" placeholder="Give your challenge a unique name" required>
                                </div>
                                <div class="mb-3 challenge-start-date-group">
                                    <label for="challenge-start-date" class="form-label">Challenge Start Date</label><button type="button" class="btn btn-outline-secondary btn-sm ms-3" id="set-challenge-start-to-now">Now</button>
                                    <div class="d-flex">
                                        <input class="form-control" type="date" id="challenge-start-date" placeholder="Start Date" required>
                                        <input class="form-control" type="time" id="challenge-start-time" placeholder="Start Time" required>
                                    </div>
                                </div>
                                <div class="mb-3 challenge-end-date-group">
                                    <label for="challenge-end-date" class="form-label">Challenge End Date</label>
                                    <div class="d-flex">
                                        <input class="form-control" type="date" id="challenge-end-date" placeholder="End Date">
                                        <input class="form-control" type="time" id="challenge-end-time" placeholder="End Time">
                                    </div>
                                    <div class="text-danger form-text" id="challenge-help-text"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span class="loading-spinner challenge-loading"></span>
                                <button class="btn btn-outline-dark cancel-new-challenge-button" data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-primary create-new-challenge-button">Create</button>
                                <button class="btn btn-primary edit-challenge-button">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="user-data-report" tabindex="-1" aria-labelledby="userDataReportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userDataReportModalLabel">Data Report</h1>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Data Reporty stuff
                            <br>
                            The contents of their user/contact record?
                            <br>
                            Linked groups?
                            <br>
                            Prayer data?
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="erase-user-account-modal" tabindex="-1" aria-labelledby="eraseUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="eraseUserModalLabel">Erase Account</h1>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                This will delete your account from Prayer.Global.
                            </p>
                            <p>
                                You will lose all progress and data assosciated with your account
                            </p>
                            <p>
                                If you are sure you want to proceed please type "delete" into the box below and click "I am sure" button
                            </p>
                            <div class="mb-3">
                                <label for="delete-confirmation" class="form-label">Confirm delete</label>
                                <input type="text" class="form-control text-danger" id="delete-confirmation" placeholder="delete">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-dark" data-bs-dismiss="modal" type="button">Cancel</button>
                            <button class="btn btn-danger" id="confirm-user-account-delete" disabled>I am sure</button>
                        </div>
                    </div>
                </div>
            </div>


        </section>
        <?php
    }

    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . '/v1';
        register_rest_route(
            $namespace, '/'.$this->type, [
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
            case 'login':
                $user = get_user_by( 'email', $params['data']['email'] );

                if ( $user ) {
                    if ( wp_check_password( $params['data']['pass'], $user->data->user_pass ) ) {
                        // password match
                        $logged_in = $this->programmatic_login( $user->data->user_login );
                        if ( $logged_in ) {
                            $response = [
                                "user" => pg_get_user( $user->ID, $this->allowed_user_meta ),
                            ];

                            return $response;
                        }
                    }
                }
                return false;
            case 'update_user':
                return $this->update_user( $params['data'] );
            case 'activity':
                return $this->get_user_activity( $params['data'] );
            case 'stats':
                return $this->get_user_stats();
            case 'ip_location':
                return $this->get_ip_location( $params['data'] );
            case 'save_location':
                return $this->save_location( $params['data'] );
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
    public function update_user( $data ) {
        $user_id = get_current_user_id();

        foreach ($data as $meta_key => $meta_value) {
            if ( !in_array( $meta_key, $this->allowed_user_meta, true ) ) {
                continue;
            }

            $meta_key = PG_NAMESPACE . $meta_key;

            $response = update_user_meta( $user_id, $meta_key, $meta_value );

            if ( is_wp_error( $response ) ) {
                return $response;
            }
        }
    }

    public function get_user_activity( $data ) {
        $offset = isset( $data['offset'] ) ? $data['offset'] : 0;
        $limit = isset( $data['limit'] ) ? $data['limit'] : 50;

        $activity = PG_Stacker::build_user_location_stats( null, $offset, $limit );
        return $activity;
    }

    public function get_user_stats() {
        global $wpdb;

        $user_id = get_current_user_id();

        $user_stats = $wpdb->get_row( $wpdb->prepare( "
            SELECT COUNT(r.id) as total_locations, SUM(r.value) as total_minutes
            FROM $wpdb->dt_reports r
            WHERE r.user_id = %d
            AND r.type = 'prayer_app'
            ORDER BY r.timestamp DESC
            ", $user_id ), ARRAY_A );

        $user_stats['total_locations'] = (int) $user_stats['total_locations'];
        $user_stats['total_minutes'] = (int) $user_stats['total_minutes'];
        return $user_stats;
    }

    public function get_ip_location( $data ) {
        $response = DT_Ipstack_API::get_location_grid_meta_from_current_visitor();

        if ( $response ) {
            if ( isset( $data['hash'] ) ) {
                $hash = $data['hash'];
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

        $this->update_user( $data );

        return $data;
    }

    public function save_location( $data ) {
        if ( !isset( $data['lat'], $data['lng'], $data['label'], $data['level'] ) ) {
            return new WP_Error( __METHOD__, 'Missing lat, lng, label or level', [ 'status' => 400 ] );
        }

        /* Get the grid_id for this lat lng */
        $geocoder = new Location_Grid_Geocoder();

        $grid_row = $geocoder->get_grid_id_by_lnglat( $data['lng'], $data['lat'] );

        $old_location = get_user_meta( get_current_user_id(), PG_NAMESPACE . 'location', true );

        $data['grid_id'] = $grid_row ? $grid_row['grid_id'] : false;
        $data['lat'] = strval( $data['lat'] );
        $data['lng'] = strval( $data['lng'] );
        $data['country'] = $this->_extract_country_from_label( $data['label'] );
        $data['hash'] = $old_location ? $old_location['hash'] : '';

        $this->update_user( [
            'location' => $data,
        ] );

        return $data;
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

        $geocoder = new Location_Grid_Geocoder();

        $grid_row = $geocoder->get_grid_id_by_lnglat( $data['lng'], $data['lat'] );

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

        $fields = [
            'title' => $data['title'],
            'challenge_type' => $data['challenge_type'],
            'visibility' => $data['visibility'],
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

        $post = DT_Posts::update_post( 'laps', $data['post_id'], $fields );

        return $post;
    }

    public function get_challenges( $data ) {
        global $wpdb;

        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $visibility = isset( $data['visibility'] ) ? $data['visibility'] : 'public';

        $data = [];

        $user_meta_value = "user-$user_id";

        $results = $wpdb->get_results( $wpdb->prepare(
            "
                SELECT pm.post_id, p.post_title, pm3.meta_value as lap_key, pm4.meta_value as start_time, pm5.meta_value as visibility, pm7.meta_value as end_time, pm8.meta_value as challenge_type
                FROM $wpdb->posts p
                JOIN $wpdb->postmeta pm ON pm.post_id=p.ID AND pm.meta_key = 'type' AND pm.meta_value = 'custom'
                JOIN $wpdb->postmeta pm2 ON pm2.post_id=p.ID AND pm2.meta_key = 'status' AND pm2.meta_value = 'active'
                LEFT JOIN $wpdb->postmeta pm3 ON pm3.post_id=p.ID AND pm3.meta_key = 'prayer_app_custom_magic_key'
                LEFT JOIN $wpdb->postmeta pm4 ON pm4.post_id=p.ID AND pm4.meta_key = 'start_time'
                LEFT JOIN $wpdb->postmeta pm5 ON pm5.post_id=p.ID AND pm5.meta_key = 'visibility'
                JOIN $wpdb->postmeta pm6 ON pm6.post_id=p.ID AND pm6.meta_key = 'assigned_to' AND pm6.meta_value = %s
                LEFT JOIN $wpdb->postmeta pm7 ON pm7.post_id=p.ID AND pm7.meta_key = 'end_time'
                LEFT JOIN $wpdb->postmeta pm8 ON pm8.post_id=p.ID AND pm8.meta_key = 'challenge_type'
                WHERE p.post_type = 'laps'
                AND pm5.meta_value = %s OR pm5.meta_value IS NULL OR pm5.meta_value = 'none'
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
