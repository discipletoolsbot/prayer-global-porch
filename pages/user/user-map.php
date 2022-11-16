<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * Class PG_User_App_Map
 */
class PG_User_App_Map extends DT_Magic_Url_Base {

    public $page_title = 'User Map';
    public $root = "user_app";
    public $type = 'map';
    public $post_type = 'user';
    public $user_id;

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

        if ( $this->type !== $this->parts['type'] ) {
            return;
        }

        // require login access
        if ( ! is_user_logged_in() ) {
            $profile_page = Prayer_Global_Porch_User_Page::instance()->type;
            wp_redirect( "/user_app/$profile_page" );
            return;
        }

        $this->user_id = get_current_user_id();

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
    }

    public function header_javascript(){
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
                'stats' => pg_user_race_stats_by_user_id( $this->user_id ),
                'image_folder' => plugin_dir_url( __DIR__ ) . 'assets/images/',
                'translations' => [
                    'add' => __( 'Add Magic', 'prayer-global' ),
                ],
            ]) ?>][0]
        </script>
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/bootstrap/bootstrap5.2.2.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>pray/heatmap.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'pray/heatmap.css' ) ) ?>" type="text/css" media="all">
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>pray/report.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'pray/report.js' ) ) ?>"></script>
        <?php
    }
    public function body(){
        $parts = $this->parts;
        $lap_stats = pg_user_race_stats_by_user_id( $this->user_id );
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
                <div id="head_block">

                    <?php require( __DIR__ . '/nav-user-map.php' ) ?>

                </div>
                <span class="loading-spinner active"></span>
                <div id='map'></div>
                <div id="foot_block">
                    <div class="map-overlay" id="map-legend"></div>
                    <div class="row">
                        <div class="col col-12 center"><button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_stats"><i class="ion-chevron-up two-em"></i></button></div>
                        <div class="col col-sm-6 col-md-3 center d-none d-md-block"><strong>Places Remaining</strong><br><strong><span class="one-em red stats-figure remaining"></span></strong></div>
                        <div class="col col-sm-6 col-md-3 center d-none d-md-block"><strong>Places Covered</strong><br><strong><span class="one-em green stats-figure completed"></span></strong></div>
                        <div class="col col-sm-6 col-md-3 center"><strong>Prayer Warriors</strong><br><img class="three-em" style="padding-top:5px;" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/praying-hand-up-20.png' ) ?>" /></div>
                        <div class="col col-sm-6 col-md-3 center"><strong>Your Recent Prayers</strong><br><img class="three-em" style="padding-top:5px;" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/black-check-50.png' ) ?>" /></div>
                    </div>
                </div>
            </div>
        </div>
       <div class="offcanvas offcanvas-end" id="offcanvas_location_details" data-bs-backdrop="false" data-bs-scroll="true">
            <button type="button" data-bs-dismiss="offcanvas" style="text-align: start"><i class="ion-chevron-right three-em"></i></button>
            <hr>
            <div class="row" id="grid_details_content"></div>
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
            <div class="center"><button type="button" data-bs-dismiss="offcanvas"><i class="ion-chevron-down three-em"></i></button></div>
            <hr>
            <div class="row center">
                <div class="col col-12">
                    <span class="three-em">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?></span>
                    <hr>
                </div>
                <div class="col col-6 col-sm-3">
                    <p class="stats-title">Warriors</p>
                    <p class="stats-figure warriors">0</p>
                </div>
                <div class="col col-6 col-sm-3">
                    <p class="stats-title">Minutes Prayed</p>
                    <p class="stats-figure minutes_prayed">0</p>
                </div>

                <div class="col col-6 col-sm-3">
                    <p class="stats-title">Completed Locations</p>
                    <p class="stats-figure completed">0</p>
                </div>
                <div class="col col-6 col-sm-3">
                    <p class="stats-title">Remaining Locations</p>
                    <p class="stats-figure remaining">0</p>
                </div>
                <div class="col col-6 col-sm-3">
                    <p class="stats-title">World Coverage</p>
                    <p class="stats-figure"><span class="completed_percent">0</span>%</p>
                </div>
                <div class="col col-6 col-sm-3">
                    <p class="stats-title">Time Elapsed</p>
                    <p class="stats-figure time_elapsed">0</p>
                </div>

                <div class="col col-6 col-sm-3">
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

        wp_enqueue_script( 'heatmap-js', trailingslashit( plugin_dir_url( __DIR__ ) ) . 'pray/heatmap.js', [
            'jquery',
            'mapbox-gl'
        ], esc_attr( filemtime( plugin_dir_path( __DIR__ ) .'pray/heatmap.js' ) ), true );
        wp_enqueue_script( 'bootstrap-js', trailingslashit( plugin_dir_url( __DIR__ ) ) . 'assets/js/bootstrap.bundle.min.js', [
            'jquery',
        ], filemtime( plugin_dir_path( __DIR__ ) .'assets/js/bootstrap.bundle.min.js' ), true );
    }

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
            case 'get_stats':
                return pg_user_race_stats_by_user_id( get_current_user_id() );
            case 'get_grid':
                return [
                    'grid_data' => $this->get_grid( $params['parts'] ),
                    'participants' => [],
                ];
            case 'get_grid_details':
                return $this->get_grid_details( $params['data'] );
            case 'get_participants':
                return $this->get_participants( $params['parts'] );
            case 'get_user_locations':
                return [];
            default:
                return new WP_Error( __METHOD__, 'missing action parameter' );
        }

    }

    public function get_grid( $parts ) {
        global $wpdb;

        $user_id = get_current_user_id();
        $lap_stats = pg_user_race_stats_by_user_id( $user_id );

        // map grid
        $data_raw = $wpdb->get_results( $wpdb->prepare( "
            SELECT
                lg1.grid_id, r1.value
            FROM $wpdb->dt_location_grid lg1
			LEFT JOIN $wpdb->dt_reports r1 ON r1.grid_id=lg1.grid_id AND r1.type = 'prayer_app' AND r1.timestamp >= %d AND r1.timestamp <= %d AND r1.user_id = %d
            WHERE lg1.level = 0
              AND lg1.grid_id NOT IN ( SELECT lg11.admin0_grid_id FROM $wpdb->dt_location_grid lg11 WHERE lg11.level = 1 AND lg11.admin0_grid_id = lg1.grid_id )
              AND lg1.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
            UNION ALL
            SELECT
                lg2.grid_id, r2.value
            FROM $wpdb->dt_location_grid lg2
			LEFT JOIN $wpdb->dt_reports r2 ON r2.grid_id=lg2.grid_id AND r2.type = 'prayer_app' AND r2.timestamp >= %d AND r2.timestamp <= %d AND r2.user_id = %d
            WHERE lg2.level = 1
              AND lg2.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
            UNION ALL
            SELECT
                lg3.grid_id, r3.value
            FROM $wpdb->dt_location_grid lg3
			LEFT JOIN $wpdb->dt_reports r3 ON r3.grid_id=lg3.grid_id AND r3.type = 'prayer_app' AND r3.timestamp >= %d AND r3.timestamp <= %d AND r3.user_id = %d
            WHERE lg3.level = 2
              AND lg3.admin0_grid_id IN (100050711,100219347,100089589,100074576,100259978,100018514)
        ", $lap_stats['start_time'], $lap_stats['end_time'], $user_id, $lap_stats['start_time'], $lap_stats['end_time'], $user_id, $lap_stats['start_time'], $lap_stats['end_time'], $user_id ), ARRAY_A );

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

    public function get_grid_details( $data ) {
        $details = PG_Stacker::build_location_stack( $data['grid_id'] );
        return $details;
    }


}
PG_User_App_Map::instance();
