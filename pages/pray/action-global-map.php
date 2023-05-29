<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class PG_Global_Prayer_App_Map extends PG_Global_Prayer_App {

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
        $details['title'] = 'Prayer.Global Map';
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
                'user_locations' => [],
                'stats' => pg_global_stats_by_key( $this->parts['public_key'] ),
                'image_folder' => plugin_dir_url( __DIR__ ) . 'assets/images/',
                'translations' => [
                    'add' => __( 'Add Magic', 'prayer-glob</script>al' ),
                ],
                'map_type' => 'binary',
                'is_dark_map_on' => ( new PG_Feature_Flag( PG_Flags::DARK_MAP_FEATURE ) )->is_on(),
            ]) ?>][0]
        </script>
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/bootstrap/bootstrap5.2.2.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/prayer-global/style.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/fonts/prayer-global/style.css' ) ) ?>">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>heatmap.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'heatmap.css' ) ) ?>" type="text/css" media="all">
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/js/global-functions.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/js/global-functions.js' ) ) ?>"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>report.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'report.js' ) ) ?>"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/js/share.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/js/share.js' ) ) ?>"></script>
        <?php

        pg_toggle_user_elements();
    }

    public function footer_javascript() {}

    public function body(){
        $parts = $this->parts;
        $lap_stats = pg_global_stats_by_key( $parts['public_key'] );
        DT_Mapbox_API::geocoder_scripts();
        ?>
        <style id="custom-style"></style>
        <div id="map-content">
            <div id="initialize-screen">
                <div id="initialize-spinner-wrapper" class="center">
                    <progress class="success initialize-progress" max="46" value="0"></progress><br>
                    Loading the planet ...<br>
                    <span id="initialize-people" style="display:none;">Locating world population...</span><br>
                    <span id="initialize-activity" style="display:none;">Calculating movement activity...</span><br>
                    <span id="initialize-coffee" style="display:none;">Shamelessly brewing coffee...</span><br>
                    <span id="initialize-dothis" style="display:none;">Let's do this...</span><br>
                </div>
            </div>
            <div id="map-wrapper">
                <div id="head_block" class="brand-bg white">

                    <?php require( __DIR__ . '/nav-global-map.php' ) ?>

                    <?php require( __DIR__ . '/map-settings.php' ) ?>

                </div>
                <span class="loading-spinner active"></span>
                <div id='map'></div>
                <div id="foot_block">
                    <div class="map-overlay" id="map-legend"></div>
                    <div class="row">
                        <div class="col col-12 center">
                            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_stats">
                                <i class="icon pg-chevron-up three-em blue"></i>
                            </button>
                            <div class="one-em uppercase font-weight-bold">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?> Stats</div>
                        </div>
                        <div class="col col-sm-6 col-md-3 center ">
                            <div class="blue-bg white blue-border rounded-start d-flex align-items-center justify-content-around">
                                <i class="icon pg-world-light three-em"></i>
                                <div class="two-em white stats-figure remaining"></div>
                            </div>
                            <span class="uppercase small">Places Remaining</span><br>
                        </div>
                        <div class="col col-sm-6 col-md-3 center">
                            <div class="white-bg blue blue-border rounded-end d-flex align-items-center justify-content-around">
                                <i class="icon pg-world-light three-em"></i>
                                <div class="two-em stats-figure completed"></div>
                            </div>
                            <span class="uppercase small">Places Covered</span><br>
                        </div>
                        <div class="col col-sm-6 col-md-3 center d-none d-md-block">
                            <strong><span class="stats-figure warriors"></span></strong>
                            <strong>Warriors</strong><br>
                        </div>
                        <div class="col col-sm-6 col-md-3 center d-none d-md-block">
                            <strong class="stats-figure"><span class="completed_percent">0</span>%</strong>
                            <strong>World Coverage</strong><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="offcanvas offcanvas-end" id="offcanvas_location_details" data-bs-backdrop="false" data-bs-scroll="true">
            <div class="offcanvas__header d-flex align-items-center justify-content-between">
                <button type="button" data-bs-dismiss="offcanvas" style="text-align: start">
                    <i class="ion-chevron-right three-em"></i>
                </button>
                <a class="btn btn-outline-dark py-2" id="pray-for-area-button" href="#">Pray for this area</a>
            </div>
            <div class="row offcanvas__content" id="grid_details_content"></div>
        </div>
        <div class="modal fade" id="pray-for-area-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <iframe src="" frameborder="0" id="pray-for-area-iframe"></iframe>
                </div>
            </div>
        </div>
        <!-- report modal -->
        <div class="reveal " id="correction_modal" data-v-offset="10px;" data-reveal>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thank you! Leave us a correction below.</h5>
                    <hr>
                </div>
                <div class="modal-body">
                    <p><span id="correction_title" class="correction_field"></span></p>
                    <p>
                        Section:<br>
                        <select class="form-control form-select correction_field" id="correction_select"></select>
                    </p>
                    <p>
                        Correction Requested:<br>
                        <textarea class="form-control correction_field" id="correction_response" rows="3"></textarea>
                    </p>
                    <p>
                        <button type="button" class="button button-secondary" id="correction_submit_button">Submit</button> <span class="loading-spinner correction_modal_spinner"></span>
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
            <div class="row center uppercase offcanvas__content">
                <div class="col col-12">
                    <div class="two-em font-weight-bold">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?> Stats</div>
                </div>
                <div class="col col-6 col-sm-3">
                    <div class="blue-bg white blue-border rounded-start d-flex align-items-center justify-content-around">
                        <i class="icon pg-world-light three-em"></i>
                        <div class="two-em white stats-figure remaining"></div>
                    </div>
                    <span class="small">Places Remaining</span><br>
                </div>
                <div class="col col-6 col-sm-3">
                    <div class="white-bg blue blue-border rounded-end d-flex align-items-center justify-content-around">
                        <i class="icon pg-world-light three-em"></i>
                        <div class="two-em stats-figure completed"></div>
                    </div>
                    <span class="small">Places Covered</span><br>
                </div>
                <div class="align-items-center col-sm-3 d-flex flex-dir-column mt-3">
                    <i class="icon pg-world-arrow blue four-em"></i>
                    <span class="stats-title">World Coverage</span>
                    <div class="blue-bg rounded stats-figure-lg w-50 white"><span class="completed_percent">0</span>%</div>
                </div>
                <div class="align-items-center col-sm-3 d-flex flex-dir-column mt-3">
                    <i class="icon pg-prayer blue four-em"></i>
                    <span class="stats-title">Intercessors</span>
                    <div class="orange-bg rounded stats-figure-lg w-50 warriors white">0</div>
                </div>
                <hr class="mt-3">
                <div class="col-sm-3">
                    <p class="two-em mb-0">Time Elapsed</p>
                    <p class="stats-figure time_elapsed">0</p>
                </div>

                <div class="col col-6 col-sm-3" style="display:none">
                    <p class="stats-title">Start Time</p>
                    <p class="stats-figure start_time">0</p>
                </div>
                <div class="col col-6 col-sm-3 on-going" style="display:none;">
                    <p class="stats-title">End Time</p>
                    <p class="stats-figure end_time">0</p>
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
        ], esc_attr( filemtime( plugin_dir_path( __FILE__ ) .'heatmap.js' ) ), true );
        wp_enqueue_script( 'bootstrap-js', trailingslashit( plugin_dir_url( __DIR__ ) ) . 'assets/js/bootstrap.bundle.min.js', [
            'jquery',
        ], filemtime( plugin_dir_path( __DIR__ ) .'assets/js/bootstrap.bundle.min.js' ), true );
    }

    public function endpoint( WP_REST_Request $request ) {
        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'] ) ) {
            return new WP_Error( __METHOD__, 'Missing parameters', [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        switch ( $params['action'] ) {
            case 'get_stats':
                return pg_global_stats_by_key( $params['parts']['public_key'] );
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
        $lap_stats = pg_global_stats_by_key( $parts['public_key'] );

        // map grid
        $data_raw = $wpdb->get_results( $wpdb->prepare( "
            SELECT
                lg1.grid_id, r1.value
            FROM $wpdb->dt_location_grid lg1
			LEFT JOIN $wpdb->dt_reports r1 ON r1.grid_id=lg1.grid_id AND r1.type = 'prayer_app' AND r1.timestamp >= %d AND r1.timestamp <= %d
            WHERE lg1.level = 0
              AND lg1.grid_id NOT IN ( SELECT lg11.admin0_grid_id FROM $wpdb->dt_location_grid lg11 WHERE lg11.level = 1 AND lg11.admin0_grid_id = lg1.grid_id )
              AND lg1.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
            UNION ALL
            SELECT
                lg2.grid_id, r2.value
            FROM $wpdb->dt_location_grid lg2
			LEFT JOIN $wpdb->dt_reports r2 ON r2.grid_id=lg2.grid_id AND r2.type = 'prayer_app' AND r2.timestamp >= %d AND r2.timestamp <= %d
            WHERE lg2.level = 1
              AND lg2.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
            UNION ALL
            SELECT
                lg3.grid_id, r3.value
            FROM $wpdb->dt_location_grid lg3
			LEFT JOIN $wpdb->dt_reports r3 ON r3.grid_id=lg3.grid_id AND r3.type = 'prayer_app' AND r3.timestamp >= %d AND r3.timestamp <= %d
            WHERE lg3.level = 2
              AND lg3.admin0_grid_id IN (100050711,100219347,100089589,100074576,100259978,100018514)
        ", $lap_stats['start_time'], $lap_stats['end_time'], $lap_stats['start_time'], $lap_stats['end_time'], $lap_stats['start_time'], $lap_stats['end_time'] ), ARRAY_A );

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
        $lap_stats = pg_global_stats_by_key( $parts['public_key'] );

        $participants_raw = $wpdb->get_results( $wpdb->prepare( "
           SELECT r.lng as longitude, r.lat as latitude, r.hash
           FROM $wpdb->dt_reports r
           LEFT JOIN $wpdb->dt_location_grid lg ON lg.grid_id=r.grid_id
            WHERE r.post_type = 'laps'
                AND r.type = 'prayer_app'
           AND r.timestamp >= %d AND r.timestamp <= %d AND r.hash IS NOT NULL
        ", $lap_stats['start_time'], $lap_stats['end_time'] ), ARRAY_A );
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
        $hash = $data['hash'] ?? false;
        if ( empty( $hash ) ) {
            return [];
        }
        $lap_stats = pg_global_stats_by_key( $parts['public_key'] );

        $user_locations_raw  = $wpdb->get_results( $wpdb->prepare( "
               SELECT lg.longitude, lg.latitude
               FROM $wpdb->dt_reports r
               LEFT JOIN $wpdb->dt_location_grid lg ON lg.grid_id=r.grid_id
               WHERE r.post_type = 'laps'
                    AND r.type = 'prayer_app'
                    AND r.hash = %s
                AND r.timestamp >= %d AND r.timestamp <= %d
                AND r.label IS NOT NULL
            ", $hash, $lap_stats['start_time'], $lap_stats['end_time'] ), ARRAY_A );

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
PG_Global_Prayer_App_Map::instance();
