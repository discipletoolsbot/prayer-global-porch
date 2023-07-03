<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class PG_Custom_Prayer_App_Map extends PG_Custom_Prayer_App {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        parent::__construct();


        // must be valid url
        $url = dt_get_url_path();
        if ( strpos( $url, $this->root . '/' . $this->type ) === false ) {
            return;
        }

        // must be valid parts
        if ( !$this->check_parts_match() ){
            return;
        }

        // must be specific action
        if ( 'map' !== $this->parts['action'] ) {
            return;
        }

        // load if valid url
        add_action( 'dt_blank_head', [ $this, '_header' ] );
        add_action( 'dt_blank_body', [ $this, 'body' ] );

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );

        add_action( 'wp_enqueue_scripts', [ $this, '_wp_enqueue_scripts' ], 100 );
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        $allowed_js[] = 'jquery-touch-punch';
        $allowed_js[] = 'mapbox-gl';
        $allowed_js[] = 'jquery-cookie';
        $allowed_js[] = 'mapbox-cookie';
        $allowed_js[] = 'heatmap-js';
        $allowed_js[] = 'bootstrap-js';
        $allowed_js[] = 'components-js';
        return $allowed_js;
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        $allowed_css[] = 'mapbox-gl-css';
        $allowed_css[] = 'introjs-css';
        $allowed_css[] = 'heatmap-css';
        $allowed_css[] = 'site-css';
        return $allowed_css;
    }

    public function _header() {
        wp_head();
        $this->header_style();
        $this->header_javascript();
    }
    public function _footer(){
        $this->footer_javascript();
        wp_footer();
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/share-modal.php' );
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/cta-modal.php' );
    }

    public function header_javascript(){
        pg_google_analytics();
        $details = [];
        $url = dt_get_url_path( true, true );
        if ( $url ) {
            $details['url'] = $url;
        }
        $lap = pg_get_custom_lap_by_post_id( $this->parts['post_id'] );
        $details['title'] = 'Prayer.Global '.$lap['title'].' '. esc_html( __( 'Map', 'prayer-global-porch' ) );
        pg_og_tags( $details );

        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'ipstack' => DT_Ipstack_API::get_key(),
                'mirror_url' => dt_get_location_grid_mirror( true ),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'grid_data' => [],
                'participants' => [],
                'stats' => pg_custom_lap_stats_by_post_id( $this->parts['post_id'] ),
                'image_folder' => plugin_dir_url( __DIR__ ) . 'assets/images/',
                'translations' => [
                    'add' => __( 'Add Magic', 'prayer-global-porch' ),
                ],
                'map_type' => 'binary',
                'is_dark_map_on' => ( new PG_Feature_Flag( PG_Flags::DARK_MAP_FEATURE ) )->is_on(),
            ]) ?>][0]
        </script>
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/bootstrap/bootstrap5.2.2.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/prayer-global/style.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>heatmap.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'heatmap.css' ) ) ?>" type="text/css" media="all">
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/js/global-functions.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/js/global-functions.js' ) ) ?>"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>report.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'report.js' ) ) ?>"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/js/share.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/js/share.js' ) ) ?>"></script>
        <?php
    }

    public function footer_javascript() {}

    public function body(){
        $parts = $this->parts;
        $lap_stats = pg_custom_lap_stats_by_post_id( $parts['post_id'] );
        $now = time();
        $has_challenge_started = $lap_stats['start_time'] < $now;
        DT_Mapbox_API::geocoder_scripts();
        $rolling_laps_feature = new PG_Feature_Flag( PG_Flags::ROLLING_LAPS );
        ?>
        <style id="custom-style"></style>
        <div id="map-content">
            <div id="initialize-screen">
                <div id="initialize-spinner-wrapper" class="center">
                    <progress class="success initialize-progress" max="46" value="0"></progress><br>
                    <?php echo esc_html__( 'Loading the planet ...', 'prayer-global-porch' ) ?><br>
                    <span id="initialize-people" style="display:none;"><?php echo esc_html__( 'Locating world population...', 'prayer-global-porch' ) ?></span><br>
                    <span id="initialize-activity" style="display:none;"><?php echo esc_html__( 'Calculating movement activity...', 'prayer-global-porch' ) ?></span><br>
                    <span id="initialize-coffee" style="display:none;"><?php echo esc_html__( 'Shamelessly brewing coffee...', 'prayer-global-porch' ) ?></span><br>
                    <span id="initialize-dothis" style="display:none;"><?php echo esc_html__( "Let's do this...", 'prayer-global-porch' ) ?></span><br>
                </div>
            </div>
            <div id="map-wrapper">
                <div class="brand-bg white" id="head_block">
                    <div class="d-flex align-items-center justify-content-between gap-2">

                        <div class="d-flex align-items-center gap-2">
                            <span class="font-weight-bold uppercase"><?php echo esc_html( $lap_stats['title'] ) ?></span>
                            <button class="icon-button share-button two-rem d-flex align-items-center white" data-toggle="modal" data-target="#exampleModal">
                                <i class="icon pg-share"></i>
                            </button>
                        </div>
                        <a class="btn btn-cta" href="/prayer_app/custom/<?php echo esc_attr( $parts['public_key'] ) ?>"><?php echo esc_html__( 'Pray', 'prayer-global-porch' ) ?></a>

                    </div>

                    <?php require( __DIR__ . '/map-settings.php' ) ?>

                </div>
                <div class="holding-page flow-small">
                    <span class="six-em center"><?php echo esc_html( sprintf( __( 'Starts on %s', 'prayer-global-porch' ), '<span class="starts-on-date"></span>' ) ) ?></span>
                    <span class="six-em center time-remaining text-secondary"></span>
                    <button class="btn cta-btn btn-lg pray-button"></button>
                </div>
                <span class="loading-spinner active"></span>
                <div id='map'></div>




                <div id="foot_block">
                    <div class="map-overlay" id="map-legend"></div>
                    <div class="row g-0 justify-content-center">
                        <div class="col col-12 center">
                            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_stats">
                                <i class="icon pg-chevron-up three-em blue"></i>
                            </button>

                            <?php if ( $rolling_laps_feature->is_on() ) : ?>

                                <h4 class="uppercase font-weight-bold two-em"><?php echo esc_html( sprintf( __( 'Lap %s', 'prayer-global-porch' ), $lap_stats['lap_number'] ) ) ?></h4>

                            <?php endif; ?>

                        </div>
                        <div class="col col-sm-6 col-lg-2 center">
                            <div class="blue-bg white blue-border rounded-start d-flex align-items-center justify-content-around py-1">
                                <i class="icon pg-world-light three-em"></i>
                                <div class="two-em white stats-figure remaining"></div>
                            </div>
                            <span class="uppercase small"><?php echo esc_html__( 'Places Remaining', 'prayer-global-porch' ) ?></span><br>
                        </div>
                        <div class="col col-sm-6 col-lg-2 center">
                            <div class="white-bg blue blue-border rounded-end d-flex align-items-center justify-content-around py-1">
                                <i class="icon pg-world-light three-em"></i>
                                <div class="two-em stats-figure completed"></div>
                            </div>
                            <span class="uppercase small"><?php echo esc_html__( 'Places Covered', 'prayer-global-porch' ) ?></span><br>
                        </div>
                        <div class="col col-lg-1 d-none d-lg-block"></div>
                        <div class="col col-sm-6 col-lg-2 center d-none d-lg-block">
                            <div class="secondary-bg white secondary-border rounded-start d-flex align-items-center justify-content-around py-1">
                                <i class="icon pg-prayer three-em"></i>
                                <div class="two-em stats-figure warriors"></div>
                            </div>
                            <span class="uppercase small"><?php echo esc_html__( 'Intercessors', 'prayer-global-porch' ) ?></span><br>
                        </div>
                        <div class="col col-sm-6 col-lg-2 center d-none d-lg-block">
                            <div class="blue-bg white blue-border rounded-end d-flex align-items-center justify-content-around py-1">
                                <i class="icon pg-world-arrow three-em"></i>
                                <div class="two-em stats-figure"><span class="completed_percent">0</span></div>
                            </div>
                            <span class="uppercase small"><?php echo esc_html__( 'World Coverage', 'prayer-global-porch' ) ?></span><br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" id="offcanvas_menu">
            <button type="button" data-bs-dismiss="offcanvas"><i class="icon pg-chevron-right three-em"></i></button>
            <hr>
            <ul class="navbar-nav two-em">
                <li class="nav-item"><a class="nav-link btn smoothscroll btn-primary" style="text-transform: capitalize;" href="/prayer_app/custom/<?php echo esc_attr( $parts['public_key'] ) ?>">Start Praying</a></li>
            </ul>
            <div class="d-sm-none">
                <hr>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" id="offcanvas_location_details" data-bs-backdrop="false" data-bs-scroll="true">
            <div class="offcanvas__header"><button type="button" data-bs-dismiss="offcanvas" style="text-align: start"><i class="icon pg-chevron-right three-em"></i></button></div>
            <div class="row offcanvas__content" id="grid_details_content"></div>
        </div>
        <!-- report modal -->
        <div class="reveal " id="correction_modal" data-v-offset="10px;" data-reveal>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo esc_html__( 'Thank you! Leave us a correction below.', 'prayer-global-porch' ) ?></h5>
                    <hr>
                </div>
                <div class="modal-body">
                    <p><span id="correction_title" class="correction_field"></span></p>
                    <p>
                        <?php echo esc_html__( 'Section:', 'prayer-global-porch' ) ?><br>
                        <select class="form-control form-select correction_field" id="correction_select"></select>
                    </p>
                    <p>
                        <?php echo esc_html__( 'Correction Requested:', 'prayer-global-porch' ) ?><br>
                        <textarea class="form-control correction_field" id="correction_response" rows="3"></textarea>
                    </p>
                    <p>
                    <button type="button" class="button button-secondary" id="correction_submit_button"><?php echo esc_html__( 'Submit', 'prayer-global-porch' ) ?></button> <span class="loading-spinner correction_modal_spinner"></span>
                    </p>
                    <p id="correction_error" class="correction_field"></p>
                </div>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="offcanvas offcanvas-bottom" id="offcanvas_stats">
            <div class="center offcanvas__header d-flex justify-content-center align-items-center">
                <button type="button" data-bs-dismiss="offcanvas">
                    <i class="icon pg-chevron-down blue three-em"></i>
                </button>
            </div>
            <div class="container center uppercase pt-3">
                <div class="row g-0 justify-content-center">
                    <div class="col col-12">

                        <?php if ( $rolling_laps_feature->is_on() ) : ?>

                            <h4 class="uppercase font-weight-bold two-em"><?php echo esc_html( sprintf( __( 'Lap %s', 'prayer-global-porch' ), $lap_stats['lap_number'] ) ) ?></h4>

                        <?php endif; ?>

                    </div>
                    <div class="col col-6 col-sm-4">
                        <div class="blue-bg white blue-border rounded-start d-flex align-items-center justify-content-around">
                            <i class="icon pg-world-light three-em"></i>
                            <div class="two-em white stats-figure remaining"></div>
                        </div>
                        <span class="small"><?php echo esc_html__( 'Places Remaining', 'prayer-global-porch' ) ?></span><br>
                    </div>
                    <div class="col col-6 col-sm-4">
                        <div class="white-bg blue blue-border rounded-end d-flex align-items-center justify-content-around">
                            <i class="icon pg-world-light three-em"></i>
                            <div class="two-em stats-figure completed"></div>
                        </div>
                        <span class="small"><?php echo esc_html__( 'Places Covered', 'prayer-global-porch' ) ?></span><br>
                    </div>
                </div>
                <div class="row">
                    <div class="align-items-center d-flex flex-dir-column mt-3">
                        <i class="icon pg-world-arrow blue four-em"></i>
                        <span class="stats-title"><?php echo esc_html__( 'World Coverage', 'prayer-global-porch' ) ?></span>
                        <div class="blue-bg rounded stats-figure-lg w-50 white"><span class="completed_percent">0</span>%</div>
                    </div>
                </div>
                <div class="row">
                    <div class="align-items-center d-flex flex-dir-column mt-3">
                        <i class="icon pg-prayer blue four-em"></i>
                        <span class="stats-title"><?php echo esc_html__( 'Intercessors', 'prayer-global-porch' ) ?></span>
                        <div class="secondary-bg rounded stats-figure-lg w-50 warriors white">0</div>
                    </div>
                </div>
                <div class="row">
                    <hr class="mt-3">
                    <div class="col">
                        <p class="two-em mb-0"><?php echo esc_html__( 'Time Elapsed', 'prayer-global-porch' ) ?></p>
                        <p class="stats-figure time_elapsed">0</p>
                    </div>
                    <hr class="mb-3">
                    <div class="col col-12 col-md-4">
                        <p class="stats-title mb-0"><?php echo esc_html__( 'Start Time', 'prayer-global-porch' ) ?></p>
                        <p class="stats-figure start_time">0</p>
                    </div>
                    <div class="col col-12 col-md-4 on-going reveal-me" style="display:none;">
                        <p class="stats-title mb-0"><?php echo esc_html__( 'End Time', 'prayer-global-porch' ) ?></p>
                        <p class="stats-figure end_time">0</p>
                    </div>
                    <div class="col col-12 col-md-4 on-going reveal-me" style="display:none;">
                        <p class="stats-title mb-0"><?php echo esc_html__( 'Locations per Hour', 'prayer-global-porch' ) ?></p>
                        <p class="stats-figure locations_per_hour" style="margin-bottom: 0">0</p>
                        <p class="stats-small">
                            <small><?php sprintf( esc_html__( '%s per day', 'prayer-global-porch' ), '<span class="locations_per_day">0</span>' )?></small>
                        </p>
                    </div>
                    <div class="col col-6 on-going" style="display:none;">
                        <p class="stats-title"><?php echo esc_html__( 'Current Locations per Hour', 'prayer-global-porch' ) ?></p>
                        <p class="stats-figure needed_locations_per_hour" style="margin-bottom: 0">0</p>
                        <p class="stats-small">
                            <small><?php sprintf( esc_html__( '%s per day', 'prayer-global-porch' ), '<span class="locations_per_day">0</span>' )?></small>
                        </p>
                    </div>
                    <div class="col on-going" style="display:none;">
                        <p class="stats-title"><?php echo esc_html__( 'Time Remaining', 'prayer-global-porch' ) ?></p>
                        <p class="stats-figure time_remaining">0</p>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public static function _wp_enqueue_scripts(){
        DT_Mapbox_API::load_mapbox_header_scripts();

        wp_enqueue_script( 'components-js', trailingslashit( plugin_dir_url( __DIR__ ) ) . 'assets/js/components.js', [
            'jquery',
            'mapbox-gl'
        ], filemtime( plugin_dir_path( __DIR__ ) .'assets/js/components.js' ), true );
        wp_enqueue_script( 'heatmap-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'heatmap.js', [
            'jquery',
            'mapbox-gl'
        ], filemtime( plugin_dir_path( __FILE__ ) .'heatmap.js' ), true );
        wp_enqueue_script( 'bootstrap-js', trailingslashit( plugin_dir_url( __DIR__ ) ) . 'assets/js/bootstrap.bundle.min.js', [
            'jquery',
        ], filemtime( plugin_dir_path( __DIR__ ) .'assets/js/bootstrap.bundle.min.js' ), true );
    }

    public function endpoint( WP_REST_Request $request ) {
        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'] ) ) {
            return new WP_Error( __METHOD__, 'Missing parameters', [ 'status' => 400 ] );
        }

        switch ( $params['action'] ) {
            case 'get_stats':
                return pg_custom_lap_stats_by_post_id( $params['parts']['post_id'] );
            case 'get_grid':
                return [
                    'grid_data' => $this->get_grid( $params['parts'] ),
                    'participants' => $this->get_participants( $params['parts'] ),
                ];
            case 'get_grid_details':
                if ( isset( $params['data']['grid_id'] ) ) {
                    return PG_Stacker::build_location_stack( $params['data']['grid_id'] );
                }
                return false;
            case 'get_participants':
                return $this->get_participants( $params['parts'] );
            case 'get_user_locations':
                return $this->get_user_locations( $params['parts'], $params['data'] );
            default:
                return new WP_Error( __METHOD__, 'missing action parameter' );
        }

    }

    public function get_grid( $parts ) {
        global $wpdb;

        // map grid
        $data_raw = $wpdb->get_results( $wpdb->prepare( "
            SELECT
                lg1.grid_id, r1.value
            FROM $wpdb->dt_location_grid lg1
			JOIN $wpdb->dt_reports r1 ON r1.grid_id=lg1.grid_id AND r1.type = 'prayer_app' AND r1.subtype = 'custom' AND r1.post_id = %d
            WHERE lg1.level = 0
              AND lg1.grid_id NOT IN ( SELECT lg11.admin0_grid_id FROM $wpdb->dt_location_grid lg11 WHERE lg11.level = 1 AND lg11.admin0_grid_id = lg1.grid_id )
              AND lg1.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
            UNION ALL
            SELECT
                lg2.grid_id, r2.value
            FROM $wpdb->dt_location_grid lg2
			JOIN $wpdb->dt_reports r2 ON r2.grid_id=lg2.grid_id AND r2.type = 'prayer_app' AND r2.subtype = 'custom' AND r2.post_id = %d
            WHERE lg2.level = 1
              AND lg2.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
            UNION ALL
            SELECT
                lg3.grid_id, r3.value
            FROM $wpdb->dt_location_grid lg3
			JOIN $wpdb->dt_reports r3 ON r3.grid_id=lg3.grid_id AND r3.type = 'prayer_app' AND r3.subtype = 'custom' AND r3.post_id = %d
            WHERE lg3.level = 2
              AND lg3.admin0_grid_id IN (100050711,100219347,100089589,100074576,100259978,100018514)
        ", $parts['post_id'], $parts['post_id'], $parts['post_id'] ), ARRAY_A );

        $data = [];
        foreach ( $data_raw as $row ) {
            if ( ! isset( $data[$row['grid_id']] ) ) {
                $data[$row['grid_id']] = (int) $row['value'] ?? 0;
            }
        }

        return [
            'data' => $data,
        ];
    }

    public function get_participants( $parts ){
        global $wpdb;
        $participants_raw = $wpdb->get_results( $wpdb->prepare( "
           SELECT r.lng as longitude, r.lat as latitude, r.hash
           FROM $wpdb->dt_reports r
           LEFT JOIN $wpdb->dt_location_grid lg ON lg.grid_id=r.grid_id
            WHERE r.post_type = 'laps'
                AND r.type = 'prayer_app'
                AND r.post_id = %d
                AND r.hash IS NOT NULL
        ", $parts['post_id'] ), ARRAY_A );
        $participants = [];
        if ( ! empty( $participants_raw ) ) {
            foreach ( $participants_raw as $p ) {
                if ( ! empty( $p['longitude'] ) ) {
                    $participants[$p['hash']] = [
                        'longitude' => (float) $p['longitude'],
                        'latitude' => (float) $p['latitude']
                    ];
                }
            }
        }

        return array_values( $participants );
    }

    public function get_user_locations( $parts, $data ){
        global $wpdb;
        // Query based on hash
        $hash = $data['hash'];
        if ( empty( $hash ) ) {
            return [];
        }
//        $lap_stats = pg_custom_lap_stats_by_post_id( $parts['post_id'] );

        $user_locations_raw  = $wpdb->get_results( $wpdb->prepare( "
               SELECT lg.longitude, lg.latitude
               FROM $wpdb->dt_reports r
               LEFT JOIN $wpdb->dt_location_grid lg ON lg.grid_id=r.grid_id
               WHERE r.post_type = 'laps'
                    AND r.type = 'prayer_app'
                    AND r.hash = %s
                    AND r.post_id = %s
                    AND r.label IS NOT NULL
            ", $hash, $parts['post_id'] ), ARRAY_A );

        $user_locations = [];
        if ( ! empty( $user_locations_raw ) ) {
            foreach ( $user_locations_raw as $p ) {
                if ( ! empty( $p['longitude'] ) ) {
                    $user_locations[] = [
                        'longitude' => (float) $p['longitude'],
                        'latitude' => (float) $p['latitude']
                    ];
                }
            }
        }

        return $user_locations;
    }

}
PG_Custom_Prayer_App_Map::instance();
